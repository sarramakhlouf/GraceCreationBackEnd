<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Slide::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('image', 'like', '%' . $search . '%');
        }

        $slides = $query->get();

        return view('slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $data = [];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides', 'public');
            $data['image'] = $imagePath;
        }

        Slide::create($data);

        return redirect()->route('slides.index')->with('success', 'Slide ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slide $slide)
    {
        return view('slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        return view('slides.update', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [];
        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($slide->image && Storage::exists('public/' . $slide->image)) {
                Storage::delete('public/' . $slide->image);
            }
            $imagePath = $request->file('image')->store('slides', 'public');
            $data['image'] = $imagePath;
        }

        $slide->update($data);

        return redirect()->route('slides.index')->with('success', 'Slide mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        // Supprime l'image associée si elle existe
        if ($slide->image && Storage::exists('public/' . $slide->image)) {
            Storage::delete('public/' . $slide->image);
        }

        $slide->delete();

        return redirect()->route('slides.index')->with('success', 'Slide supprimé avec succès !');
    }
}

