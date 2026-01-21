# Fonctionnalité de Recherche et Filtrage

## Vue d'ensemble

La recherche et le filtrage sont implémentés **côté client** en JavaScript pour une expérience utilisateur fluide et réactive, sans rechargement de page.

## Pages concernées

### 1. Liste des Classes (`/classes`)
- **Recherche** : Par nom de classe ou code (ex: "Groupe 101", "CI101")
- **Filtre** : Par département
- **Fichiers** :
  - Vue : `resources/views/classes/index.blade.php`
  - Contrôleur : `app/Http/Controllers/ClassesController.php`

### 2. Liste des Étudiants (`/etudiants`)
- **Recherche** : Par nom, prénom, email ou code étudiant
- **Filtre** : Par classe
- **Fichiers** :
  - Vue : `resources/views/etudiants/index.blade.php`
  - Contrôleur : `app/Http/Controllers/EtudiantsController.php`

### 3. Gestion des Absences (`/absence`)
- **Recherche** : Par nom/prénom d'étudiant, nom du cours ou classe
- **Pas de filtre** pour cette page
- **Fichiers** :
  - Vue : `resources/views/absence/index.blade.php`
  - Contrôleur : `app/Http/Controllers/AbsenceController.php`

## Fonctionnement technique

### JavaScript (`resources/js/search.js`)
- **Debounce** : Délai de 300ms pour optimiser les performances
- **Normalisation du texte** : Suppression des accents et conversion en minuscules
- **Filtrage en temps réel** : Les résultats apparaissent au fur et à mesure de la saisie
- **Message "Aucun résultat"** : Affiché automatiquement si aucune correspondance

### Attributs HTML (data-*)
Les vues utilisent des attributs `data-*` pour permettre au JavaScript d'identifier les éléments :

#### Classes
```html
<input data-search="classes" />
<select data-filter="classes" />
<tbody data-table="classes">
  <tr data-departement="D01">
    <span data-nom>Groupe 101</span>
    <span data-code>CI101</span>
  </tr>
</tbody>
```

#### Étudiants
```html
<input data-search="etudiants" />
<select data-filter="etudiants" />
<tbody data-table="etudiants">
  <tr data-classe="CI101">
    <span data-prenom>Jean</span>
    <span data-nom>Dupont</span>
    <span data-code>E001</span>
    <span data-email>jean@example.com</span>
  </tr>
</tbody>
```

#### Absences
```html
<input data-search="absences" />
<tbody data-table="absences">
  <tr>
    <span data-etudiant-prenom>Jean</span>
    <span data-etudiant-nom>Dupont</span>
    <span data-etudiant-code>E001</span>
    <span data-cours>Mathématiques</span>
    <span data-classe>Groupe 101</span>
  </tr>
</tbody>
```

## Avantages de l'approche côté client

1. **Performance** : Pas de requête serveur à chaque frappe
2. **Réactivité** : Résultats instantanés (après le debounce)
3. **Expérience utilisateur** : Pas de rechargement de page
4. **Simplicité** : Moins de complexité côté serveur
5. **Offline-capable** : Fonctionne même avec une connexion lente

## Compilation des assets

Pour appliquer les modifications JavaScript :

```bash
# En développement (avec hot reload)
npm run dev

# En production
npm run build
```

## Notes importantes

- Les données sont chargées **une seule fois** depuis le serveur (pas de pagination côté serveur)
- La recherche est **insensible aux accents** et à la casse
- Le filtrage se combine avec la recherche pour affiner les résultats
