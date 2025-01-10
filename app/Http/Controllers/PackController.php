<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Http\Requests\StorePackRequest;
use App\Http\Requests\UpdatePackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pour manipuler le système de fichiers

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pack::query(); // Crée une instance de la requête

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%'); // Filtre par nom
        }

        // Récupère tous les packs avec la recherche appliquée
        $packs = $query->get();

        return view('packs.index', compact('packs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('packs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packs', 'public'); // Enregistre l'image
            $data['image'] = $imagePath;
        }
        $pack = Pack::create($data);

        return redirect()->route('packs.index')->with('success', 'Pack ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pack $pack)
    {
        return view('packs.show', compact('pack'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pack $pack)
    {
        return view('packs.edit', compact('pack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackRequest $request, Pack $pack)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($pack->image && Storage::exists('public/' . $pack->image)) {
                Storage::delete('public/' . $pack->image);
            }
            $imagePath = $request->file('image')->store('packs', 'public');
            $data['image'] = $imagePath;
        }
        $pack->update($data);

        return redirect()->route('packs.index')->with('success', 'Pack mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pack $pack)
    {
        if ($pack->image && Storage::exists('public/' . $pack->image)) {
            Storage::delete('public/' . $pack->image);
        }
        $pack->delete();

        return redirect()->route('packs.index')->with('success', 'Pack supprimé avec succès !');
    }
}
