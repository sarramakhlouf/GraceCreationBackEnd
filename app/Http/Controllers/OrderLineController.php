<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    public function store(StoreOrderLineRequest $request)
    {
        $data = $request->validated();

        foreach ($request->products as $product) {
            OrderLiner::create($data);
        }
        dd($products);

        return response()->json([
            'message' => 'Commande ajoutée avec succès !',
            'orderline' => $orderline
        ], 200);
    }
}
