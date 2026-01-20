<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('cours.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Détails de la séance') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Informations complètes sur la séance de cours.
                </p>
            </div>

            @php
                $typeLabels = ['C' => 'Cours', 'T' => 'TP', 'E' => 'Examen'];
            @endphp

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <!-- Header with Date/Time -->
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-gray-100 dark:border-gray-700 mb-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Date et Heure</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $cours->Jour ? \Illuminate\Support\Carbon::parse($cours->Jour)->format('d/m/Y') : '—' }}
                                <span class="mx-1 text-gray-400">|</span>
                                {{ $cours->HeureDebut }} - {{ $cours->HeureFin }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-100 dark:border-blue-800">
                            {{ $typeLabels[$cours->Type] ?? $cours->Type }}
                        </span>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                            {{ $cours->Duree }}h
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Enseignant -->
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Enseignant</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $cours->CodeE }}</div>
                            @if ($cours->enseignant?->Libelle)
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $cours->enseignant->Libelle }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Classe -->
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Classe</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $cours->CodeC }}</div>
                            @if ($cours->classe?->Libelle)
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $cours->classe->Libelle }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Matière -->
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Matière</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $cours->CodeM }}</div>
                            @if ($cours->matiere)
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    MH: {{ $cours->matiere->MH }}h • Coef: {{ $cours->matiere->Coef }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Absents -->
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Absents</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $cours->NbAbsent ?? 0 }}</div>
                        </div>
                    </div>
                </div>

                @php
                    $user = Auth::user();
                    $canEdit = in_array($user->role, ['E', 'admin']) && ($user->role !== 'E' || $cours->CodeE === $user->CodeE);
                @endphp

                @if ($canEdit)
                    <div
                        class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('cours.edit', $cours) }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-md shadow-indigo-500/20 transition-all hover:-translate-y-0.5">
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