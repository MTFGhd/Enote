<x-app-layout>
    <x-slot name="header">
        Classes
    </x-slot>

    <div class="max-w-7xl mx-auto flex flex-col gap-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
            <div class="flex flex-col gap-2">
                <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-tight">Liste des Classes</h1>
                <p class="text-[#64748b] dark:text-gray-400 text-base font-normal leading-normal max-w-2xl">
                    Gérez vos classes académiques, suivez les inscriptions des étudiants et organisez les plannings départementaux.
                </p>
            </div>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('classes.create') }}" class="flex items-center justify-center gap-2 rounded-xl h-11 px-6 bg-primary hover:bg-primary-hover text-white text-sm font-bold leading-normal tracking-wide transition-all shadow-lg shadow-primary/20 shrink-0">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span class="truncate">Nouvelle Classe</span>
            </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-8 lg:col-span-9">
                <div class="relative flex w-full items-center h-12 rounded-xl bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 focus-within:border-primary/50 focus-within:ring-1 focus-within:ring-primary/50 transition-all shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-[#64748b]">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <!-- TODO: Implement search with Livewire or form submission -->
                    <input class="w-full h-full bg-transparent border-none focus:ring-0 text-slate-900 dark:text-white placeholder-[#64748b] pl-11 pr-4 rounded-xl text-base" placeholder="Rechercher par nom, ID..." type="text"/>
                </div>
            </div>
            <div class="md:col-span-4 lg:col-span-3">
                 <!-- Placeholder filter -->
                <button class="w-full flex items-center justify-between h-12 px-4 rounded-xl bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 text-slate-700 dark:text-white hover:bg-slate-50 dark:hover:bg-white/5 transition-colors text-sm font-medium">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#64748b] text-[20px]">filter_list</span>
                        <span>Tous les Départements</span>
                    </span>
                    <span class="material-symbols-outlined text-[#64748b] text-[20px]">expand_more</span>
                </button>
            </div>
        </div>

        <div class="flex flex-col rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-[#292938] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-[#222230] border-b border-gray-200 dark:border-white/5">
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[40%]">Nom de la Classe</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[20%]">Département</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[20%]">Cours Associés</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[20%] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                        @foreach ($classes as $classe)
                        <tr class="group hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-slate-900 dark:text-white font-medium text-base">{{ $classe->Libelle }}</span>
                                    <span class="text-[#64748b] text-sm">{{ $classe->CodeC }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                    {{ $classe->departement->Libelle ?? $classe->CodeD }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-slate-700 dark:text-gray-300">
                                    <span class="material-symbols-outlined text-[18px] text-[#64748b]">school</span>
                                    <span>{{ $classe->cours()->count() }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-100 sm:opacity-60 sm:group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('classes.show', $classe) }}" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 text-[#64748b] hover:text-slate-900 dark:hover:text-white transition-colors" title="Voir les détails">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('classes.edit', $classe) }}" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 text-[#64748b] hover:text-primary transition-colors" title="Modifier la classe">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('classes.destroy', $classe) }}" onsubmit="return confirm('Êtes-vous sûr ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-[#64748b] hover:text-red-600 transition-colors" title="Supprimer la classe">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-200 dark:border-white/5 bg-white dark:bg-[#292938] px-6 py-4">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
