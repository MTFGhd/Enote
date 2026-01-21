@php
    use App\Models\User;
    use App\Models\Cours;
    use App\Models\Departements;
    use App\Models\Enseignants;

    $user = Auth::user();
    // Quick counts for demo - Ideally passed from controller
    $totalStudents = 1240; 
    $activeCourses = Cours::count();
    $teachersCount = Enseignants::count();
    $deptsCount = Departements::count();
@endphp
<x-app-layout>
    <x-slot name="header">
        Tableau de bord
    </x-slot>

    <div class="max-w-7xl mx-auto flex flex-col gap-8">
        <!-- Stats Row -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Students/Users -->
            <div class="relative overflow-hidden rounded-2xl p-6 bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow group">
                <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 bg-primary/10 rounded-full blur-2xl group-hover:bg-primary/20 transition-all"></div>
                <div class="relative z-10 flex flex-col gap-4">
                    <div class="h-12 w-12 rounded-xl bg-primary/20 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <div>
                        <p class="text-[#9d9eb8] text-sm font-medium">Utilisateurs</p>
                        <div class="flex items-end gap-3 mt-1">
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ \App\Models\User::count() }}</h3>
                            <span class="text-[#0bda68] text-sm font-medium mb-1 flex items-center">
                                <span class="material-symbols-outlined text-sm mr-0.5">trending_up</span>
                                +5%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Courses -->
            <div class="relative overflow-hidden rounded-2xl p-6 bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow group">
                 <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all"></div>
                <div class="relative z-10 flex flex-col gap-4">
                    <div class="h-12 w-12 rounded-xl bg-purple-500/20 flex items-center justify-center text-purple-400">
                        <span class="material-symbols-outlined">school</span>
                    </div>
                    <div>
                        <p class="text-[#9d9eb8] text-sm font-medium">Cours Actifs</p>
                        <div class="flex items-end gap-3 mt-1">
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $activeCourses }}</h3>
                            <span class="text-[#0bda68] text-sm font-medium mb-1 flex items-center">
                                <span class="material-symbols-outlined text-sm mr-0.5">trending_up</span>
                                +12%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teachers -->
            <div class="relative overflow-hidden rounded-2xl p-6 bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow group">
                <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 bg-orange-500/10 rounded-full blur-2xl group-hover:bg-orange-500/20 transition-all"></div>
                <div class="relative z-10 flex flex-col gap-4">
                    <div class="h-12 w-12 rounded-xl bg-orange-500/20 flex items-center justify-center text-orange-400">
                        <span class="material-symbols-outlined">supervisor_account</span>
                    </div>
                    <div>
                        <p class="text-[#9d9eb8] text-sm font-medium">Enseignants</p>
                        <div class="flex items-end gap-3 mt-1">
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $teachersCount }}</h3>
                            <span class="text-[#9d9eb8] text-sm font-medium mb-1">Stable</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Departments -->
             <div class="relative overflow-hidden rounded-2xl p-6 bg-white dark:bg-[#292938] border border-gray-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow group">
                <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 bg-teal-500/10 rounded-full blur-2xl group-hover:bg-teal-500/20 transition-all"></div>
                <div class="relative z-10 flex flex-col gap-4">
                    <div class="h-12 w-12 rounded-xl bg-teal-500/20 flex items-center justify-center text-teal-400">
                        <span class="material-symbols-outlined">domain</span>
                    </div>
                    <div>
                        <p class="text-[#9d9eb8] text-sm font-medium">Départements</p>
                        <div class="flex items-end gap-3 mt-1">
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $deptsCount }}</h3>
                            <span class="text-[#9d9eb8] text-sm font-medium mb-1">Stable</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Activities / Content -->
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="flex-1 flex flex-col bg-white dark:bg-[#292938] rounded-2xl border border-gray-200 dark:border-white/5 overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-white/5">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Derniers Cours Ajoutés</h3>
                    <a href="{{ route('cours.index') }}" class="text-sm font-medium text-primary hover:text-primary/80">Voir tout</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[#9d9eb8] text-xs font-semibold uppercase tracking-wider bg-gray-50 dark:bg-[#222230]">
                                <th class="p-5">Cours</th>
                                <th class="p-5">Enseignant</th>
                                <th class="p-5">Date</th>
                                <th class="p-5">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-200 dark:divide-white/5">
                            @foreach(\App\Models\Cours::orderBy('Jour', 'desc')->take(5)->get() as $course)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-lg bg-blue-500/20 flex items-center justify-center text-blue-400">
                                            <span class="material-symbols-outlined text-lg">school</span>
                                        </div>
                                        <div>
                                            <span class="text-slate-900 dark:text-white font-medium block">{{ $course->matiere?->Libelle ?? 'Matière inconnue' }}</span>
                                            <span class="text-[#9d9eb8] text-xs">{{ $course->classe?->Libelle ?? $course->CodeC }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-5">
                                    <div class="flex items-center gap-2">
                                        <div class="h-6 w-6 rounded-full bg-cover bg-center" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($course->enseignant?->Libelle ?? 'E') }}");'></div>
                                        <span class="text-slate-700 dark:text-[#e2e2e8]">{{ $course->enseignant?->Libelle ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="p-5 text-[#9d9eb8]">{{ $course->Jour ? $course->Jour->format('d M Y') : 'N/A' }}</td>
                                <td class="p-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#0bda68]/10 text-[#0bda68]">
                                        <span class="h-1.5 w-1.5 rounded-full bg-[#0bda68]"></span>
                                        {{ $course->Valide ? 'Validé' : 'En attente' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @if(\App\Models\Cours::count() == 0)
                            <tr>
                                <td colspan="4" class="p-5 text-center text-gray-500">Aucun cours trouvé.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
