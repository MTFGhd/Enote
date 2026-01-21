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
                    {{ __('Modifier la séance') }} #{{ $cours->NumC }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Mettez à jour les informations de la séance.
                </p>
            </div>

            @php
                $user = Auth::user();
                $typeLabels = ['C' => 'Cours', 'T' => 'TP', 'E' => 'Examen'];
                $jourValue = $cours->Jour ? \Illuminate\Support\Carbon::parse($cours->Jour)->format('Y-m-d') : '';
                $heureDebutValue = $cours->HeureDebut ? \Illuminate\Support\Carbon::parse($cours->HeureDebut)->format('H:i') : '';
                $heureFinValue = $cours->HeureFin ? \Illuminate\Support\Carbon::parse($cours->HeureFin)->format('H:i') : '';
            @endphp

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('cours.update', $cours) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="CodeE" :value="__('Enseignant')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            @if ($user->role === 'E')
                                <div class="relative">
                                    <x-text-input id="CodeE" name="CodeE" type="text"
                                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-800/50 text-gray-600 dark:text-gray-400 cursor-default focus:border-gray-300 focus:ring-0"
                                        :value="$cours->CodeE" readonly />
                                    @if($cours->enseignant)
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">{{ $cours->enseignant->Libelle }}</span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <select id="CodeE" name="CodeE"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                                    required>
                                    <option value="" disabled>Sélectionnez un enseignant</option>
                                    @foreach ($enseignants as $enseignant)
                                        <option value="{{ $enseignant->CodeE }}" @selected(old('CodeE', $cours->CodeE) == $enseignant->CodeE)>
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
                                <option value="" disabled>Sélectionnez une classe</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->CodeC }}" @selected(old('CodeC', $cours->CodeC) == $classe->CodeC)>
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
                                <option value="" disabled>Sélectionnez le type</option>
                                @foreach ($typeLabels as $value => $label)
                                    <option value="{{ $value }}" @selected(old('Type', $cours->Type) == $value)>
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
                                <option value="" disabled>Sélectionnez une matière</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->CodeM }}" @selected(old('CodeM', $cours->CodeM) == $matiere->CodeM)>
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
                                    :value="old('Jour', $jourValue)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('Jour')" />
                            </div>

                            <div>
                                <x-input-label for="HeureDebut" :value="__('Heure de début')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="HeureDebut" name="HeureDebut" type="time" class="mt-1 block w-full"
                                    :value="old('HeureDebut', $heureDebutValue)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('HeureDebut')" />
                            </div>

                            <div>
                                <x-input-label for="HeureFin" :value="__('Heure de fin')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <x-text-input id="HeureFin" name="HeureFin" type="time" class="mt-1 block w-full"
                                    :value="old('HeureFin', $heureFinValue)" required />
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
                                    class="mt-1 block w-full" :value="old('Duree', $cours->Duree)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('Duree')" />
                            </div>

                            <div>
                                <x-input-label for="nb_absents_display" :value="__('Nombre d\'absents')"
                                    class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                                <div id="nb_absents_display" class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-800/50 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 rounded-xl font-semibold">
                                    {{ count($existingAbsences) }}
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Calculé automatiquement selon les étudiants cochés
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des étudiants absents -->
                    <div id="students_section" class="border-t border-gray-100 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">group</span>
                            Liste des étudiants
                        </h3>
                        
                        <div id="students_placeholder" class="text-center py-12 bg-gray-50 dark:bg-gray-800/30 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600" style="display: none;">
                            <span class="material-symbols-outlined text-5xl text-gray-400 dark:text-gray-500 mb-3 block">person_search</span>
                            <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">
                                Sélectionnez une classe et une matière
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">
                                La liste des étudiants s'affichera automatiquement
                            </p>
                        </div>

                        <div id="students_loading" class="text-center py-8" style="display: none;">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Chargement des étudiants...</p>
                        </div>

                        <div id="students_content">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                Cochez les étudiants absents à cette séance
                            </p>
                            <div id="students_list" class="space-y-2 max-h-96 overflow-y-auto"></div>
                        </div>
                        
                        <div id="students_empty" class="text-center py-8 text-gray-500 dark:text-gray-400" style="display: none;">
                            <span class="material-symbols-outlined text-4xl mb-2">person_off</span>
                            <p>Aucun étudiant inscrit dans cette classe</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('cours.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Enregistrer les modifications') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classeSelect = document.getElementById('CodeC');
            const matiereSelect = document.getElementById('CodeM');
            const studentsSection = document.getElementById('students_section');
            const studentsLoading = document.getElementById('students_loading');
            const studentsList = document.getElementById('students_list');
            const studentsEmpty = document.getElementById('students_empty');
            const nbAbsentsDisplay = document.getElementById('nb_absents_display');
            const existingAbsences = @json($existingAbsences);

            // Load students when both class and matiere are selected
            function loadStudents() {
                const classeCode = classeSelect.value;
                const matiereCode = matiereSelect.value;
                const placeholder = document.getElementById('students_placeholder');
                const studentsContent = document.getElementById('students_content');

                if (!classeCode || !matiereCode) {
                    placeholder.style.display = 'block';
                    studentsLoading.style.display = 'none';
                    studentsContent.style.display = 'none';
                    studentsEmpty.style.display = 'none';
                    return;
                }

                placeholder.style.display = 'none';
                studentsLoading.style.display = 'block';
                studentsContent.style.display = 'none';
                studentsEmpty.style.display = 'none';

                fetch(`/api/classes/${classeCode}/etudiants`)
                    .then(response => response.json())
                    .then(data => {
                        studentsLoading.style.display = 'none';

                        if (data.length === 0) {
                            studentsEmpty.style.display = 'block';
                            return;
                        }

                        studentsList.innerHTML = '';
                        studentsContent.style.display = 'block';

                        data.forEach(student => {
                            const isAbsent = existingAbsences.includes(student.CodeE);
                            const div = document.createElement('div');
                            div.className = 'flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700 transition-colors';
                            
                            div.innerHTML = `
                                <input type="checkbox" 
                                    name="absents[]" 
                                    value="${student.CodeE}" 
                                    id="student_${student.CodeE}"
                                    class="student-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary-500 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                    ${isAbsent ? 'checked' : ''}
                                    onchange="updateAbsentsCount()">
                                <label for="student_${student.CodeE}" class="flex-1 cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                            ${student.Prenom.charAt(0)}${student.Nom.charAt(0)}
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                ${student.Prenom} ${student.Nom}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                ${student.CodeE}
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            `;
                            
                            studentsList.appendChild(div);
                        });

                        updateAbsentsCount();
                    })
                    .catch(error => {
                        console.error('Error loading students:', error);
                        placeholder.style.display = 'none';
                        studentsLoading.style.display = 'none';
                        studentsContent.style.display = 'block';
                        studentsList.innerHTML = '<div class="text-center text-red-500 py-4">Erreur lors du chargement des étudiants</div>';
                    });
            }

            // Update absents count
            window.updateAbsentsCount = function() {
                const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
                nbAbsentsDisplay.textContent = checkedBoxes.length;
            };

            classeSelect.addEventListener('change', loadStudents);
            matiereSelect.addEventListener('change', loadStudents);

            // Load students on page load since we're editing
            if (classeSelect.value && matiereSelect.value) {
                loadStudents();
            }
        });
    </script>
</x-app-layout>