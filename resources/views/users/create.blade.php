<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Nouvel utilisateur') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Créez un compte et assignez un rôle.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Nom complet')" class="text-gray-700 dark:text-gray-300 font-medium mb-1"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name')" required autofocus placeholder="Ex: Jean Dupont"/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300 font-medium mb-1"/>
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                          :value="old('email')" required placeholder="exemple@domaine.com"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="role" :value="__('Rôle')" class="text-gray-700 dark:text-gray-300 font-medium mb-1"/>
                            <select id="role" name="role"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:border-primary-500 focus:ring-primary-500">
                                @foreach($roles as $key => $label)
                                    <option value="{{ $key }}" {{ old('role', 'E') === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('role')"/>
                        </div>

                        <div>
                            <x-input-label for="CodeE" :value="__('Code Enseignant (si rôle Enseignant)')" class="text-gray-700 dark:text-gray-300 font-medium mb-1"/>
                            <select id="CodeE" name="CodeE"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:border-primary-500 focus:ring-primary-500">
                                <option value="">-- Aucun / Non applicable --</option>
                                @foreach($enseignants as $enseignant)
                                    <option value="{{ $enseignant->CodeE }}" {{ old('CodeE') === $enseignant->CodeE ? 'selected' : '' }}>
                                        {{ $enseignant->CodeE }} — {{ $enseignant->Libelle }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('CodeE')"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700 dark:text-gray-300 font-medium mb-1"/>
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                          required autocomplete="new-password" placeholder="Au moins 8 caractères"/>
                            <x-input-error class="mt-2" :messages="$errors->get('password')"/>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-700 dark:text-gray-300 font-medium mb-1"/>
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                          class="mt-1 block w-full" required autocomplete="new-password"/>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('users.index') }}"
                           class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                            Annuler
                        </a>
                        <x-primary-button>{{ __('Créer l\'utilisateur') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
