<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductFilter;
use App\Models\Product;
use App\Models\Filter;

class ProductFilterController extends Controller
{
    /**
     * Afficher tous les enregistrements.
     */
    public function index()
    {
        $productfilters = ProductFilter::all();

        // Retourne la vue avec les données
        return view('filters.productfilters.index', compact('productfilters'));
    }

    /**
     * Créer un nouvel enregistrement.
     */

    public function create()
    {
        $products = Product::all();
        $filters = Filter::all();
        // Retourne la vue de création
        return view('filters.productfilters.create', compact('products','filters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'filter_id'  => 'required|integer|exists:filters,id',
        ]);

        $productFilter = ProductFilter::create($validatedData);
        return redirect()->route('productfilters.index');
    }

    /**
     * Afficher un enregistrement spécifique.
     */
    public function show($product_id, $filter_id)
    {
        $productFilter = ProductFilter::where('product_id', $product_id)
                                      ->where('filter_id', $filter_id)
                                      ->first();

        if (!$productFilter) {
            return response()->json(['message' => 'Enregistrement non trouvé.'], 404);
        }

        return response()->json($productFilter);
    }

    /**
     * Supprimer un enregistrement spécifique.
     */
    public function destroy($product_id, $filter_id)
    {
        $productFilter = ProductFilter::where('product_id', $product_id)
                                      ->where('filter_id', $filter_id)
                                      ->first();

        if (!$productFilter) {
            return response()->json(['message' => 'Enregistrement non trouvé.'], 404);
        }

        $productFilter->delete();
        return redirect()->route('productfilters.index');
    }
}
