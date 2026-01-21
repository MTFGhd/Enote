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
                    {{ __('Nouvelle absence') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Enregistrer une absence d'étudiant à un cours.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('absence.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="CodeE" :value="__('Étudiant')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <select id="CodeE" name="CodeE"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                            required>
                            <option value="" disabled @selected(old('CodeE') === null)>Sélectionnez un étudiant
                            </option>
                            @foreach ($etudiants as $etudiant)
                                <option value="{{ $etudiant->CodeE }}" @selected(old('CodeE') == $etudiant->CodeE)>
                                    {{ $etudiant->Prenom }} {{ $etudiant->Nom }} ({{ $etudiant->CodeE }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('CodeE')" />
                    </div>

                    <div>
                        <x-input-label for="NumC" :value="__('Cours')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <select id="NumC" name="NumC"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                            required>
                            <option value="" disabled @selected(old('NumC') === null)>Sélectionnez un cours
                            </option>
                            @foreach ($cours as $c)
                                <option value="{{ $c->NumC }}" @selected(old('NumC') == $c->NumC)>
                                    {{ $c->matiere->Libelle ?? 'N/A' }} - {{ $c->classe->Libelle ?? '' }} - {{ \Carbon\Carbon::parse($c->Jour)->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('NumC')" />
                    </div>

                    <div>
                        <x-input-label for="Jour" :value="__('Date')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="Jour" name="Jour" type="date" class="mt-1 block w-full"
                            :value="old('Jour')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('Jour')" />
                    </div>

                    <div>
                        <x-input-label for="Duree" :value="__('Durée (heures)')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="Duree" name="Duree" type="number" step="0.01" min="0" class="mt-1 block w-full"
                            :value="old('Duree')" required placeholder="Ex: 2.5" />
                        <x-input-error class="mt-2" :messages="$errors->get('Duree')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('absence.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Enregistrer l\'absence') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
