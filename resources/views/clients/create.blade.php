<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nouveau client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('clients.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="Nom" :value="__('Nom')" />
                            <x-text-input id="Nom" name="Nom" type="text" class="mt-1 block w-full" :value="old('Nom')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('Nom')" />
                        </div>

                        <div>
                            <x-input-label for="Email" :value="__('Email')" />
                            <x-text-input id="Email" name="Email" type="email" class="mt-1 block w-full" :value="old('Email')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('Email')" />
                        </div>

                        <div>
                            <x-input-label for="Adresse" :value="__('Adresse')" />
                            <textarea id="Adresse" name="Adresse" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" required>{{ old('Adresse') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('Adresse')" />
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('clients.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Annuler</a>
                            <x-primary-button>{{ __('Créer') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
