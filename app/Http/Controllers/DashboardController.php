<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        
        $totalProducts = Product::count();

        $totalClients = Order::distinct('email')->count('email');

        $validatedOrders = Order::where('status', 1)->count(); 
        $canceledOrders = Order::where('status', 2)->count(); 
        $pendingOrders = Order::where('status', 0)->count(); 

        $productsInStock = Inventory::where('quantite', '>', 0)->count();
        $productsOutOfStock = Inventory::where('quantite', '=', 0)->count();

        return view('dashboard', compact(
            'totalOrders', 'totalProducts', 'totalClients',
            'validatedOrders', 'canceledOrders', 'pendingOrders',
            'productsInStock', 'productsOutOfStock' 
        ));
    }
}
