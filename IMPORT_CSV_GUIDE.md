# Guide d'importation CSV des Avancements

## Vue d'ensemble

Cette fonctionnalité permet aux administrateurs d'importer en masse les données d'avancement à partir d'un fichier CSV. Le système gère automatiquement la création des entités manquantes (enseignants, classes, matières) avant d'insérer les avancements.

## Format du fichier CSV

### Structure requise

Le fichier CSV doit contenir exactement 3 colonnes dans cet ordre :

```csv
Enseignant,Classe,CodeMatiere
2501,Cl101,Mat102
2502,Cl102,Mat103
2503,Cl103,Mat104
```

### Règles importantes

1. **En-tête obligatoire** : La première ligne doit contenir les noms des colonnes
2. **Séparateur** : Virgule (`,`)
3. **Encodage** : UTF-8 recommandé
4. **Taille maximale** : 2 MB

## Processus d'importation

### Étape 1 : Préparation des données

Le système effectue les opérations suivantes automatiquement :

1. **Extraction des enseignants uniques** du CSV
2. **Extraction des classes uniques** du CSV
3. **Extraction des matières uniques** du CSV
4. **Validation** de chaque ligne

### Étape 2 : Insertion intelligente

Le système insère les données dans l'ordre suivant :

#### 1. Enseignants manquants
- Vérifie si l'enseignant existe déjà (par CodeE)
- Si non existant, crée l'enseignant avec :
  - `CodeE` : Code du CSV
  - `NomE` : "Enseignant {CodeE}"
  - `PrenomE` : "Importé"
  - `GradeE` : "Non spécifié"
  - `SpecialiteE` : "Non spécifiée"

#### 2. Classes manquantes
- Vérifie si la classe existe déjà (par CodeC)
- Si non existante, crée la classe avec :
  - `CodeC` : Code du CSV
  - `NomC` : "Classe {CodeC}"
  - `NiveauC` : "Non spécifié"
  - `CodeD` : Premier département disponible

⚠️ **Important** : Au moins un département doit exister dans la base de données avant l'import !

#### 3. Matières manquantes
- Vérifie si la matière existe déjà (par CodeM)
- Si non existante, crée la matière avec :
  - `CodeM` : Code du CSV
  - `NomM` : "Matière {CodeM}"
  - `CoeffM` : 1
  - `VolumeHoraireM` : 0
  - `CodeD` : Premier département disponible

#### 4. Avancements
- Vérifie si l'avancement existe déjà (par CodeE, CodeC, CodeM)
- Si non existant, crée l'avancement avec :
  - `CodeE`, `CodeC`, `CodeM` : Valeurs du CSV
  - `NbrHeuresEffectuees` : 0
  - `NbrHeuresRestantes` : 0

### Étape 3 : Rapport d'importation

Après l'importation, un message détaillé affiche :
- Nombre d'enseignants ajoutés / total unique
- Nombre de classes ajoutées / total unique
- Nombre de matières ajoutées / total unique
- Nombre d'avancements ajoutés / total
- Éventuelles erreurs rencontrées

## Utilisation via l'interface

1. **Connectez-vous** en tant qu'administrateur
2. **Accédez** à la page Avancement (`/avancement`)
3. **Cliquez** sur le bouton "Importer CSV"
4. **Sélectionnez** votre fichier CSV
5. **Cliquez** sur "Importer le fichier"
6. **Consultez** le rapport d'importation

## Exemple de fichier CSV

Un fichier d'exemple peut être téléchargé directement depuis la page d'importation.

```csv
Enseignant,Classe,CodeMatiere
2501,Cl101,Mat102
2502,Cl102,Mat103
2503,Cl103,Mat104
2504,Cl104,Mat105
2505,Cl105,Mat106
2506,Cl106,Mat101
2507,Cl101,Mat102
2508,Cl102,Mat103
2509,Cl103,Mat104
1010,Cl104,Mat105
2501,Cl102,Mat106
2502,Cl106,Mat101
2503,Cl101,Mat102
2504,Cl102,Mat103
2505,Cl103,Mat104
```

## Gestion des erreurs

Le système utilise des transactions pour garantir l'intégrité des données :

- **Si une erreur survient** : Toutes les opérations sont annulées (rollback)
- **Doublons** : Les entrées déjà existantes sont ignorées
- **Lignes invalides** : Les lignes avec des données manquantes sont ignorées
- **Erreurs de validation** : Un message détaillé est affiché

## Sécurité

- ✅ Accessible uniquement aux administrateurs
- ✅ Validation du type de fichier (CSV uniquement)
- ✅ Limite de taille de fichier (2 MB)
- ✅ Protection CSRF
- ✅ Authentification requise

## Bonnes pratiques

1. **Créez d'abord un département** si aucun n'existe
2. **Testez avec un petit fichier** avant un import massif
3. **Vérifiez le format** de votre CSV avant l'upload
4. **Consultez le rapport** après chaque import
5. **Complétez les données** des entités auto-créées après l'import

## Codes d'erreur courants

| Erreur | Cause | Solution |
|--------|-------|----------|
| "Format CSV invalide" | En-tête manquant ou incorrect | Vérifiez la première ligne du CSV |
| "Aucun département trouvé" | Base de données vide | Créez au moins un département |
| "Fichier trop volumineux" | Fichier > 2 MB | Divisez le fichier en plusieurs parties |
| "Type de fichier invalide" | Extension non .csv | Sauvegardez au format CSV |

## Support technique

Pour toute question ou problème, contactez l'administrateur système.
