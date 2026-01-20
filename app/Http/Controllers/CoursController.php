<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Enseignants;
use App\Models\Classes;
use App\Models\Matieres;
use App\Models\Avancement;
use App\Http\Requests\CoursRequest;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Role E (Enseignant) : Consulter ses séances uniquement
        if ($user->role === 'E') {
            $cours = Cours::with('enseignant', 'classe', 'matiere')
                ->where('CodeE', $user->CodeE)
                ->get();
        }
        // Role D (Direction) ou admin : Consulter toutes les séances
        else {
            $cours = Cours::with('enseignant', 'classe', 'matiere')->get();
        }

        return view('cours.index', compact('cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Seuls les enseignants et admins peuvent créer des cours
        if (!in_array($user->role, ['E', 'admin'])) {
            abort(403, 'Seuls les enseignants peuvent saisir une séance.');
        }

        $enseignants = Enseignants::all();

        if ($user->role === 'E') {
            // Vérifier si l'utilisateur est bien lié à un enseignant
            if (empty($user->CodeE)) {
                return redirect()->route('cours.index')
                    ->with('error', 'Votre compte utilisateur n\'est pas lié à une fiche enseignant. Veuillez contacter l\'administrateur.');
            }

            // Pour un enseignant, on ne propose que ses matières et ses classes (via Avancement)
            $avancements = Avancement::where('CodeE', $user->CodeE)->get(['CodeC', 'CodeM']);

            if ($avancements->isEmpty()) {
                return redirect()->route('cours.index')
                    ->with('error', 'Aucune classe ni matière ne vous est affectée. Veuillez contacter l\'administrateur pour configurer vos avancements.');
            }

            $classesIds = $avancements->pluck('CodeC')->unique();
            $matieresIds = $avancements->pluck('CodeM')->unique();

            $classes = Classes::whereIn('CodeC', $classesIds)->get();
            $matieres = Matieres::whereIn('CodeM', $matieresIds)->get();
        } else {
            $classes = Classes::all();
            $matieres = Matieres::all();
        }

        return view('cours.create', compact('enseignants', 'classes', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursRequest $request)
    {
        $user = Auth::user();

        // Seuls les enseignants et admins peuvent créer des cours
        if (!in_array($user->role, ['E', 'admin'])) {
            abort(403, 'Seuls les enseignants peuvent saisir une séance.');
        }

        $validated = $request->validated();

        // Si c'est un enseignant, vérifier qu'il crée son propre cours
        if ($user->role === 'E' && $validated['CodeE'] !== $user->CodeE) {
            abort(403, 'Vous ne pouvez créer que vos propres séances.');
        }

        Cours::create($validated);

        return redirect()->route('cours.index')
            ->with('success', 'Cours créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $cours = Cours::with('enseignant', 'classe', 'matiere')->findOrFail($id);

        // Enseignant ne peut consulter que ses propres séances
        if ($user->role === 'E' && $cours->CodeE !== $user->CodeE) {
            abort(403, 'Accès non autorisé.');
        }

        return view('cours.show', compact('cours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $cours = Cours::findOrFail($id);

        // Seuls les enseignants et admins peuvent éditer
        if (!in_array($user->role, ['E', 'admin'])) {
            abort(403, 'Accès non autorisé.');
        }

        // Enseignant ne peut éditer que ses propres séances
        if ($user->role === 'E' && $cours->CodeE !== $user->CodeE) {
            abort(403, 'Vous ne pouvez modifier que vos propres séances.');
        }

        $enseignants = Enseignants::all();

        if ($user->role === 'E') {
            // Vérifier si l'utilisateur est bien lié à un enseignant
            if (empty($user->CodeE)) {
                return redirect()->route('cours.index')
                    ->with('error', 'Votre compte utilisateur n\'est pas lié à une fiche enseignant.');
            }

            // Pour un enseignant, on ne propose que ses matières et ses classes (via Avancement)
            // + celles du cours actuel au cas où elles ne seraient plus dans Avancement
            $avancements = Avancement::where('CodeE', $user->CodeE)->get(['CodeC', 'CodeM']);

            $classesIds = $avancements->pluck('CodeC')->push($cours->CodeC)->unique();
            $matieresIds = $avancements->pluck('CodeM')->push($cours->CodeM)->unique();

            $classes = Classes::whereIn('CodeC', $classesIds)->get();
            $matieres = Matieres::whereIn('CodeM', $matieresIds)->get();
        } else {
            $classes = Classes::all();
            $matieres = Matieres::all();
        }

        return view('cours.edit', compact('cours', 'enseignants', 'classes', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursRequest $request, string $id)
    {
        $user = Auth::user();
        $cours = Cours::findOrFail($id);

        // Seuls les enseignants et admins peuvent modifier
        if (!in_array($user->role, ['E', 'admin'])) {
            abort(403, 'Accès non autorisé.');
        }

        // Enseignant ne peut modifier que ses propres séances
        if ($user->role === 'E' && $cours->CodeE !== $user->CodeE) {
            abort(403, 'Vous ne pouvez modifier que vos propres séances.');
        }

        $validated = $request->validated();
        $cours->update($validated);

        return redirect()->route('cours.index')
            ->with('success', 'Cours modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        // Seul l'admin peut supprimer
        if ($user->role !== 'admin') {
            abort(403, 'Seul l\'administrateur peut supprimer des séances.');
        }

        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cours.index')
            ->with('success', 'Cours supprimé avec succès.');
    }
}
