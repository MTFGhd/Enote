# Référence Rapide - API Direction

## 🔗 Routes disponibles

### Validation de séances
```php
POST /cours/{id}/valider
```
- **Middleware** : `auth`, `check.role:D`
- **Contrôleur** : `CoursController@valider`
- **Paramètres** : `id` (NumC de la séance)
- **Retour** : Redirection avec message de succès

### PDF - Séances validées
```php
GET  /cours-pdf/seances/form
POST /cours-pdf/seances
```
- **Middleware** : `auth`, `check.role:D`
- **Contrôleur** : `CoursController@pdfSeancesForm` et `pdfSeances`
- **Paramètres POST** : 
  - `date_debut` (required|date)
  - `date_fin` (required|date|after_or_equal:date_debut)
- **Retour** : Téléchargement PDF

### PDF - Avancement
```php
GET  /cours-pdf/avancement/form
POST /cours-pdf/avancement
```
- **Middleware** : `auth`, `check.role:D`
- **Contrôleur** : `CoursController@pdfAvancementForm` et `pdfAvancement`
- **Paramètres POST** (tous optionnels) :
  - `code_e` (nullable|exists:Enseignants,CodeE)
  - `code_c` (nullable|exists:Classes,CodeC)
  - `code_m` (nullable|exists:Matieres,CodeM)
- **Retour** : Téléchargement PDF

---

## 📋 Méthodes du contrôleur

### CoursController::index()
```php
public function index()
```
**Modification** : Ajout du filtrage par statut de validation
- Paramètre GET `valide` : '0' (non validées) | '1' (validées) | vide (toutes)
- Filtre appliqué uniquement pour le rôle Direction

### CoursController::valider()
```php
public function valider(string $id)
```
**Fonction** : Valider une séance
- Vérifie le rôle Direction
- Met à jour `Valide = true`
- Retour : Redirection avec message

### CoursController::pdfSeancesForm()
```php
public function pdfSeancesForm()
```
**Fonction** : Afficher le formulaire de sélection de période
- Retour : Vue `cours.pdf-seances-form`

### CoursController::pdfSeances()
```php
public function pdfSeances(Request $request)
```
**Fonction** : Générer le PDF des séances validées
- Validation des dates
- Requête : Séances validées entre date_debut et date_fin
- Génération PDF avec DomPDF
- Retour : Download PDF

### CoursController::pdfAvancementForm()
```php
public function pdfAvancementForm()
```
**Fonction** : Afficher le formulaire de filtrage avancement
- Charge : enseignants, classes, matieres
- Retour : Vue `cours.pdf-avancement-form`

### CoursController::pdfAvancement()
```php
public function pdfAvancement(Request $request)
```
**Fonction** : Générer le PDF de l'avancement
- Validation des codes
- Filtrage optionnel par CodeE, CodeC, CodeM
- Génération PDF avec DomPDF
- Retour : Download PDF

---

## 🗄️ Modèle Cours

### Attributs
```php
protected $fillable = [
    'NumC', 'CodeE', 'CodeC', 'CodeM', 'Type', 
    'Jour', 'HeureDebut', 'HeureFin', 'Duree', 'NbAbsent', 'Valide'
];

protected $casts = [
    'Jour' => 'date',
    'Valide' => 'boolean',
];

protected $attributes = [
    'Valide' => false, // Par défaut non validée
];
```

### Relations
- `enseignant()` : BelongsTo Enseignants
- `classe()` : BelongsTo Classes
- `matiere()` : BelongsTo Matieres

---

## 🎨 Vues

### Formulaires
| Vue | Description | Champs |
|-----|-------------|--------|
| `cours.pdf-seances-form` | Formulaire période séances | date_debut, date_fin |
| `cours.pdf-avancement-form` | Formulaire filtrage avancement | code_e, code_c, code_m |

### Templates PDF
| Vue | Description | Variables |
|-----|-------------|-----------|
| `cours.pdf-seances` | PDF séances validées | $cours, $dateDebut, $dateFin |
| `cours.pdf-avancement` | PDF avancement | $avancements, $filters |

### Vues modifiées
- `cours.index` : Filtrage + Validation + Bouton PDF
- `avancement.index` : Bouton PDF

---

## 🔐 Sécurité

### Middleware appliqué
```php
Route::middleware('check.role:D')->group(function () {
    // Routes Direction
});
```

### Vérifications dans le contrôleur
```php
if ($user->role !== 'D') {
    abort(403, 'Accès non autorisé.');
}
```

---

## 📦 Dépendances

### Package DomPDF
```bash
composer require barryvdh/laravel-dompdf
```

### Import dans le contrôleur
```php
use Barryvdh\DomPDF\Facade\Pdf;
```

### Utilisation
```php
$pdf = Pdf::loadView('view.name', $data);
return $pdf->download('filename.pdf');
```

---

## 🎯 Exemples d'utilisation

### Filtrer les séances non validées
```
GET /cours?valide=0
```

### Valider une séance
```
POST /cours/123/valider
```

### Générer PDF séances (01/01 au 31/01)
```
POST /cours-pdf/seances
{
    "date_debut": "2026-01-01",
    "date_fin": "2026-01-31"
}
```

### Générer PDF avancement pour un formateur
```
POST /cours-pdf/avancement
{
    "code_e": "ENS001",
    "code_c": "",
    "code_m": ""
}
```

---

## 🧪 Tests (suggestions)

### Test de validation
```php
test('direction can validate session', function () {
    $user = User::factory()->create(['role' => 'D']);
    $cours = Cours::factory()->create(['Valide' => false]);
    
    actingAs($user)
        ->post("/cours/{$cours->NumC}/valider")
        ->assertRedirect()
        ->assertSessionHas('success');
    
    expect($cours->fresh()->Valide)->toBeTrue();
});
```

### Test de génération PDF
```php
test('direction can generate seances pdf', function () {
    $user = User::factory()->create(['role' => 'D']);
    
    actingAs($user)
        ->post('/cours-pdf/seances', [
            'date_debut' => '2026-01-01',
            'date_fin' => '2026-01-31'
        ])
        ->assertDownload();
});
```

---

**📝 Note** : Cette référence est destinée aux développeurs pour une consultation rapide.
