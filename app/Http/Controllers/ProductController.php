<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
        $query = Product::query();
        // Filtrer les produits selon la recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        // Récupérer les produits filtrés ou tous les produits si pas de recherche
        $products = $query->get();

        return view('produits.index', compact('products'));
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Vérifier et enregistrer l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets', 'public'); // Enregistre dans storage/app/public/products
            $data['image'] = $imagePath;
        }

        // Créer le produit
        $product = Product::create($data);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product->load('subcategory');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $availableProducts = Product::where('pack', 0)->get();
        return view ('produits.update', compact('product', 'availableProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($product->image && Storage::exists('public/'.$product->image)) {
                Storage::delete('public/'.$product->image);
            }
            $imagePath = $request->file('image')->store('assets', 'public');
            $data['image'] = $imagePath;
        }
        $product->update($data);
        return redirect()->route('produits.index')->with('success', 'Produit mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès');
    }
}
