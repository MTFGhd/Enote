<x-app-layout>
    <x-slot name="header">
        Étudiants
    </x-slot>

    <div class="max-w-7xl mx-auto flex flex-col gap-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
            <div class="flex flex-col gap-2">
                <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-tight">Liste des Étudiants</h1>
                <p class="text-[#64748b] dark:text-gray-400 text-base font-normal leading-normal max-w-2xl">
                    Gérez les étudiants, suivez leurs inscriptions et consultez leurs absences.
                </p>
            </div>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('etudiants.create') }}" class="flex items-center justify-center gap-2 rounded-xl h-11 px-6 bg-primary hover:bg-primary-hover text-white text-sm font-bold leading-normal tracking-wide transition-all shadow-lg shadow-primary/20 shrink-0">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span class="truncate">Nouvel Étudiant</span>
            </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-8 lg:col-span-9">
                <div class="relative flex w-full items-center h-12 rounded-xl bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 focus-within:border-primary/50 focus-within:ring-1 focus-within:ring-primary/50 transition-all shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-[#64748b]">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input 
                        data-search="etudiants"
                        class="w-full h-full bg-transparent border-none focus:ring-0 text-slate-900 dark:text-white placeholder-[#64748b] pl-11 pr-4 rounded-xl text-base" 
                        placeholder="Rechercher par nom, prénom, email..." 
                        type="text"
                    />
                </div>
            </div>
            <div class="md:col-span-4 lg:col-span-3">
                <select 
                    data-filter="etudiants"
                    class="w-full flex items-center justify-between h-12 px-4 rounded-xl bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 text-slate-700 dark:text-white hover:bg-slate-50 dark:hover:bg-white/5 transition-colors text-sm font-medium appearance-none cursor-pointer"
                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27%2364748b%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;"
                >
                    <option value="all">Toutes les Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->CodeC }}">{{ $class->Libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-[#292938] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-[#222230] border-b border-gray-200 dark:border-white/5">
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[30%]">Étudiant</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[25%]">Email</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[20%]">Classe</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[25%] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-white/5" data-table="etudiants">
                        @foreach ($etudiants as $etudiant)
                        <tr class="group hover:bg-slate-50 dark:hover:bg-white/5 transition-colors" data-classe="{{ $etudiant->CodeC }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                        {{ strtoupper(substr($etudiant->Prenom, 0, 1) . substr($etudiant->Nom, 0, 1)) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-slate-900 dark:text-white font-medium text-base">
                                            <span data-prenom>{{ $etudiant->Prenom }}</span> <span data-nom>{{ $etudiant->Nom }}</span>
                                        </span>
                                        <span class="text-[#64748b] text-sm" data-code>{{ $etudiant->CodeE }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-700 dark:text-gray-300 text-sm" data-email>{{ $etudiant->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                    {{ $etudiant->classe->Libelle ?? $etudiant->CodeC }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-100 sm:opacity-60 sm:group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('etudiants.show', $etudiant) }}" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 text-[#64748b] hover:text-slate-900 dark:hover:text-white transition-colors" title="Voir les détails">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('etudiants.edit', $etudiant) }}" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 text-[#64748b] hover:text-primary transition-colors" title="Modifier l'étudiant">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('etudiants.destroy', $etudiant) }}" onsubmit="return confirm('Êtes-vous sûr ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-[#64748b] hover:text-red-600 transition-colors" title="Supprimer l'étudiant">
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
        </div>
    </div>
</x-app-layout>
