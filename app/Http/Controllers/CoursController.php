<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Enseignants;
use App\Models\Classes;
use App\Models\Matieres;
use App\Models\Avancement;
use App\Models\Absence;
use App\Http\Requests\CoursRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        // Role D (Direction) ou admin : Consulter toutes les séances avec filtre
        else {
            $query = Cours::with('enseignant', 'classe', 'matiere');
            
            // Pour le rôle Direction, permettre de filtrer par validation
            if ($user->role === 'D' && request()->has('valide')) {
                $valide = request()->get('valide');
                if ($valide === '1' || $valide === '0') {
                    $query->where('Valide', $valide === '1');
                }
            }
            
            $cours = $query->get();
        }

        return view('cours.index', compact('cours'));
    }

    /**
     * Valider une séance (Direction uniquement)
     */
    public function valider(string $id)
    {
        $user = Auth::user();

        // Seul le rôle Direction peut valider
        if ($user->role !== 'D') {
            abort(403, 'Seule la Direction peut valider des séances.');
        }

        $cours = Cours::findOrFail($id);
        $cours->Valide = true;
        $cours->save();

        return redirect()->back()
            ->with('success', 'Séance validée avec succès.');
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

        // Handle absences data
        $absents = $request->input('absents', []);
        
        // Set NbAbsent based on checked students
        $validated['NbAbsent'] = count($absents);

        $cours = Cours::create($validated);

        // Create individual absence records
        if (!empty($absents)) {
            foreach ($absents as $codeE) {
                Absence::create([
                    'CodeE' => $codeE,
                    'NumC' => $cours->NumC,
                    'Jour' => $cours->Jour,
                    'Duree' => $cours->Duree,
                ]);
            }
        }

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
        $cours = Cours::with('absences')->findOrFail($id);

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

        // Get existing absences for this course
        $existingAbsences = $cours->absences->pluck('CodeE')->toArray();

        return view('cours.edit', compact('cours', 'enseignants', 'classes', 'matieres', 'existingAbsences'));
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
        
        // Handle absences data
        $absents = $request->input('absents', []);
        
        // Set NbAbsent based on checked students
        $validated['NbAbsent'] = count($absents);
        
        $cours->update($validated);

        // Delete existing absences for this course
        Absence::where('NumC', $cours->NumC)->delete();

        // Create new absence records
        if (!empty($absents)) {
            foreach ($absents as $codeE) {
                Absence::create([
                    'CodeE' => $codeE,
                    'NumC' => $cours->NumC,
                    'Jour' => $cours->Jour,
                    'Duree' => $cours->Duree,
                ]);
            }
        }

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

    /**
     * Afficher le formulaire pour générer un PDF de séances validées
     */
    public function pdfSeancesForm()
    {
        $user = Auth::user();

        // Accessible uniquement par Direction
        if ($user->role !== 'D') {
            abort(403, 'Accès non autorisé.');
        }

        return view('cours.pdf-seances-form');
    }

    /**
     * Générer un PDF des séances validées dans une période
     */
    public function pdfSeances(Request $request)
    {
        $user = Auth::user();

        // Accessible uniquement par Direction
        if ($user->role !== 'D') {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $dateDebut = $request->date_debut;
        $dateFin = $request->date_fin;

        $cours = Cours::with('enseignant', 'classe', 'matiere')
            ->where('Valide', true)
            ->whereBetween('Jour', [$dateDebut, $dateFin])
            ->orderBy('Jour', 'asc')
            ->orderBy('HeureDebut', 'asc')
            ->get();

        $pdf = Pdf::loadView('cours.pdf-seances', [
            'cours' => $cours,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
        ]);

        return $pdf->download('seances_validees_' . $dateDebut . '_' . $dateFin . '.pdf');
    }

    /**
     * Afficher le formulaire pour générer un PDF d'avancement
     */
    public function pdfAvancementForm()
    {
        $user = Auth::user();

        // Accessible uniquement par Direction
        if ($user->role !== 'D') {
            abort(403, 'Accès non autorisé.');
        }

        $enseignants = Enseignants::all();
        $classes = Classes::all();
        $matieres = Matieres::all();

        return view('cours.pdf-avancement-form', compact('enseignants', 'classes', 'matieres'));
    }

    /**
     * Générer un PDF de l'avancement par Formateur/Groupe/Module
     */
    public function pdfAvancement(Request $request)
    {
        $user = Auth::user();

        // Accessible uniquement par Direction
        if ($user->role !== 'D') {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'code_e' => 'nullable|exists:Enseignants,CodeE',
            'code_c' => 'nullable|exists:Classes,CodeC',
            'code_m' => 'nullable|exists:Matieres,CodeM',
        ]);

        $query = Avancement::with('enseignant', 'classe', 'matiere');

        if ($request->filled('code_e')) {
            $query->where('CodeE', $request->code_e);
        }
        if ($request->filled('code_c')) {
            $query->where('CodeC', $request->code_c);
        }
        if ($request->filled('code_m')) {
            $query->where('CodeM', $request->code_m);
        }

        $avancements = $query->get();

        $pdf = Pdf::loadView('cours.pdf-avancement', [
            'avancements' => $avancements,
            'filters' => $request->only(['code_e', 'code_c', 'code_m']),
        ]);

        return $pdf->download('avancement_' . date('Y-m-d') . '.pdf');
    }
}
