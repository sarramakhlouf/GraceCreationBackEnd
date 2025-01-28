<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\TypeFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Filter::query();
        if ($request->has('search')) {
            $search = $request->input('search'); 
            $query->where('name', 'like', '%' . $search . '%');
        }
        $filters = $query->get();

        // Retourne la vue avec les données
        return view('filters.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typefilters = TypeFilter::all();
        // Retourne la vue de création
        return view('filters.create', compact('typefilters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'type_id' => 'required|exists:typefilter,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            // Enregistrer l'icône et stocker son chemin
            $data['icon'] = $request->file('icon')->store('assets/Website-pic', 'public');
        }

        Filter::create($data);

        return redirect()->route('filters.index')->with('success', 'Filtre créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filter $filter)
    {
        return view('filters.show', compact('filter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filter $filter)
    {
        $typefilters = TypeFilter::all();
         // Retourne la vue d'édition
        return view('filters.update', compact('filter', 'typefilters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filter $filter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'type_id' => 'required|exists:typefilter,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            // Supprimer l'ancienne icône si elle existe
            if ($filter->icon && Storage::disk('public')->exists($filter->icon)) {
                Storage::disk('public')->delete($filter->icon);
            }

            // Enregistrer la nouvelle icône
            $data['icon'] = $request->file('icon')->store('assets/Website-pic', 'public');
        }

        $filter->update($data);

        return redirect()->route('filters.index')->with('success', 'Filtre mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filter $filter)
    {
        if ($filter->icon && Storage::disk('public')->exists($filter->icon)) {
            // Supprimer l'icône associée
            Storage::disk('public')->delete($filter->icon);
        }

        $filter->delete();

        return redirect()->route('filters.index')->with('success', 'Filtre supprimé avec succès.');
    }

    public function filtersForColor()
    {
        // Récupère les filtres où le type est "couleur"
        $filters = Filter::whereHas('type', function ($query) {
            $query->where('type', 'couleur');
        })->get();

        return response()->json($filters);
    }
}
