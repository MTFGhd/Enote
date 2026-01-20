# Système d'Autorisation - Application Enote

## Rôles Disponibles

1. **admin** - Administrateur système
2. **E** - Enseignant
3. **D** - Direction

## Matrice des Autorisations

### Départements
- **Accès**: Admin uniquement
- **Actions**: CRUD complet

### Classes
- **Accès**: Admin uniquement
- **Actions**: CRUD complet

### Matières
- **Accès**: Admin uniquement
- **Actions**: CRUD complet

### Enseignants
- **Accès**: Admin uniquement
- **Actions**: CRUD complet

### Cours (Séances)

#### Rôle E (Enseignant)
- ✅ **Créer** une séance (uniquement pour lui-même)
- ✅ **Consulter** ses propres séances uniquement
- ✅ **Modifier** ses propres séances uniquement
- ❌ **Supprimer** - Non autorisé

#### Rôle D (Direction)
- ❌ **Créer** - Non autorisé
- ✅ **Consulter** toutes les séances de tous les enseignants
- ❌ **Modifier** - Non autorisé
- ❌ **Supprimer** - Non autorisé

#### Rôle Admin
- ✅ **CRUD complet** sur toutes les séances

### Avancement

#### Rôle E (Enseignant)
- ❌ **Créer** - Non autorisé
- ✅ **Consulter** son propre avancement par classe et par matière
- ❌ **Modifier** - Non autorisé
- ❌ **Supprimer** - Non autorisé

#### Rôle D (Direction)
- ❌ **Créer** - Non autorisé
- ✅ **Consulter** l'avancement par enseignant, par classe et par matière (tous)
- ❌ **Modifier** - Non autorisé
- ❌ **Supprimer** - Non autorisé

#### Rôle Admin
- ✅ **CRUD complet** sur tous les avancements

## Implémentation Technique

### Middleware CheckRole
Un middleware personnalisé a été créé pour gérer les autorisations basées sur les rôles:

```php
// Utilisation dans les routes
Route::middleware(['role:admin'])->group(function () {
    // Routes réservées aux admins
});

Route::middleware(['role:E,admin'])->group(function () {
    // Routes accessibles par Enseignants et Admins
});
```

### Form Requests
Chaque contrôleur utilise des FormRequest dédiés pour la validation:
- `DepartementsRequest`
- `ClassesRequest`
- `MatieresRequest`
- `EnseignantsRequest`
- `CoursRequest`
- `AvancementRequest`

### Contrôles dans les Contrôleurs
Les vérifications d'autorisation sont implémentées directement dans les méthodes des contrôleurs:
- Vérification du rôle utilisateur
- Vérification de propriété des ressources (pour les enseignants)
- Messages d'erreur appropriés (HTTP 403)

## Notes Importantes

1. **Liaison User-Enseignant**: La table `users` contient maintenant un champ `CodeE` (nullable) qui fait référence à la table `Enseignants`. Seuls les utilisateurs avec le rôle 'E' doivent avoir un `CodeE` renseigné.

2. **Migration ajoutée**: `2026_01_15_154719_add_code_e_to_users_table.php` ajoute la colonne `CodeE` avec une clé étrangère vers `Enseignants`.

3. **Modèle User**: Une relation `enseignant()` a été ajoutée au modèle User pour accéder facilement aux informations de l'enseignant.

4. **Messages Flash**: Les messages de succès sont envoyés via la session pour feedback utilisateur.

5. **Gestion des Erreurs**: Les erreurs 403 sont levées avec `abort(403, 'message')` pour accès non autorisé.
