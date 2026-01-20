<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Avancement') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
        $canManage = $user->role === 'admin';
    @endphp

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

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            @if(session('stats'))
                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                    <strong>Dernière importation:</strong>
                                    {{ session('stats')['avancements_inseres'] }} avancement(s),
                                    {{ session('stats')['enseignants_inseres'] }} enseignant(s),
                                    {{ session('stats')['classes_inserees'] }} classe(s),
                                    {{ session('stats')['matieres_inserees'] }} matière(s)
                                </div>
                            @endif
                        </div>
                        
                        @if ($canManage)
                            <div class="flex gap-3">
                                <a href="{{ route('avancement.import') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Importer CSV
                                </a>
                                <a href="{{ route('avancement.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Nouvel avancement
                                </a>
                            </div>
                        @endif
                        
                        @if ($user->role === 'D')
                            <div>
                                <a href="{{ route('cours.pdf.avancement.form') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Générer PDF
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-2 pr-4">Enseignant</th>
                                    <th class="py-2 pr-4">Classe</th>
                                    <th class="py-2 pr-4">Matière</th>
                                    <th class="py-2 pr-4">MH réalisé</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($avancements as $avancement)
                                    <tr class="border-b border-gray-100 dark:border-gray-700">
                                        <td class="py-2 pr-4">
                                            <div class="font-medium">{{ $avancement->CodeE }}</div>
                                            @if ($avancement->enseignant?->Libelle)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $avancement->enseignant->Libelle }}</div>
                                            @endif
                                        </td>
                                        <td class="py-2 pr-4">
                                            <div class="font-medium">{{ $avancement->CodeC }}</div>
                                            @if ($avancement->classe?->Libelle)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $avancement->classe->Libelle }}</div>
                                            @endif
                                        </td>
                                        <td class="py-2 pr-4">
                                            <div class="font-medium">{{ $avancement->CodeM }}</div>
                                            @if ($avancement->matiere)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">MH: {{ $avancement->matiere->MH }} | Coef: {{ $avancement->matiere->Coef }}</div>
                                            @endif
                                        </td>
                                        <td class="py-2 pr-4">{{ $avancement->MHRealise }}</td>
                                        <td class="py-2">
                                            <div class="flex items-center gap-3">
                                                <a class="underline" href="{{ route('avancement.show', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}">Voir</a>
                                                @if ($canManage)
                                                    <a class="underline" href="{{ route('avancement.edit', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}">Modifier</a>
                                                    <form method="POST" action="{{ route('avancement.destroy', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}" onsubmit="return confirm('Supprimer cet avancement ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="underline text-red-600 dark:text-red-400">Supprimer</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4" colspan="5">Aucun avancement.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
