<?php

namespace App\Http\Controllers;

use App\Models\TypeFilter;
use Illuminate\Http\Request;

class TypeFilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TypeFilter::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('type', 'like', '%' . $search . '%');
        }
        $typefilters = $query->get();

        // Retourne la vue avec les données
        return view('filters.types.index', compact('typefilters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retourne la vue de création
        return view('filters.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);
        TypeFilter::create($request->all());

        return redirect()->route('typefilter.index')->with('success', 'TypeFilter créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeFilter $typefilter)
    {
        return view('filters.type.show', compact('typefilter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeFilter $typefilter)
    {
        // Retourne la vue d'édition avec les données du type
        return view('filters.types.update', compact('typefilter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeFilter $typefilter)
    {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);
        $typefilter->update($request->all());

        return redirect()->route('typefilter.index')->with('success', 'TypeFilter mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeFilter $typefilter)
    {
        $typefilter->delete();


        return redirect()->route('typefilter.index')->with('success', 'TypeFilter supprimé avec succès.');
    }
}
