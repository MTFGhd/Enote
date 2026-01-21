<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Etudiants;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absences = Absence::with('etudiant', 'cours.matiere', 'cours.classe')->get();
        return view('absence.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiants::all();
        $cours = Cours::with('classe', 'matiere')->get();
        return view('absence.create', compact('etudiants', 'cours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CodeE' => 'required|exists:Etudiants,CodeE',
            'NumC' => 'required|exists:Cours,NumC',
            'Jour' => 'required|date',
            'Duree' => 'required|numeric|min:0',
        ]);

        Absence::create($validated);

        return redirect()->route('absence.index')
            ->with('success', 'Absence enregistrée avec succès.');
    }

    /**
     * Enregistrer les absences lors de la saisie d'une séance
     */
    public function storeMultiple(Request $request, $coursId)
    {
        $validated = $request->validate([
            'absents' => 'nullable|array',
            'absents.*' => 'exists:Etudiants,CodeE',
        ]);

        $cours = Cours::findOrFail($coursId);

        // Supprimer les anciennes absences pour ce cours
        Absence::where('NumC', $coursId)->delete();

        // Enregistrer les nouvelles absences
        if (!empty($validated['absents'])) {
            foreach ($validated['absents'] as $codeE) {
                Absence::create([
                    'CodeE' => $codeE,
                    'NumC' => $coursId,
                    'Jour' => $cours->Jour,
                    'Duree' => $cours->Duree,
                ]);
            }
        }

        // Mettre à jour le nombre d'absents dans le cours
        $cours->NbAbsent = count($validated['absents'] ?? []);
        $cours->save();

        return redirect()->route('cours.show', $coursId)
            ->with('success', 'Absences enregistrées avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codeE, string $numC)
    {
        $absence = Absence::where('CodeE', $codeE)
            ->where('NumC', $numC)
            ->with('etudiant', 'cours')
            ->firstOrFail();
        
        return view('absence.show', compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $codeE, string $numC)
    {
        $absence = Absence::where('CodeE', $codeE)
            ->where('NumC', $numC)
            ->firstOrFail();
        
        $etudiants = Etudiants::all();
        $cours = Cours::all();
        
        return view('absence.edit', compact('absence', 'etudiants', 'cours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codeE, string $numC)
    {
        $absence = Absence::where('CodeE', $codeE)
            ->where('NumC', $numC)
            ->firstOrFail();

        $validated = $request->validate([
            'Jour' => 'required|date',
            'Duree' => 'required|numeric|min:0',
        ]);

        $absence->update($validated);

        return redirect()->route('absence.index')
            ->with('success', 'Absence modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codeE, string $numC)
    {
        $absence = Absence::where('CodeE', $codeE)
            ->where('NumC', $numC)
            ->firstOrFail();
        
        $absence->delete();

        return redirect()->route('absence.index')
            ->with('success', 'Absence supprimée avec succès.');
    }
}
