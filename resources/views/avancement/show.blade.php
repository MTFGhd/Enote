<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('avancement.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Détails de l\'avancement') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Informations détaillées sur cet avancement.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">

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
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $avancement->CodeE }}</div>
                            @if ($avancement->enseignant?->Libelle)
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $avancement->enseignant->Libelle }}
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
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $avancement->CodeC }}</div>
                            @if ($avancement->classe?->Libelle)
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $avancement->classe->Libelle }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Matière -->
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center text-pink-600 dark:text-pink-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Matière</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $avancement->CodeM }}</div>
                            @if ($avancement->matiere)
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    MH: {{ $avancement->matiere->MH }}h • Coef: {{ $avancement->matiere->Coef }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- MH Réalisé -->
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">MH Réalisé / Total
                            </div>
                            @php
                                $mh = $avancement->matiere?->MH ?? 0;
                                $realise = $avancement->MHRealise;
                                $percent = $mh > 0 ? min(100, round(($realise / $mh) * 100)) : 0;
                                $color = $percent < 50 ? 'bg-red-500' : ($percent < 80 ? 'bg-yellow-500' : 'bg-green-500');
                            @endphp
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $realise }}h</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">/ {{ $mh }}h</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                                <div class="{{ $color }} h-2 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $canManage = Auth::user()->role === 'admin';
                @endphp
                <div
                    class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('avancement.index') }}"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Retour</a>
                    @if ($canManage)
                        <a href="{{ route('avancement.edit', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-md shadow-indigo-500/20 transition-all hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>