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
                    {{ __('Nouvel avancement') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Enregistrez une nouvelle progression pour une matière, une classe et un enseignant.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('avancement.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="CodeE" :value="__('Enseignant')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <select id="CodeE" name="CodeE"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                                required>
                                <option value="" disabled @selected(old('CodeE') === null)>Sélectionnez un enseignant
                                </option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->CodeE }}" @selected(old('CodeE') == $enseignant->CodeE)>
                                        {{ $enseignant->CodeE }}{{ $enseignant->Libelle ? ' - ' . $enseignant->Libelle : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('CodeE')" />
                        </div>

                        <div>
                            <x-input-label for="CodeC" :value="__('Classe')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <select id="CodeC" name="CodeC"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                                required>
                                <option value="" disabled @selected(old('CodeC') === null)>Sélectionnez une classe
                                </option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->CodeC }}" @selected(old('CodeC') == $classe->CodeC)>
                                        {{ $classe->CodeC }}{{ $classe->Libelle ? ' - ' . $classe->Libelle : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('CodeC')" />
                        </div>

                        <div>
                            <x-input-label for="MHRealise" :value="__('MH réalisé (heures)')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <x-text-input id="MHRealise" name="MHRealise" type="number" step="0.01" min="0"
                                class="mt-1 block w-full" :value="old('MHRealise')" required placeholder="Ex: 10.5" />
                            <x-input-error class="mt-2" :messages="$errors->get('MHRealise')" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="CodeM" :value="__('Matière')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <select id="CodeM" name="CodeM"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                                required>
                                <option value="" disabled @selected(old('CodeM') === null)>Sélectionnez une matière
                                </option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->CodeM }}" @selected(old('CodeM') == $matiere->CodeM)>
                                        {{ $matiere->CodeM }} (MH: {{ $matiere->MH }}, Coef: {{ $matiere->Coef }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('CodeM')" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('avancement.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Créer l\'avancement') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>