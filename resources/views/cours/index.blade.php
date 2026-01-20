<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                        {{ __('Séances') }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Historique et gestion des cours, TP et examens.
                    </p>
                </div>

                @php
                    $user = Auth::user();
                    $canCreate = in_array($user->role, ['E', 'admin']);
                    $typeLabels = ['C' => 'Cours', 'T' => 'TP', 'E' => 'Examen'];
                    $typeColors = ['C' => 'blue', 'T' => 'purple', 'E' => 'amber'];
                @endphp

                @if ($canCreate)
                    <a href="{{ route('cours.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5 hover:shadow-primary-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Saisir une séance') }}
                    </a>
                @endif
            </div>

            <!-- Filtres pour la Direction -->
            @if($user->role === 'D')
                <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Filtres</h3>
                            <a href="{{ route('cours.pdf.seances.form') }}"
                                class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                PDF Séances
                            </a>
                        </div>
                        <form method="GET" action="{{ route('cours.index') }}" class="flex gap-4 items-end">
                            <div class="flex-1">
                                <label for="valide" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Statut de validation
                                </label>
                                <select name="valide" id="valide" 
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                                    <option value="">Toutes les séances</option>
                                    <option value="1" {{ request('valide') === '1' ? 'selected' : '' }}>Séances validées</option>
                                    <option value="0" {{ request('valide') === '0' ? 'selected' : '' }}>Séances non validées</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Filtrer
                                </button>
                            </div>
                            @if(request()->has('valide'))
                                <div>
                                    <a href="{{ route('cours.index') }}" 
                                        class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold transition-colors">
                                        Réinitialiser
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            @endif

            <!-- Content Card -->
            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 overflow-hidden">
                <div class="p-6">
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-100 dark:border-green-800 flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-100 dark:border-red-800">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Enseignant</th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Classe</th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Matière</th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Type</th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Date & Heure
                                    </th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300 text-center">
                                        Durée</th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300 text-center">
                                        Absents</th>
                                    @if($user->role === 'D')
                                        <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300 text-center">
                                            Statut</th>
                                    @endif
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300 text-right">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($cours as $seance)
                                    @php
                                        $canEdit = in_array($user->role, ['E', 'admin']) && ($user->role !== 'E' || $seance->CodeE === $user->CodeE);
                                        $canDelete = $user->role === 'admin';
                                        $typeColor = $typeColors[$seance->Type] ?? 'gray';
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $seance->CodeE }}
                                            </div>
                                            @if ($seance->enseignant?->Libelle)
                                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[150px]">
                                                    {{ $seance->enseignant->Libelle }}</div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $seance->CodeC }}
                                            </div>
                                            @if ($seance->classe?->Libelle)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $seance->classe->Libelle }}</div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $seance->CodeM }}
                                            </div>
                                            @if ($seance->matiere)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Coef:
                                                    {{ $seance->matiere->Coef }}</div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $typeColor }}-100 text-{{ $typeColor }}-800 dark:bg-{{ $typeColor }}-900/30 dark:text-{{ $typeColor }}-300">
                                                {{ $typeLabels[$seance->Type] ?? $seance->Type }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-900 dark:text-white">
                                                    {{ $seance->Jour ? \Illuminate\Support\Carbon::parse($seance->Jour)->format('d/m/Y') : '—' }}
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $seance->HeureDebut }} - {{ $seance->HeureFin }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="font-mono text-sm">{{ $seance->Duree }}h</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            @if($seance->NbAbsent > 0)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                    {{ $seance->NbAbsent }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        @if($user->role === 'D')
                                            <td class="py-4 px-4 text-center">
                                                @if($seance->Valide)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Validée
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                        </svg>
                                                        En attente
                                                    </span>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="py-4 px-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Bouton Valider pour Direction si séance non validée -->
                                                @if($user->role === 'D' && !$seance->Valide)
                                                    <form method="POST" action="{{ route('cours.valider', $seance->NumC) }}" class="inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="p-2 rounded-lg text-green-600 hover:text-green-700 hover:bg-green-50 dark:hover:bg-green-900/30 transition-colors"
                                                            title="Valider la séance"
                                                            onclick="return confirm('Valider cette séance ?');">
                                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('cours.show', $seance) }}"
                                                    class="p-2 rounded-lg text-gray-500 hover:text-primary-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                                    title="Voir">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                @if ($canEdit)
                                                    <a href="{{ route('cours.edit', $seance) }}"
                                                        class="p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                                        title="Modifier">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                @endif
                                                @if ($canDelete)
                                                    <form method="POST" action="{{ route('cours.destroy', $seance) }}"
                                                        onsubmit="return confirm('Supprimer cette séance ?');"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 rounded-lg text-gray-500 hover:text-red-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                                            title="Supprimer">
                                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-8 text-center text-gray-500 dark:text-gray-400" colspan="8">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                <p>Aucune séance trouvée.</p>
                                                @if ($canCreate)
                                                    <a href="{{ route('cours.create') }}"
                                                        class="mt-2 text-primary-600 hover:text-primary-500 font-medium">Commencer
                                                        par en créer une</a>
                                                @endif
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
</x-app-layout>