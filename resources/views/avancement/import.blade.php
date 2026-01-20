<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Importer des Avancements (CSV)') }}
            </h2>
            <a href="{{ route('avancement.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages de succès/erreur -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Succès!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Erreur!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Erreurs de validation:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Instructions -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Instructions d'importation
                </h3>
                <div class="text-sm text-blue-800 dark:text-blue-200 space-y-2">
                    <p><strong>Format du fichier CSV requis :</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Le fichier doit contenir 3 colonnes: <code class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">Enseignant</code>, <code class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">Classe</code>, <code class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">CodeMatiere</code></li>
                        <li>La première ligne doit être l'en-tête</li>
                        <li>Format: <code class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">CodeEnseignant,CodeClasse,CodeMatiere</code></li>
                        <li>Encodage recommandé: UTF-8</li>
                    </ul>
                    
                    <div class="mt-4">
                        <p class="font-semibold mb-2">Exemple de contenu CSV :</p>
                        <pre class="bg-blue-100 dark:bg-blue-800 p-3 rounded text-xs overflow-x-auto">Enseignant,Classe,CodeMatiere
2501,Cl101,Mat102
2502,Cl102,Mat103
2503,Cl103,Mat104</pre>
                    </div>

                    <div class="mt-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded">
                        <p class="font-semibold text-yellow-900 dark:text-yellow-100">⚠️ Important :</p>
                        <p class="text-yellow-800 dark:text-yellow-200 mt-1">
                            Le système créera automatiquement les enseignants, classes et matières qui n'existent pas encore dans la base de données avant d'insérer les avancements.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Formulaire d'upload -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('avancement.import.process') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label for="csv_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Sélectionner le fichier CSV
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="csv_file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Cliquez pour uploader</span> ou glissez-déposez
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Fichiers CSV uniquement (MAX. 2MB)
                                        </p>
                                        <p id="file-name" class="mt-2 text-sm font-medium text-indigo-600 dark:text-indigo-400"></p>
                                    </div>
                                    <input id="csv_file" name="csv_file" type="file" accept=".csv,.txt" class="hidden" required onchange="displayFileName(this)" />
                                </label>
                            </div>
                            @error('csv_file')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('avancement.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Importer le fichier
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Exemple de fichier téléchargeable -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">
                        Télécharger un exemple de fichier CSV
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Téléchargez ce fichier d'exemple pour voir le format correct du CSV
                    </p>
                    <button onclick="downloadExampleCSV()" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Télécharger exemple.csv
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameDisplay = document.getElementById('file-name');
            if (fileName) {
                fileNameDisplay.textContent = '📄 ' + fileName;
            }
        }

        function downloadExampleCSV() {
            const csvContent = `Enseignant,Classe,CodeMatiere
2501,Cl101,Mat102
2502,Cl102,Mat103
2503,Cl103,Mat104
2504,Cl104,Mat105
2505,Cl105,Mat106
2506,Cl106,Mat101
2507,Cl101,Mat102
2508,Cl102,Mat103
2509,Cl103,Mat104
1010,Cl104,Mat105`;

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            
            link.setAttribute('href', url);
            link.setAttribute('download', 'exemple_avancements.csv');
            link.style.visibility = 'hidden';
            
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</x-app-layout>
