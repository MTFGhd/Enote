<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Departements;
use App\Http\Requests\ClassesRequest;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::with('departement')->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departements::all();
        return view('classes.create', compact('departements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassesRequest $request)
    {
        $validated = $request->validated();
        Classes::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Classe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classe = Classes::with('departement', 'cours', 'avancements')->findOrFail($id);
        return view('classes.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classe = Classes::findOrFail($id);
        $departements = Departements::all();
        return view('classes.edit', compact('classe', 'departements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassesRequest $request, string $id)
    {
        $classe = Classes::findOrFail($id);
        $validated = $request->validated();
        $classe->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Classe modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classe = Classes::findOrFail($id);
        $classe->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Classe supprimée avec succès.');
    }
}

