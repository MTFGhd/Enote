<?php

namespace App\Http\Controllers;

use App\Models\Enseignants;
use App\Http\Requests\EnseignantsRequest;
use Illuminate\Support\Facades\Auth;

class EnseignantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants = Enseignants::all();
        return view('enseignants.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enseignants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnseignantsRequest $request)
    {
        $validated = $request->validated();
        Enseignants::create($validated);

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enseignant = Enseignants::with('cours', 'avancements')->findOrFail($id);
        return view('enseignants.show', compact('enseignant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enseignant = Enseignants::findOrFail($id);
        return view('enseignants.edit', compact('enseignant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnseignantsRequest $request, string $id)
    {
        $enseignant = Enseignants::findOrFail($id);
        $validated = $request->validated();
        $enseignant->update($validated);

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enseignant = Enseignants::findOrFail($id);
        $enseignant->delete();

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant supprimé avec succès.');
    }
}

