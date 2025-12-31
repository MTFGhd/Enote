<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier commande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('commandes.update', $commande) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="DateCmd" :value="__('Date commande')" />
                            <x-text-input id="DateCmd" name="DateCmd" type="datetime-local" class="mt-1 block w-full" :value="old('DateCmd', \Illuminate\Support\Carbon::parse($commande->DateCmd)->format('Y-m-d\\TH:i'))" required />
                            <x-input-error class="mt-2" :messages="$errors->get('DateCmd')" />
                        </div>

                        <div>
                            <x-input-label for="Montant" :value="__('Montant')" />
                            <x-text-input id="Montant" name="Montant" type="number" step="0.01" class="mt-1 block w-full" :value="old('Montant', $commande->Montant)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('Montant')" />
                        </div>

                        <div>
                            <x-input-label for="IdClient" :value="__('Client')" />
                            <select id="IdClient" name="IdClient" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->IdClient }}" @selected(old('IdClient', $commande->IdClient) == $client->IdClient)>
                                        {{ $client->Nom }} ({{ $client->Email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('IdClient')" />
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('commandes.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Retour</a>
                            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
