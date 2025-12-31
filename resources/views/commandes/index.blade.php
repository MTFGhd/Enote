<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mb-4">
                        <a href="{{ route('commandes.create') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Nouvelle commande') }}
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-2 pr-4">ID</th>
                                    <th class="py-2 pr-4">Date</th>
                                    <th class="py-2 pr-4">Montant</th>
                                    <th class="py-2 pr-4">Client</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commandes as $commande)
                                    <tr class="border-b border-gray-100 dark:border-gray-700">
                                        <td class="py-2 pr-4">{{ $commande->IdCde }}</td>
                                        <td class="py-2 pr-4">{{ $commande->DateCmd }}</td>
                                        <td class="py-2 pr-4">{{ $commande->Montant }}</td>
                                        <td class="py-2 pr-4">{{ $commande->Clients?->Nom }}</td>
                                        <td class="py-2">
                                            <div class="flex items-center gap-3">
                                                <a class="underline" href="{{ route('commandes.show', $commande) }}">Voir</a>
                                                <a class="underline" href="{{ route('commandes.edit', $commande) }}">Modifier</a>
                                                <form method="POST" action="{{ route('commandes.destroy', $commande) }}" onsubmit="return confirm('Supprimer cette commande ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="underline text-red-600 dark:text-red-400">Supprimer</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4" colspan="5">Aucune commande.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $commandes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
