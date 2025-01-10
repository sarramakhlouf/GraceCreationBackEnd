<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        // Recherche par client ou produit
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('client_name', 'like', '%' . $search . '%')
                  ->orWhereHas('product', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }

        // Récupérer les commandes
        $orders = $query->with('product')->latest()->paginate(10);

        return view('commandes.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all(); // Liste des produits pour le formulaire
        return view('commandes.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        Order::create($data);

        return redirect()->route('commandes.index')->with('success', 'Commande ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('commandes.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all(); // Liste des produits pour le formulaire
        return view('commandes.update', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès !');
    }
}
