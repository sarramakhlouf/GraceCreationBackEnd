<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inventory::query();

        // Filtrage par ID de produit, ID de dépôt, ou quantité si une recherche est effectuée
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('product_id', 'like', '%' . $search . '%')
                  ->orWhere('depot_id', 'like', '%' . $search . '%')
                  ->orWhere('quantite', 'like', '%' . $search . '%');
        }

        // Récupérer les inventaires avec la recherche appliquée
        $inventories = $query->get();

        return view('inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        $data = $request->validated();

        // Enregistrer l'inventaire
        Inventory::create($data);

        return redirect()->route('inventories.index')->with('success', 'Inventaire ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.update', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $data = $request->validated();

        // Mettre à jour les informations de l'inventaire
        $inventory->update($data);

        return redirect()->route('inventories.index')->with('success', 'Inventaire mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Inventaire supprimé avec succès!');
    }
}
