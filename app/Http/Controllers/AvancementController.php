<?php

namespace App\Http\Controllers;

use App\Models\Avancement;
use App\Models\Enseignants;
use App\Models\Classes;
use App\Models\Matieres;
use App\Models\Departements;
use App\Http\Requests\AvancementRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AvancementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Role E (Enseignant) : Consulter l'avancement par classe et par matière
        if ($user->role === 'E') {
            $avancements = Avancement::with('enseignant', 'classe', 'matiere')
                ->where('CodeE', $user->CodeE)
                ->get();
        } 
        // Role D (Direction) ou admin : Consulter tout l'avancement
        else {
            $avancements = Avancement::with('enseignant', 'classe', 'matiere')->get();
        }
        
        return view('avancement.index', compact('avancements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        // Seuls les admins peuvent créer des avancements
        if ($user->role !== 'admin') {
            abort(403, 'Seul l\'administrateur peut créer des avancements.');
        }
        
        $enseignants = Enseignants::all();
        $classes = Classes::all();
        $matieres = Matieres::all();
        return view('avancement.create', compact('enseignants', 'classes', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvancementRequest $request)
    {
        $user = Auth::user();
        
        // Seuls les admins peuvent créer des avancements
        if ($user->role !== 'admin') {
            abort(403, 'Seul l\'administrateur peut créer des avancements.');
        }
        
        $validated = $request->validated();

        // Check if avancement already exists
        $exists = Avancement::where('CodeE', $validated['CodeE'])
            ->where('CodeC', $validated['CodeC'])
            ->where('CodeM', $validated['CodeM'])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Cet avancement existe déjà.']);
        }

        Avancement::create($validated);

        return redirect()->route('avancement.index')
            ->with('success', 'Avancement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codeE, string $codeC, string $codeM)
    {
        $user = Auth::user();
        
        $avancement = Avancement::with('enseignant', 'classe', 'matiere')
            ->where('CodeE', $codeE)
            ->where('CodeC', $codeC)
            ->where('CodeM', $codeM)
            ->firstOrFail();
        
        // Enseignant ne peut consulter que son propre avancement
        if ($user->role === 'E' && $avancement->CodeE !== $user->CodeE) {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('avancement.show', compact('avancement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $codeE, string $codeC, string $codeM)
    {
        $user = Auth::user();
        
        // Seul l'admin peut modifier
        if ($user->role !== 'admin') {
            abort(403, 'Seul l\'administrateur peut modifier les avancements.');
        }
        
        $avancement = Avancement::where('CodeE', $codeE)
            ->where('CodeC', $codeC)
            ->where('CodeM', $codeM)
            ->firstOrFail();
        
        $enseignants = Enseignants::all();
        $classes = Classes::all();
        $matieres = Matieres::all();
        
        return view('avancement.edit', compact('avancement', 'enseignants', 'classes', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvancementRequest $request, string $codeE, string $codeC, string $codeM)
    {
        $user = Auth::user();
        
        // Seul l'admin peut modifier
        if ($user->role !== 'admin') {
            abort(403, 'Seul l\'administrateur peut modifier les avancements.');
        }
        
        $avancement = Avancement::where('CodeE', $codeE)
            ->where('CodeC', $codeC)
            ->where('CodeM', $codeM)
            ->firstOrFail();

        $validated = $request->validated();
        $avancement->update($validated);

        return redirect()->route('avancement.index')
            ->with('success', 'Avancement modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codeE, string $codeC, string $codeM)
    {
        $user = Auth::user();
        
        // Seul l'admin peut supprimer
        if ($user->role !== 'admin') {
            abort(403, 'Seul l\'administrateur peut supprimer des avancements.');
        }
        
        $avancement = Avancement::where('CodeE', $codeE)
            ->where('CodeC', $codeC)
            ->where('CodeM', $codeM)
            ->firstOrFail();
        
        $avancement->delete();

        return redirect()->route('avancement.index')
            ->with('success', 'Avancement supprimé avec succès.');
    }

    /**
     * Afficher le formulaire d'importation CSV
     */
    public function showImportForm()
    {
        return view('avancement.import');
    }

    /**
     * Traiter l'importation du fichier CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file->getRealPath()));
            
            // Supprimer l'en-tête
            $header = array_shift($csvData);
            
            // Vérifier le format de l'en-tête
            if (!$header || count($header) < 3) {
                throw new \Exception('Format CSV invalide. L\'en-tête doit contenir: Enseignant,Classe,CodeMatiere');
            }

            // Extraire les données uniques pour pré-insertion
            $enseignants = [];
            $classes = [];
            $matieres = [];
            $avancements = [];

            foreach ($csvData as $row) {
                if (count($row) < 3) continue; // Ignorer les lignes invalides
                
                $codeE = trim($row[0]);
                $codeC = trim($row[1]);
                $codeM = trim($row[2]);

                if (empty($codeE) || empty($codeC) || empty($codeM)) continue;

                // Collecter les données uniques
                $enseignants[$codeE] = $codeE;
                $classes[$codeC] = $codeC;
                $matieres[$codeM] = $codeM;
                
                $avancements[] = [
                    'CodeE' => $codeE,
                    'CodeC' => $codeC,
                    'CodeM' => $codeM,
                ];
            }

            // Statistiques
            $stats = [
                'enseignants_total' => count($enseignants),
                'classes_total' => count($classes),
                'matieres_total' => count($matieres),
                'avancements_total' => count($avancements),
                'enseignants_inseres' => 0,
                'classes_inserees' => 0,
                'matieres_inserees' => 0,
                'avancements_inseres' => 0,
                'erreurs' => [],
            ];

            // 1. Insérer les enseignants manquants
            foreach ($enseignants as $codeE) {
                $exists = Enseignants::where('CodeE', $codeE)->exists();
                if (!$exists) {
                    Enseignants::create([
                        'CodeE' => $codeE,
                        'NomE' => 'Enseignant ' . $codeE,
                        'PrenomE' => 'Importé',
                        'GradeE' => 'Non spécifié',
                        'SpecialiteE' => 'Non spécifiée',
                    ]);
                    $stats['enseignants_inseres']++;
                }
            }

            // 2. Insérer les classes manquantes
            // Récupérer le premier département pour les classes importées
            $premierDepartement = Departements::first();
            if (!$premierDepartement) {
                throw new \Exception('Aucun département trouvé. Veuillez créer au moins un département avant l\'import.');
            }

            foreach ($classes as $codeC) {
                $exists = Classes::where('CodeC', $codeC)->exists();
                if (!$exists) {
                    Classes::create([
                        'CodeC' => $codeC,
                        'NomC' => 'Classe ' . $codeC,
                        'NiveauC' => 'Non spécifié',
                        'CodeD' => $premierDepartement->CodeD,
                    ]);
                    $stats['classes_inserees']++;
                }
            }

            // 3. Insérer les matières manquantes
            foreach ($matieres as $codeM) {
                $exists = Matieres::where('CodeM', $codeM)->exists();
                if (!$exists) {
                    Matieres::create([
                        'CodeM' => $codeM,
                        'NomM' => 'Matière ' . $codeM,
                        'CoeffM' => 1,
                        'VolumeHoraireM' => 0,
                        'CodeD' => $premierDepartement->CodeD,
                    ]);
                    $stats['matieres_inserees']++;
                }
            }

            // 4. Insérer les avancements
            foreach ($avancements as $avancementData) {
                try {
                    // Vérifier si l'avancement existe déjà
                    $exists = Avancement::where('CodeE', $avancementData['CodeE'])
                        ->where('CodeC', $avancementData['CodeC'])
                        ->where('CodeM', $avancementData['CodeM'])
                        ->exists();

                    if (!$exists) {
                        Avancement::create([
                            'CodeE' => $avancementData['CodeE'],
                            'CodeC' => $avancementData['CodeC'],
                            'CodeM' => $avancementData['CodeM'],
                            'NbrHeuresEffectuees' => 0,
                            'NbrHeuresRestantes' => 0,
                        ]);
                        $stats['avancements_inseres']++;
                    }
                } catch (\Exception $e) {
                    $stats['erreurs'][] = "Erreur pour {$avancementData['CodeE']}/{$avancementData['CodeC']}/{$avancementData['CodeM']}: " . $e->getMessage();
                }
            }

            DB::commit();

            $message = "Import réussi ! ";
            $message .= "{$stats['enseignants_inseres']} enseignant(s) ajouté(s) sur {$stats['enseignants_total']}, ";
            $message .= "{$stats['classes_inserees']} classe(s) ajoutée(s) sur {$stats['classes_total']}, ";
            $message .= "{$stats['matieres_inserees']} matière(s) ajoutée(s) sur {$stats['matieres_total']}, ";
            $message .= "{$stats['avancements_inseres']} avancement(s) ajouté(s) sur {$stats['avancements_total']}.";

            if (!empty($stats['erreurs'])) {
                $message .= " Avertissements: " . implode('; ', array_slice($stats['erreurs'], 0, 3));
            }

            return redirect()->route('avancement.index')
                ->with('success', $message)
                ->with('stats', $stats);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'importation: ' . $e->getMessage())
                ->withInput();
        }
    }
}
