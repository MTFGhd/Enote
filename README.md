# Enote 📚🎓

  
  
  

Une application web complète pour la gestion pédagogique, développée avec Laravel. **Enote** permet de gérer les cours, les absences, le suivi de l'avancement pédagogique, ainsi que les entités administratives (étudiants, enseignants, classes, etc.).

  

## ✨ Fonctionnalités Principales

  

- **👥 Gestion des Utilisateurs & Rôles** : Système d'authentification et de permissions (Admin, Direction, Enseignant, etc.).

- **🏫 Administration Scolaire** : CRUD complet pour les Départements, Classes, Matières, Enseignants et Étudiants.

- **📅 Gestion des Cours** : Planification et suivi des séances de cours.

- **🚫 Suivi des Absences** : Enregistrement et consultation des absences par étudiant et par cours.

- **📈 Suivi de l'Avancement** : Gestion de la progression pédagogique (Cahier de texte numérique).

- **📄 Rapports PDF** : Génération de fiches de séances et rapports d'avancement (pour la Direction).

- **🔍 Recherche Avancée** : Filtrage et recherche instantanée (côté client) pour les classes et étudiants.

- **📤 Importation de Données** : Import CSV pour les données d'avancement.

  

## 🛠 Technologies

  

<p>

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />

<img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="TailwindCSS" />

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />

<img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite" />

<img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js" />

 <img src="https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />

</p>

  

* **Backend** : Laravel 12.

* **Frontend** : Blade Templates, Tailwind CSS v4, FlyonUI.

* **JavaScript** : Alpine.js, jQuery, Datatables.

* **Build Tool** : Vite.

* **Base de données** : MySQL.

  

## 🚀 Installation

  

Suivez ces étapes pour configurer le projet localement :

  

1. **Cloner le dépôt**

```bash

git clone https://github.com/MTFGhd/Enote.git

cd Enote

```

  

2. **Installer les dépendances PHP**

```bash

composer install

```

  

3. **Installer les dépendances Frontend**

```bash

npm install

```

  

4. **Configuration de l'environnement**

Copiez le fichier d'exemple et générez la clé d'application :

```bash

cp .env.example .env

php artisan key:generate

```

*Assurez-vous de configurer vos accès base de données dans le fichier `.env`.*

  

5. **Migration de la base de données**

```bash

php artisan migrate

```

  

## 🖥 Usage

  

Pour lancer l'application en mode développement :

  

1. **Lancer le serveur de développement Vite (Frontend)**

```bash

npm run dev

```

  

2. **Lancer le serveur Laravel (Backend)**

```bash

php artisan serve

```

  

Accédez à l'application via `http://localhost:8000`.

  

## 📂 Structure des Dossiers Clés

  

- `app/Http/Controllers` : Logique métier (Admin, Absences, Cours, etc.)

- `resources/views` : Templates Blade

- `routes/web.php` : Définition des routes et middlewares

  

## 📝 Licence

  

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).
