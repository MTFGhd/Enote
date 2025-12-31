<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nouvelle facture') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('factures.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="DateFact" :value="__('Date facture')" />
                            <x-text-input id="DateFact" name="DateFact" type="datetime-local" class="mt-1 block w-full" :value="old('DateFact')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('DateFact')" />
                        </div>

                        <div>
                            <x-input-label for="IdCde" :value="__('Commande')" />
                            <select id="IdCde" name="IdCde" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled @selected(old('IdCde') === null)>—</option>
                                @foreach ($commandes as $commande)
                                    <option value="{{ $commande->IdCde }}" @selected(old('IdCde') == $commande->IdCde)>
                                        #{{ $commande->IdCde }} — {{ $commande->Clients?->Nom }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('IdCde')" />
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('factures.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Annuler</a>
                            <x-primary-button>{{ __('Créer') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
