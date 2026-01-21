<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                    {{ __('Modifier l\'absence') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Modifiez les informations de l'absence.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('absence.update', [$absence->CodeE, $absence->NumC]) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Étudiant</div>
                                <div class="text-base text-gray-900 dark:text-white">
                                    {{ $absence->etudiant->Prenom ?? '' }} {{ $absence->etudiant->Nom ?? '' }}
                                    <span class="text-sm text-gray-500">({{ $absence->CodeE }})</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Cours</div>
                                <div class="text-base text-gray-900 dark:text-white">
                                    {{ $absence->cours->matiere->Libelle ?? 'N/A' }}
                                    <span class="text-sm text-gray-500">(#{{ $absence->NumC }})</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="Jour" :value="__('Date')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="Jour" name="Jour" type="date" class="mt-1 block w-full"
                            :value="old('Jour', $absence->Jour)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('Jour')" />
                    </div>

                    <div>
                        <x-input-label for="Duree" :value="__('Durée (heures)')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="Duree" name="Duree" type="number" step="0.01" min="0" class="mt-1 block w-full"
                            :value="old('Duree', $absence->Duree)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('Duree')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('absence.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Mettre à jour') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
