<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SubCategory::with('category'); 
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $subCategories = $query->get();

        return view('subcategories.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Charge toutes les catégories pour le formulaire
        return view('subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets', 'public'); // Enregistre l'image
            $data['image'] = $imagePath;
        }

        SubCategory::create($data);

        return redirect()->route('subcategories.index')->with('success', 'Sous-catégorie ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        return view('subcategories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all(); // Charge toutes les catégories pour le formulaire
        return view('subcategories.update', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($subCategory->image && Storage::exists('public/' . $subCategory->image)) {
                Storage::delete('public/' . $subCategory->image);
            }

            $imagePath = $request->file('image')->store('assets', 'public');
            $data['image'] = $imagePath;
        }

        $subCategory->update($data);

        return redirect()->route('subcategories.index')->with('success', 'Sous-catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        // Supprime l'image associée si elle existe
        if ($subCategory->image && Storage::exists('public/' . $subCategory->image)) {
            Storage::delete('public/' . $subCategory->image);
        }

        $subCategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'Sous-catégorie supprimée avec succès');
    }

    public function getSubcategoriesByCategory($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
