<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

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
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('orderLines', function ($q) use ($search) {
                    $q->whereHas('product', function($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%');
                    });
                });
        }

        // Récupérer toutes les commandes sans pagination
        $orders = $query->get();

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
        // Création de la commande
        $order = Order::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'total' => $data['total'],
        ]);

        // Ajouter les produits à la table order_lines
        foreach ($data['products'] as $product) {
            $inventory = Inventory::where('product_id', $product['id'])->first();
        
            $productQuantity = $product['quantity'] ?? 1;
        
            $productModel = Product::find($product['id']);
        
            if (!$inventory || $inventory->quantite < $productQuantity) {
                // Retourner une alerte si la quantité dépasse celle en stock
                return response()->json([
                    'error' => "La quantité maximale du produit: {$productModel->name} est {$inventory->quantite}"
                ], 400);
            }
        
            // Ajouter la ligne de commande
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $productQuantity, 
                'price' => $product['price'] ?? 0,
            ]);
        }

        return response()->json([
            'message' => 'Commande ajoutée avec succès !',
            'order' => $order
        ], 200);
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


    public function validateOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != 0) {
            return redirect()->route('commandes.index')->with('error', 'Cette commande a déjà été traitée.');
        }

        $orderLines = $order->orderLines;

        foreach ($orderLines as $line) {
            $inventory = Inventory::where('product_id', $line->product_id)->first();

            if (!$inventory || $inventory->quantite < $line->quantity) {
                return redirect()->route('commandes.index')->with('error', "Stock insuffisant pour le produit : " . $line->product->name);
            }
        }

        // Mise à jour du statut de la commande
        $order->status = 1;
        $order->save();

        // Si la commande est validée, on décrémente le stock
        foreach ($orderLines as $line) {
            $inventory = Inventory::where('product_id', $line->product_id)->first();
            
            if ($inventory) {
                $inventory->quantite -= $line->quantity;
                $inventory->save();
            }
        }

        return redirect()->route('commandes.index')->with('success', 'Commande validée avec succès !');
    }


    // Fonction pour annuler la commande et restaurer le stock
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $orderLines = $order->orderLines;

        if ($order->status != 0) {
            return redirect()->route('commandes.index')->with('error', 'Commande déjà traitée.');
        }
        
        
        $order->status = 2;
        $order->save();

        return redirect()->route('commandes.index')->with('message', 'Commande annulée et stock restauré.');
        
    }

    public function getOrderStatus($id)
    {
        $order = Order::find($id);
        
        return response()->json(['status' => $order->status]);
    }




}
