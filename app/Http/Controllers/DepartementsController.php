<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use App\Http\Requests\DepartementsRequest;
use Illuminate\Support\Facades\Auth;

class DepartementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departements = Departements::all();
        return view('departements.index', compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartementsRequest $request)
    {
        $validated = $request->validated();
        Departements::create($validated);

        return redirect()->route('departements.index')
            ->with('success', 'Département créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departement = Departements::findOrFail($id);
        return view('departements.show', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departement = Departements::findOrFail($id);
        return view('departements.edit', compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartementsRequest $request, string $id)
    {
        $departement = Departements::findOrFail($id);
        $validated = $request->validated();
        $departement->update($validated);

        return redirect()->route('departements.index')
            ->with('success', 'Département modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departement = Departements::findOrFail($id);
        $departement->delete();

        return redirect()->route('departements.index')
            ->with('success', 'Département supprimé avec succès.');
    }
}
