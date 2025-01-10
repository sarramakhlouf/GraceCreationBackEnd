<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Http\Requests\StoreDepotRequest;
use App\Http\Requests\UpdateDepotRequest;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Depot::query();

        // Filtrage par recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
        }

        $depots = $query->get();

        return view('depots.index', compact('depots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepotRequest $request)
    {
        $data = $request->validated();

        Depot::create($data);

        return redirect()->route('depots.index')->with('success', 'Dépôt ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depot $depot)
    {
        return view('depots.show', compact('depot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depot $depot)
    {
        return view('depots.update', compact('depot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepotRequest $request, Depot $depot)
    {
        $data = $request->validated();

        $depot->update($data);

        return redirect()->route('depots.index')->with('success', 'Dépôt mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depot $depot)
    {
        $depot->delete();

        return redirect()->route('depots.index')->with('success', 'Dépôt supprimé avec succès !');
    }
}
