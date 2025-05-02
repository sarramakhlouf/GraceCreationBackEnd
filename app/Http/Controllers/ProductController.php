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

        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }
        
        $products = $query->paginate(10);

        return view('produits.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $subcategories = SubCategory::all();


        $produitsSansPack = Product::where('pack', false)->get();

        return view('produits.create', compact('produitsSansPack', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/Website-pic', 'public');
            $data['image'] = $imagePath;
        }

        if (!empty($data['pack']) && $data['pack'] == 1) {
            $data['pack_id'] = null;
        }

        $product = Product::create($data);

        if (!empty($data['pack']) && $data['pack'] == 1 && !empty($data['produits_associes'])) {
            foreach ($data['produits_associes'] as $produitId) {
                // On met à jour chaque produit associé pour leur donner le pack_id du produit actuel
                Product::where('id', $produitId)->update(['pack_id' => $product->id]);
            }
        }

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $subcategories = SubCategory::all();
        $produitsAssocies = Product::where('pack_id', $product->id)->get();
        $produitsAssociesIds = $produitsAssocies->pluck('id')->toArray();
        $produitsSansPack = Product::whereNull('pack_id')->get();
        return view('produits.update', compact('product', 'subcategories', 'produitsSansPack', 'produitsAssocies', 'produitsAssociesIds'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
            $data['image'] = $this->handleImageUpload($request);
        }

        $product->update($data);

        if (!empty($data['pack']) && isset($data['produits_associes'])) {
            $produitsAssociesIds = explode(',', $data['produits_associes']);

            Product::where('pack_id', $product->id)
                ->whereNotIn('id', $produitsAssociesIds)
                ->update(['pack_id' => null]);

            foreach ($produitsAssociesIds as $id) {
                $produitAssocie = Product::find($id);
                if ($produitAssocie) {
                    $produitAssocie->update(['pack_id' => $product->id]);
                }
            }
        } else {
            Product::where('pack_id', $product->id)->update(['pack_id' => null]);
        }

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
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
        $searchTerm = $request->query('query');

        if (empty($searchTerm)) {
            return response()->json(['message' => 'Veuillez fournir un terme de recherche'], 400);
        }

        $query = Product::query()->where(function ($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('subcategory', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->orWhereHas('subcategory.category', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        });

        $products = $query->with(['subcategory.category'])->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Aucun produit trouvé pour : ' . $searchTerm], 404);
        }

        return response()->json($products);
    }

    public function getAllProductsWithDetails()
    {
        try {
            $products = DB::table('products')
                ->leftJoin('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')
                ->leftJoin('ProductFilter', 'products.id', '=', 'ProductFilter.product_id')
                ->leftJoin('filters', 'ProductFilter.filter_id', '=', 'filters.id')
                ->select(
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.price',
                    'products.image',
                    'categories.id AS category_id', 
                    'subcategories.id AS subcategory_id',
                    'categories.name AS category_name',
                    'subcategories.name AS subcategory_name',
                    'filters.id AS filter_id', 
                    'filters.name AS filter_name'
                )
                ->get();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur serveur',
                'message' => $e->getMessage()
            ], 500);
        }
    }




}
