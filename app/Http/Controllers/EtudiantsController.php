<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiants::with('classe')->paginate(15);
        $classes = Classes::all();
        return view('etudiants.index', compact('etudiants', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::all();
        return view('etudiants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CodeE' => 'required|string|max:255|unique:Etudiants,CodeE',
            'Nom' => 'required|string|max:50',
            'Prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:Etudiants,email',
            'CodeC' => 'required|exists:Classes,CodeC',
        ]);

        Etudiants::create($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etudiant = Etudiants::with('classe', 'absences.cours')->findOrFail($id);
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etudiant = Etudiants::findOrFail($id);
        $classes = Classes::all();
        return view('etudiants.edit', compact('etudiant', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $etudiant = Etudiants::findOrFail($id);
        
        $validated = $request->validate([
            'CodeE' => 'required|string|max:255|unique:Etudiants,CodeE,' . $id . ',CodeE',
            'Nom' => 'required|string|max:50',
            'Prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:Etudiants,email,' . $id . ',CodeE',
            'CodeC' => 'required|exists:Classes,CodeC',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Etudiants::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }

    /**
     * Get students by class (API endpoint)
     */
    public function getByClasse(string $codeC)
    {
        $etudiants = Etudiants::where('CodeC', $codeC)
            ->orderBy('Nom')
            ->orderBy('Prenom')
            ->get(['CodeE', 'Nom', 'Prenom', 'email']);

        return response()->json($etudiants);
    }
}
