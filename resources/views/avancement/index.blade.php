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

                   
                    {{-- Barre de recherche et filtres --}}
                    <div class="mb-6">
                        <div class="relative max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400 text-lg'></i>
                            </div>
                            <input type="text" id="tableSearch" 
                                class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500 sm:text-sm" 
                                placeholder="Rechercher par enseignant, classe ou matière..." 
                                onkeyup="filterTable()">
                        </div>
                    </div>

                    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="avancementTable">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Enseignant</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Classe</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Matière</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Progression</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse ($avancements as $avancement)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $avancement->CodeE }}</div>
                                            @if ($avancement->enseignant?->Libelle)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $avancement->enseignant->Libelle }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                                {{ $avancement->CodeC }}
                                            </span>
                                            @if ($avancement->classe?->Libelle)
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($avancement->classe->Libelle, 20) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white font-medium">{{ $avancement->CodeM }}</div>
                                            @if ($avancement->matiere)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Total: {{ $avancement->matiere->MH }}h</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap align-middle">
                                            <div class="w-full max-w-xs">
                                                <div class="flex justify-between items-end mb-1">
                                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $avancement->MHRealise }}h</span>
                                                    @if($avancement->matiere && $avancement->matiere->MH > 0)
                                                        @php $percent = round(($avancement->MHRealise / $avancement->matiere->MH) * 100); @endphp
                                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ $percent }}%</span>
                                                    @endif
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700 overflow-hidden">
                                                    @if($avancement->matiere && $avancement->matiere->MH > 0)
                                                        @php
                                                            $percent = min(100, ($avancement->MHRealise / $avancement->matiere->MH) * 100);
                                                            $colorClass = $percent >= 100 ? 'bg-green-500' : ($percent >= 75 ? 'bg-indigo-500' : ($percent >= 50 ? 'bg-blue-500' : 'bg-yellow-500'));
                                                        @endphp
                                                        <div class="{{ $colorClass }} h-2 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                                                    @else
                                                        <div class="bg-gray-400 h-2 rounded-full" style="width: 0%"></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('avancement.show', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}" 
                                                   class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition-colors" 
                                                   title="Voir les détails">
                                                    <i class='bx bx-show text-xl'></i>
                                                </a>
                                                @if ($canManage)
                                                    <a href="{{ route('avancement.edit', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}" 
                                                       class="text-gray-500 hover:text-yellow-600 dark:text-gray-400 dark:hover:text-yellow-400 transition-colors" 
                                                       title="Modifier">
                                                        <i class='bx bx-edit text-xl'></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('avancement.destroy', [$avancement->CodeE, $avancement->CodeC, $avancement->CodeM]) }}" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avancement ?');" 
                                                          class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 transition-colors" 
                                                                title="Supprimer">
                                                            <i class='bx bx-trash text-xl'></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-8 whitespace-nowrap text-center text-gray-500 dark:text-gray-400" colspan="5">
                                            <div class="flex flex-col items-center justify-center">
                                                <i class='bx bx-data text-4xl mb-2 text-gray-300'></i>
                                                <p>Aucun avancement trouvé.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

                    <script>
                        function filterTable() {
                            const input = document.getElementById('tableSearch');
                            const filter = input.value.toLowerCase();
                            const table = document.getElementById('avancementTable');
                            const trs = table.getElementsByTagName('tr');

                            // Start loop from 1 to skip header row
                            for (let i = 1; i < trs.length; i++) {
                                const tr = trs[i];
                                if (tr.getElementsByTagName('td').length === 0) continue; // Skip if no td (e.g. extra rows)

                                // Get text content from relevant cells: Enseignant, Classe, Matiere
                                const tdEnseignant = tr.getElementsByTagName('td')[0];
                                const tdClasse = tr.getElementsByTagName('td')[1];
                                const tdMatiere = tr.getElementsByTagName('td')[2];

                                if (tdEnseignant || tdClasse || tdMatiere) {
                                    const txtEnseignant = tdEnseignant ? tdEnseignant.textContent || tdEnseignant.innerText : '';
                                    const txtClasse = tdClasse ? tdClasse.textContent || tdClasse.innerText : '';
                                    const txtMatiere = tdMatiere ? tdMatiere.textContent || tdMatiere.innerText : '';

                                    if (
                                        txtEnseignant.toLowerCase().indexOf(filter) > -1 ||
                                        txtClasse.toLowerCase().indexOf(filter) > -1 ||
                                        txtMatiere.toLowerCase().indexOf(filter) > -1
                                    ) {
                                        tr.style.display = "";
                                    } else {
                                        tr.style.display = "none";
                                    }
                                }
                            }
                        }
                    </script>

</x-app-layout>
