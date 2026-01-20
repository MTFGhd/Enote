# Guide d'utilisation - Fonctionnalités Direction

## 🎯 Objectif
Ce guide explique comment utiliser les nouvelles fonctionnalités destinées aux utilisateurs ayant le rôle "Direction" (D).

---

## 📋 1. Filtrer et valider les séances

### Accès
- Connectez-vous avec un compte ayant le rôle "Direction"
- Naviguez vers **Séances** depuis le menu principal

### Filtrer les séances par statut
1. Dans la section "Filtres", utilisez le menu déroulant "Statut de validation"
2. Choisissez :
   - **Toutes les séances** : Affiche toutes les séances
   - **Séances validées** : Affiche uniquement les séances déjà validées
   - **Séances non validées** : Affiche les séances en attente de validation
3. Cliquez sur "Filtrer"
4. Pour retirer le filtre, cliquez sur "Réinitialiser"

### Valider une séance
1. Filtrez pour afficher les "Séances non validées"
2. Pour chaque séance non validée, un bouton vert avec une icône de validation apparaît
3. Cliquez sur ce bouton
4. Confirmez la validation dans la popup
5. La séance sera marquée comme validée et n'apparaîtra plus dans la liste des séances non validées

### Statut visuel
- **Badge vert "Validée"** : La séance a été validée
- **Badge jaune "En attente"** : La séance attend validation

---

## 📄 2. Générer un PDF des séances validées

### Objectif
Créer un rapport PDF des séances validées sur une période donnée.

### Étapes
1. Depuis la page "Séances", cliquez sur le bouton rouge **"PDF Séances"** dans la section filtres
2. Un formulaire apparaît avec deux champs :
   - **Date de début** : Première date de la période
   - **Date de fin** : Dernière date de la période
3. Remplissez les deux dates (obligatoires)
4. Cliquez sur **"Générer le PDF"**
5. Le fichier PDF sera automatiquement téléchargé avec le nom : `seances_validees_YYYY-MM-DD_YYYY-MM-DD.pdf`

### Contenu du PDF
- En-tête avec la période sélectionnée
- Tableau détaillé avec :
  - Date et horaire de chaque séance
  - Enseignant
  - Classe (groupe)
  - Matière (module)
  - Type (Cours, TP, Examen)
  - Durée en heures
  - Nombre d'absents
- Ligne de total avec la durée totale
- Pied de page avec statistiques et date de génération

---

## 📊 3. Générer un PDF d'avancement

### Objectif
Créer un rapport PDF de l'avancement par Formateur/Groupe/Module avec filtres optionnels.

### Étapes
1. Naviguez vers **Avancement** depuis le menu principal
2. Cliquez sur le bouton rouge **"Générer PDF"**
3. Un formulaire de filtrage apparaît avec 3 critères **optionnels** :
   - **Formateur** : Sélectionnez un enseignant spécifique (ou laissez "Tous les formateurs")
   - **Groupe** : Sélectionnez une classe spécifique (ou laissez "Tous les groupes")
   - **Module** : Sélectionnez une matière spécifique (ou laissez "Tous les modules")
4. Sélectionnez les filtres souhaités (vous pouvez n'en sélectionner aucun pour tout afficher)
5. Cliquez sur **"Générer le PDF"**
6. Le fichier PDF sera automatiquement téléchargé avec le nom : `avancement_YYYY-MM-DD.pdf`

### Contenu du PDF
- En-tête du rapport
- Ligne indiquant les filtres appliqués (si applicable)
- Tableau détaillé avec :
  - Formateur (nom complet)
  - Groupe (nom de la classe)
  - Module (nom de la matière)
  - MH Prévues (heures planifiées)
  - MH Réalisées (heures effectuées)
  - Pourcentage d'avancement (calculé automatiquement)
- Pied de page avec le nombre total d'avancements et la date de génération

---

## ✅ Cas d'usage pratiques

### Exemple 1 : Validation hebdomadaire
**Scénario** : Chaque lundi, valider toutes les séances de la semaine précédente.

1. Accédez à "Séances"
2. Filtrez par "Séances non validées"
3. Vérifiez chaque séance une par une
4. Validez les séances correctes
5. Une fois terminé, générez un PDF des séances validées pour la semaine

### Exemple 2 : Rapport mensuel pour la direction
**Scénario** : Générer un rapport PDF des séances validées du mois.

1. Cliquez sur "PDF Séances"
2. Date de début : 01/01/2026
3. Date de fin : 31/01/2026
4. Générez le PDF
5. Envoyez le rapport à la direction

### Exemple 3 : Suivi d'un formateur spécifique
**Scénario** : Vérifier l'avancement d'un formateur particulier.

1. Accédez à "Avancement"
2. Cliquez sur "Générer PDF"
3. Sélectionnez le formateur dans le menu déroulant
4. Laissez Groupe et Module vides pour voir tous ses modules
5. Générez le PDF

### Exemple 4 : Avancement d'un module dans toutes les classes
**Scénario** : Voir comment un module spécifique progresse dans toutes les classes.

1. Accédez à "Avancement"
2. Cliquez sur "Générer PDF"
3. Laissez Formateur et Groupe vides
4. Sélectionnez le Module souhaité
5. Générez le PDF

---

## 🔒 Sécurité et accès

- ✅ Ces fonctionnalités sont **exclusivement réservées** aux utilisateurs ayant le rôle "Direction" (D)
- ❌ Les enseignants (E) et autres rôles ne peuvent pas accéder à ces fonctionnalités
- 🔐 Toutes les actions sont protégées par authentification et autorisation

---

## 📞 Support

En cas de problème :
1. Vérifiez que vous êtes bien connecté avec un compte "Direction"
2. Vérifiez que les dates sont valides (date de fin >= date de début)
3. Contactez l'administrateur système si le problème persiste
