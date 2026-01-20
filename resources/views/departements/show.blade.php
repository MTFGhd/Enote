<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('departements.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Détails du département') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Informations complètes sur le département.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <div class="flex flex-col md:flex-row md:items-start gap-8">
                    <div class="flex-shrink-0">
                        <div
                            class="w-20 h-20 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg shadow-purple-500/30">
                            {{ substr($departement->CodeD, 0, 2) }}
                        </div>
                    </div>

                    <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Code Département
                            </div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $departement->CodeD }}
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Libellé</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $departement->Libelle }}
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Classes associées
                            </div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $departement->classes?->count() ?? 0 }}</div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Matières associées
                            </div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $departement->matieres?->count() ?? 0 }}</div>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('departements.edit', $departement) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-md shadow-indigo-500/20 transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>