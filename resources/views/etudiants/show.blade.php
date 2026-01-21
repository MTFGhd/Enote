<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('etudiants.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Profil de l\'étudiant') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Informations détaillées et historique des absences.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informations de l'étudiant -->
                <div class="lg:col-span-1">
                    <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-24 h-24 rounded-full bg-primary/10 text-primary flex items-center justify-center text-3xl font-bold mb-4">
                                {{ strtoupper(substr($etudiant->Prenom, 0, 1) . substr($etudiant->Nom, 0, 1)) }}
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                                {{ $etudiant->Prenom }} {{ $etudiant->Nom }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $etudiant->CodeE }}</p>
                            
                            <div class="w-full space-y-4 mt-6">
                                <div class="text-left">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</div>
                                    <div class="text-base text-gray-900 dark:text-white break-all">{{ $etudiant->email }}</div>
                                </div>

                                <div class="text-left">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Classe</div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                        {{ $etudiant->classe->Libelle ?? $etudiant->CodeC }}
                                    </span>
                                </div>

                                <div class="text-left">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total absences</div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $etudiant->absences->count() }}
                                    </div>
                                </div>
                            </div>

                            @if(Auth::user()->role === 'admin')
                            <div class="w-full mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                                <a href="{{ route('etudiants.edit', $etudiant) }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-primary hover:bg-primary-hover text-white rounded-xl font-semibold shadow-md transition-all">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Modifier
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Historique des absences -->
                <div class="lg:col-span-2">
                    <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Historique des absences</h3>
                        
                        @if($etudiant->absences->count() > 0)
                        <div class="space-y-4">
                            @foreach($etudiant->absences->sortByDesc('Jour') as $absence)
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[24px]">event_busy</span>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white">
                                                {{ $absence->cours->matiere->Libelle ?? 'Matière inconnue' }}
                                            </h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $absence->cours->classe->Libelle ?? '' }} - Type: {{ $absence->cours->Type }}
                                            </p>
                                        </div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($absence->Jour)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-300">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">schedule</span>
                                            {{ $absence->Duree }}h
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">person</span>
                                            {{ $absence->cours->enseignant->Nom ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-[32px]">check_circle</span>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">Aucune absence enregistrée</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
