<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('absence.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Détails de l\'absence') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Informations complètes sur l'absence enregistrée.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Informations de l'étudiant -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span>
                                Étudiant
                            </h3>
                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary font-semibold text-base">
                                        {{ strtoupper(substr($absence->etudiant->Prenom ?? '', 0, 1) . substr($absence->etudiant->Nom ?? '', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $absence->etudiant->Prenom ?? '' }} {{ $absence->etudiant->Nom ?? '' }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $absence->CodeE }}</div>
                                    </div>
                                </div>
                                <div class="space-y-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Email:</span>
                                        <span class="text-gray-900 dark:text-white">{{ $absence->etudiant->email ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Classe:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                            {{ $absence->etudiant->classe->Libelle ?? $absence->etudiant->CodeC }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations du cours -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">school</span>
                                Cours
                            </h3>
                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                                <div class="space-y-3">
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Matière</div>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $absence->cours->matiere->Libelle ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Type</div>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                @if($absence->cours->Type == 'C') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300
                                                @elseif($absence->cours->Type == 'T') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300
                                                @else bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300
                                                @endif">
                                                {{ $absence->cours->Type }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Classe</div>
                                            <div class="text-sm text-gray-900 dark:text-white">
                                                {{ $absence->cours->classe->Libelle ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Enseignant</div>
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $absence->cours->enseignant->Nom ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails de l'absence -->
                <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500">event_busy</span>
                        Détails de l'absence
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-red-50 dark:bg-red-900/20 rounded-xl p-4 border border-red-200 dark:border-red-800">
                            <div class="text-sm text-red-600 dark:text-red-400 mb-1">Date de l'absence</div>
                            <div class="text-xl font-bold text-red-700 dark:text-red-300">
                                {{ \Carbon\Carbon::parse($absence->Jour)->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-red-600 dark:text-red-400 mt-1">
                                {{ \Carbon\Carbon::parse($absence->Jour)->locale('fr')->isoFormat('dddd') }}
                            </div>
                        </div>
                        <div class="bg-orange-50 dark:bg-orange-900/20 rounded-xl p-4 border border-orange-200 dark:border-orange-800">
                            <div class="text-sm text-orange-600 dark:text-orange-400 mb-1">Durée de l'absence</div>
                            <div class="text-xl font-bold text-orange-700 dark:text-orange-300 flex items-center gap-2">
                                <span class="material-symbols-outlined">schedule</span>
                                {{ $absence->Duree }} heures
                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('absence.edit', [$absence->CodeE, $absence->NumC]) }}"
                        class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-hover text-white rounded-xl font-semibold shadow-md transition-all">
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
</x-app-layout>
