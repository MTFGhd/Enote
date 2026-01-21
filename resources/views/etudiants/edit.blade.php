<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                    {{ __('Modifier l\'étudiant') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Modifiez les informations de l'étudiant {{ $etudiant->Prenom }} {{ $etudiant->Nom }}.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('etudiants.update', $etudiant) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="CodeE" :value="__('Code étudiant')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="CodeE" name="CodeE" type="text" class="mt-1 block w-full"
                            :value="old('CodeE', $etudiant->CodeE)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('CodeE')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="Nom" :value="__('Nom')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <x-text-input id="Nom" name="Nom" type="text" class="mt-1 block w-full"
                                :value="old('Nom', $etudiant->Nom)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('Nom')" />
                        </div>

                        <div>
                            <x-input-label for="Prenom" :value="__('Prénom')"
                                class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                            <x-text-input id="Prenom" name="Prenom" type="text" class="mt-1 block w-full"
                                :value="old('Prenom', $etudiant->Prenom)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('Prenom')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $etudiant->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-input-label for="CodeC" :value="__('Classe')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <select id="CodeC" name="CodeC"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                            required>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->CodeC }}" @selected(old('CodeC', $etudiant->CodeC) == $classe->CodeC)>
                                    {{ $classe->Libelle }} ({{ $classe->CodeC }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('CodeC')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('etudiants.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Mettre à jour') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
