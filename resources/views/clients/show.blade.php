<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détail client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-3">
                    <div><strong>Nom :</strong> {{ $client->Nom }}</div>
                    <div><strong>Email :</strong> {{ $client->Email }}</div>
                    <div><strong>Adresse :</strong> {{ $client->Adresse }}</div>

                    <div class="flex items-center justify-end gap-3 pt-4">
                        <a href="{{ route('clients.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Retour</a>
                        <a href="{{ route('clients.edit', $client) }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
