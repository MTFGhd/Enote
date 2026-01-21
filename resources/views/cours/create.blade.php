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
                    {{ __('Saisir une séance') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Enregistrez une nouvelle séance de cours, TP ou examen.
                </p>
            </div>

            @php
                $user = Auth::user();
                $typeLabels = ['C' => 'Cours', 'T' => 'TP', 'E' => 'Examen'];
            @endphp

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('cours.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="CodeE" :value="__('Enseignant')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            @if ($user->role === 'E')
                                <div class="relative">
                                    <x-text-input id="CodeE" name="CodeE" type="text"
                                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-800/50 text-gray-600 dark:text-gray-400 cursor-default focus:border-gray-300 focus:ring-0"
                                        :value="$user->CodeE" readonly />
                                    @if($user->enseignant)
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">{{ $user->enseignant->Libelle }}</span>
                                        </div>
                                    @endif
                                </div>
                            @else
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
                            @endif
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
                            <x-input-label for="Type" :value="__('Type de séance')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <select id="Type" name="Type"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                                required>
                                <option value="" disabled @selected(old('Type') === null)>Sélectionnez le type</option>
                                @foreach ($typeLabels as $value => $label)
                                    <option value="{{ $value }}" @selected(old('Type') == $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('Type')" />
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

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="Jour" :value="__('Date')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="Jour" name="Jour" type="date" class="mt-1 block w-full"
                                    :value="old('Jour')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('Jour')" />
                            </div>

                            <div>
                                <x-input-label for="HeureDebut" :value="__('Heure de début')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="HeureDebut" name="HeureDebut" type="time" class="mt-1 block w-full"
                                    :value="old('HeureDebut')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('HeureDebut')" />
                            </div>

                            <div>
                                <x-input-label for="HeureFin" :value="__('Heure de fin')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="HeureFin" name="HeureFin" type="time" class="mt-1 block w-full"
                                    :value="old('HeureFin')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('HeureFin')" />
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="Duree" :value="__('Durée effective (h)')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="Duree" name="Duree" type="number" step="0.01" min="0"
                                    class="mt-1 block w-full" :value="old('Duree')" required placeholder="Ex: 2.5" />
                                <x-input-error class="mt-2" :messages="$errors->get('Duree')" />
                            </div>

                            <div>
                                <x-input-label for="NbAbsent" :value="__('Nombre d\'absents')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="NbAbsent" name="NbAbsent" type="number" min="0"
                                    class="mt-1 block w-full" :value="old('NbAbsent')" placeholder="Ex: 0" />
                                <x-input-error class="mt-2" :messages="$errors->get('NbAbsent')" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('cours.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Enregistrer la séance') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heureDebut = document.getElementById('HeureDebut');
            const heureFin = document.getElementById('HeureFin');
            const dureeInput = document.getElementById('Duree');

            function calculateDuration() {
                if (heureDebut.value && heureFin.value) {
                    const debut = new Date('1970-01-01T' + heureDebut.value + 'Z');
                    const fin = new Date('1970-01-01T' + heureFin.value + 'Z');
                    
                    let diffMs = fin - debut;
                    
                    // Si la date de fin est AVANT la date de début, on assume que c'est le lendemain ? 
                    // Pour des cours, c'est rarement le cas, surement une erreur de saisie.
                    // On gère le cas négatif en mettant 0
                    if (diffMs < 0) {
                        dureeInput.value = '';
                        return;
                    }

                    // Conversion en heures (décimales)
                    let diffHrs = diffMs / (1000 * 60 * 60);
                    
                    // Arrondir à 2 décimales
                    dureeInput.value = Math.round(diffHrs * 100) / 100;
                }
            }

            heureDebut.addEventListener('change', calculateDuration);
            heureFin.addEventListener('change', calculateDuration);
            
            // Recalcul au chargement si valeurs présentes (valeur old())
            calculateDuration();
        });
    </script>
</x-app-layout>