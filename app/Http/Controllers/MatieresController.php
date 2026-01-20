<?php

namespace App\Http\Controllers;

use App\Models\Matieres;
use App\Models\Departements;
use App\Http\Requests\MatieresRequest;
use Illuminate\Support\Facades\Auth;

class MatieresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matieres = Matieres::with('departement')->get();
        return view('matieres.index', compact('matieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departements::all();
        return view('matieres.create', compact('departements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatieresRequest $request)
    {
        $validated = $request->validated();
        Matieres::create($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $matiere = Matieres::with('departement', 'cours', 'avancements')->findOrFail($id);
        return view('matieres.show', compact('matiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matiere = Matieres::findOrFail($id);
        $departements = Departements::all();
        return view('matieres.edit', compact('matiere', 'departements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatieresRequest $request, string $id)
    {
        $matiere = Matieres::findOrFail($id);
        $validated = $request->validated();
        $matiere->update($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matiere = Matieres::findOrFail($id);
        $matiere->delete();

        return redirect()->route('matieres.index')
            ->with('success', 'Matière supprimée avec succès.');
    }
}

