<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('classes.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Modifier la classe') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Mettez à jour les informations de la classe.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('classes.update', $classe) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="CodeC" :value="__('Code classe')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="CodeC" type="text"
                            class="mt-1 block w-full bg-gray-50 dark:bg-gray-800 text-gray-500 cursor-not-allowed"
                            :value="$classe->CodeC" disabled />
                        <p class="mt-1 text-xs text-gray-500">Le code classe ne peut pas être modifié.</p>
                    </div>

                    <div>
                        <x-input-label for="Libelle" :value="__('Libellé')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <x-text-input id="Libelle" name="Libelle" type="text" class="mt-1 block w-full"
                            :value="old('Libelle', $classe->Libelle)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('Libelle')" />
                    </div>

                    <div>
                        <x-input-label for="CodeD" :value="__('Département')"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-1" />
                        <select id="CodeD" name="CodeD"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900/50 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-xl shadow-sm"
                            required>
                            <option value="" disabled>Sélectionnez un département</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->CodeD }}" @selected(old('CodeD', $classe->CodeD) == $departement->CodeD)>
                                    {{ $departement->CodeD }}{{ $departement->Libelle ? ' - ' . $departement->Libelle : '' }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('CodeD')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('classes.index') }}"
                            class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Annuler</a>
                        <x-primary-button>{{ __('Enregistrer les modifications') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>