<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\SubCategoryController;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        // Récupérer les sous-catégories
        $subcategories = SubCategory::all();

        // Récupérer les produits qui ne sont pas des packs pour le multiselect
        $produitsSansPack = Product::where('pack', false)->get();

        return view('produits.create', compact('produitsSansPack', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Vérifiez et enregistrez l'image si elle existe
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/Website-pic', 'public');
            $data['image'] = $imagePath;
        }

        // Créez le produit
        $product = Product::create($data);

        // Si le produit est un pack, associez les produits sélectionnés
        if ($data['pack'] && !empty($data['produits_associes'])) {
            $produitsAssociesIds = explode(',', $data['produits_associes']);
            foreach ($produitsAssociesIds as $id) {
                $produitAssocie = Product::find($id);
                if ($produitAssocie) {
                    $produitAssocie->update(['pack_id' => $product->id]);
                }
            }
        }

        // Redirection vers la liste des produits
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $subcategories = SubCategory::all();
        // Produits associés au pack
        $produitsAssocies = Product::where('pack_id', $product->id)->get();
        $produitsAssociesIds = $produitsAssocies->pluck('id')->toArray();

        // Produits disponibles pour l'association
        $produitsSansPack = Product::whereNull('pack_id')->orWhere('pack_id', $product->id)->get();

        return view('produits.update', compact('product', 'subcategories', 'produitsSansPack', 'produitsAssocies', 'produitsAssociesIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
    
        // Supprimez l'ancienne image si une nouvelle est téléchargée
        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
    
            // Stockez la nouvelle image
            $imagePath = $request->file('image')->store('assets/Website-pic', 'public');
            $data['image'] = $imagePath;
        }
    
        // Mettre à jour les informations du produit
        $product->update($data);
    
        // Gérer les produits associés si le produit est un pack
        if (!empty($data['pack']) && isset($data['produits_associes'])) {
            // Convertir la liste des IDs des produits associés en tableau
            $produitsAssociesIds = explode(',', $data['produits_associes']);
    
            // Dissocier les anciens produits qui ne sont plus sélectionnés
            Product::where('pack_id', $product->id)
                ->whereNotIn('id', $produitsAssociesIds)
                ->update(['pack_id' => null]);
    
            // Associer les nouveaux produits sélectionnés
            foreach ($produitsAssociesIds as $id) {
                $produitAssocie = Product::find($id);
                if ($produitAssocie) {
                    $produitAssocie->update(['pack_id' => $product->id]);
                }
            }
        } else {
            // Si le produit n'est plus un pack, désassociez tous les produits
            Product::where('pack_id', $product->id)->update(['pack_id' => null]);
        }
    
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès !');
    }    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->pack) {
            Product::where('pack_id', $product->id)->update(['pack_id' => null]);
        }

        $product->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès !');
    }

    public function getProducts() {
        $products = Product::all();
        return $products;
    }

    public function getProductsByCategory($categoryId)
    {
        try {
            $subcategories = Subcategory::where('category_id', $categoryId)->pluck('id');
    
            if ($subcategories->isEmpty()) {
                return response()->json(['message' => 'No products found for this category'], 404);
            }
    
            $products = Product::whereIn('subcategory_id', $subcategories)->get();
            return response()->json($products);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    

    // Récupérer les produits par sous-catégorie
    public function getProductsBySubCategory($subCategoryId)
    {
        $products = Product::where('subcategory_id', $subCategoryId)->get();
        return response()->json($products);
    }

    public function showProductById($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('subcategory.category', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        if ($request->has('subcategory') && !empty($request->subcategory)) {
            $query->whereHas('subcategory', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->subcategory . '%');
            });
        }

        $products = $query->with(['subcategory.category'])->get();

        return response()->json($products);
    }



    /*public function GetFiltredProducts(Request $request)
    {
        try {
            $selectedCategories = $request->input('categories', []);
            $selectedColors = $request->input('filters', []);
            $query = DB::table('products')
                ->leftJoin('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')
                ->leftJoin('ProductFilter', 'products.id', '=', 'ProductFilter.product_id')
                ->leftJoin('filters', 'ProductFilter.filter_id', '=', 'filters.id')
                ->select('products.*','categories.name AS category_name','subcategories.name AS subcategory_name','filters.name AS filter_name');
            // Filtrer par catégories si elles sont sélectionnées
            if (!empty($selectedCategories)) {
                $query->whereIn('categories.id', $selectedCategories);
            }
            // Filtrer par couleurs (filtres) si elles sont sélectionnées
            if (!empty($selectedColors)) {
                $query->whereIn('filters.id', $selectedColors);
            }

            $products = $query->get();
    
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }*/



}
