# Modifications apportées à la table Cours (Séances)

## 1. Ajout du champ "Valide"

### Migration créée
- **Fichier :** `database/migrations/2026_01_20_090638_add_valide_to_cours_table.php`
- **Action :** Ajout d'une colonne `Valide` de type boolean avec valeur par défaut `false`

### Commande exécutée
```bash
php artisan migrate
```

La colonne `Valide` a été ajoutée avec succès à la table `Cours`.

## 2. Règles de gestion implémentées

### Règle 1 : Validation des séances par la Direction
- **Par défaut :** Lorsqu'un enseignant crée une séance, le champ `Valide` est automatiquement mis à `false`
- **Validation :** Seule la Direction peut valider une séance (en mettant `Valide` à `true`)
- **Implémentation :** Configuré dans le modèle `app/Models/Cours.php` via l'attribut `$attributes`

```php
protected $attributes = [
    'Valide' => false,
];
```

### Règle 2 : Calcul automatique de la durée
- **Automatisation :** La durée n'est plus saisie manuellement
- **Calcul :** Elle est calculée automatiquement par la différence entre `HeureFin` et `HeureDebut`
- **Implémentation :** Event `saving` dans le modèle `Cours`

```php
protected static function boot()
{
    parent::boot();

    static::saving(function ($cours) {
        if ($cours->HeureDebut && $cours->HeureFin) {
            $debut = Carbon::parse($cours->HeureDebut);
            $fin = Carbon::parse($cours->HeureFin);
            $cours->Duree = $fin->diffInHours($debut, true);
        }
    });
}
```

## 3. Modifications du modèle Cours

### Fichier modifié
`app/Models/Cours.php`

### Modifications apportées :
1. **Ajout de l'import Carbon :**
   ```php
   use Carbon\Carbon;
   ```

2. **Ajout de 'Valide' dans $fillable :**
   ```php
   protected $fillable = [
       'NumC', 'CodeE', 'CodeC', 'CodeM', 'Type', 
       'Jour', 'HeureDebut', 'HeureFin', 'Duree', 'NbAbsent', 'Valide'
   ];
   ```

3. **Ajout du cast pour 'Valide' :**
   ```php
   protected $casts = [
       'Jour' => 'date',
       'Valide' => 'boolean',
   ];
   ```

4. **Ajout de la valeur par défaut :**
   ```php
   protected $attributes = [
       'Valide' => false,
   ];
   ```

5. **Ajout de la méthode boot() pour le calcul automatique :**
   - Écoute l'événement `saving`
   - Calcule automatiquement la durée avant chaque sauvegarde
   - Utilise la différence en heures entre HeureFin et HeureDebut

## 4. Utilisation

### Création d'une séance
Lors de la création d'une séance, vous n'avez plus besoin de :
- ❌ Saisir la durée manuellement
- ❌ Définir le champ Valide

Le système gère automatiquement :
- ✅ Le calcul de la durée
- ✅ La valeur par défaut de Valide (false)

### Validation d'une séance
Pour valider une séance (réservé à la Direction) :
```php
$cours = Cours::find($id);
$cours->Valide = true;
$cours->save();
```

### Exemple de création de séance
```php
Cours::create([
    'CodeE' => 'ENS001',
    'CodeC' => 'CLS001',
    'CodeM' => 'MAT001',
    'Type' => 'C',
    'Jour' => '2026-01-20',
    'HeureDebut' => '08:00:00',
    'HeureFin' => '10:00:00',
    // Duree sera calculé automatiquement (2.0)
    // Valide sera false par défaut
]);
```

## 5. Workflow complet

1. **Enseignant crée une séance**
   - Saisit : CodeE, CodeC, CodeM, Type, Jour, HeureDebut, HeureFin
   - Le système calcule automatiquement la Durée
   - Le champ Valide est mis à `false` par défaut

2. **Direction valide la séance**
   - La Direction consulte les séances non validées
   - Elle vérifie les informations
   - Elle met le champ Valide à `true`

3. **Séance validée**
   - La séance est maintenant validée
   - Elle peut être utilisée dans les statistiques et rapports officiels

## 6. Recommandations

Pour une mise en œuvre complète, vous devriez :

1. **Créer des méthodes de scope dans le modèle :**
   ```php
   // Dans app/Models/Cours.php
   public function scopeValides($query)
   {
       return $query->where('Valide', true);
   }

   public function scopeNonValides($query)
   {
       return $query->where('Valide', false);
   }
   ```

2. **Ajouter des contrôles d'autorisation :**
   - Vérifier que seule la Direction peut valider
   - Empêcher les enseignants de modifier leurs séances une fois validées

3. **Interface utilisateur :**
   - Afficher un badge "Validé" / "En attente" sur les séances
   - Créer une vue pour la Direction listant les séances à valider
   - Ajouter un bouton "Valider" pour la Direction

4. **Notifications :**
   - Notifier la Direction quand une nouvelle séance est créée
   - Notifier l'enseignant quand sa séance est validée
