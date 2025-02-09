<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ClientController extends Controller {

    public function index(Request $request) {
        $query = Order::select('name', 'email', 'address', 'phone')
                      ->groupBy('name', 'email', 'address', 'phone'); // On groupe par ces champs pour éviter les doublons

        // Vérification du filtre de recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $clients = $query->get();
        return view('clients.index', compact('clients'));
    }
}
