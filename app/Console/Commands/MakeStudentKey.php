<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeStudentKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:make-key {matricule}'; 


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $matricule = $this->argument('matricule');

        // Générer une clé unique : mélange de matricule, timestamp et random bytes
        $random = bin2hex(random_bytes(16));
        $timestamp = time();
        $raw = $matricule . '|' . $timestamp . '|' . $random;
        // Hacher pour obtenir une clé propre
        $key = hash('sha256', $raw);

        // Chemin des fichiers à la racine du projet
        $basePath = base_path();
        $studentKeyPath = $basePath . DIRECTORY_SEPARATOR . 'STUDENT_KEY.txt';
        $stagiairePath = $basePath . DIRECTORY_SEPARATOR . 'STAGIAIRE.txt';

        // Écrire la clé dans STUDENT_KEY.txt
       
            file_put_contents($studentKeyPath, $key);
            $this->info("Fichier créé : " . $studentKeyPath);
            $this->info("Clé générée : " . $key);

        // Créer STAGIAIRE.txt avec des champs à remplir par l'étudiant
        $content = "Nom : \nPrénom : \nMatricule : $matricule\nGroupe : \n";
    
            // N'écrase pas si le fichier existe déjà
            if (!file_exists($stagiairePath)) {
                file_put_contents($stagiairePath, $content);
                $this->info("Fichier créé : " . $stagiairePath);
            } else {
                $this->warn("STAGIAIRE.txt existe déjà : " . $stagiairePath);
            }
    
    

        $this->info('Commande terminée avec succès.');

        return 0;
    }
}
