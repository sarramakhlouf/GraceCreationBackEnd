<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Ajouté pour manipuler le système de fichiers

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query(); // Crée une instance de la requête

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');;
        }

        // Récupère toutes les catégories avec la recherche appliquée
        $categories = $query->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets', 'public'); // Enregistre l'image dans storage/app/public
            $data['image'] = $imagePath;
        }
        $category = Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Vérifier si une image précédente existe et la supprimer si elle est présente
            if ($category->image && Storage::exists('public/'.$category->image)) {
                Storage::delete('public/'.$category->image);
            }

            // Tenter de stocker la nouvelle image
            try {
                $imagePath = $request->file('image')->store('assets', 'public');
                $data['image'] = $imagePath;
            } catch (\Exception $e) {
                // Gestion des erreurs en cas de problème avec le stockage de l'image
                return redirect()->route('categories.index')->with('error', 'Une erreur est survenue lors du téléchargement de l\'image.');
            }
        }

        // Mise à jour des données de la catégorie
        $category->update($data);

        // Retourner à la liste des catégories avec un message de succès
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès');
    }

    public function getCategories() {
        $categories = Category::all();

        return $categories;
    }

}
