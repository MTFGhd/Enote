@php
    $user = Auth::user();
    $isAdmin = $user->role === 'admin';
    $isEnseignant = $user->role === 'E';
    $isDirection = $user->role === 'D';
@endphp

<x-app-layout>
    <div class="py-12 relative">
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div
                class="absolute top-0 left-1/4 w-96 h-96 bg-primary-300/20 dark:bg-primary-900/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen opacity-50 animate-blob">
            </div>
            <div
                class="absolute top-0 right-1/4 w-96 h-96 bg-purple-300/20 dark:bg-purple-900/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen opacity-50 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-300/20 dark:bg-pink-900/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen opacity-50 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Welcome Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                        Bonjour, <span
                            class="bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">{{ $user->name }}</span>
                        👋
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Voici ce qui se passe dans votre établissement aujourd'hui.
                    </p>
                </div>
                <div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold shadow-sm border
                        @if($isAdmin) bg-primary-50 text-primary-700 border-primary-200 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-800
                        @elseif($isEnseignant) bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800
                        @else bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-300 dark:border-emerald-800
                        @endif">
                        <span class="w-2 h-2 rounded-full mr-2
                            @if($isAdmin) bg-primary-500
                            @elseif($isEnseignant) bg-blue-500
                            @else bg-emerald-500
                            @endif"></span>
                        @if($isAdmin) Administrateur
                        @elseif($isEnseignant) Enseignant
                        @else Direction
                        @endif
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Hero Card -->
                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-600 to-purple-700 p-8 text-white shadow-xl">
                        <div class="relative z-10">
                            @if($isAdmin)
                                <h2 class="text-2xl font-bold mb-2">Gérez votre établissement</h2>
                                <p class="text-primary-100 mb-6 max-w-lg">Accédez à tous les outils d'administration pour
                                    gérer les départements, classes et enseignants en un seul endroit.</p>
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('departements.index') }}"
                                        class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-lg text-sm font-semibold transition-all">Départements</a>
                                    <a href="{{ route('classes.index') }}"
                                        class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-lg text-sm font-semibold transition-all">Classes</a>
                                    <a href="{{ route('enseignants.index') }}"
                                        class="px-4 py-2 bg-white text-primary-700 hover:bg-gray-100 rounded-lg text-sm font-semibold shadow-lg transition-all">Gérer
                                        le personnel</a>
                                </div>
                            @elseif($isEnseignant)
                                <h2 class="text-2xl font-bold mb-2">Vos séances de cours</h2>
                                <p class="text-primary-100 mb-6 max-w-lg">Enregistrez vos nouvelles séances, suivez
                                    l'avancement et consultez votre historique.</p>
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('cours.create') }}"
                                        class="px-4 py-2 bg-white text-primary-700 hover:bg-gray-100 rounded-lg text-sm font-semibold shadow-lg transition-all">Nouvelle
                                        séance</a>
                                    <a href="{{ route('cours.index') }}"
                                        class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-lg text-sm font-semibold transition-all">Historique</a>
                                </div>
                            @else
                                <h2 class="text-2xl font-bold mb-2">Suivi Pédagogique</h2>
                                <p class="text-primary-100 mb-6 max-w-lg">Consultez l'état d'avancement des cours et les
                                    statistiques globales de l'établissement.</p>
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('avancement.index') }}"
                                        class="px-4 py-2 bg-white text-primary-700 hover:bg-gray-100 rounded-lg text-sm font-semibold shadow-lg transition-all">Voir
                                        l'avancement</a>
                                </div>
                            @endif
                        </div>

                        <!-- Decorative Circles -->
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-2xl">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-purple-500/30 rounded-full blur-xl">
                        </div>
                    </div>

                    <!-- Quick Actions Grid -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Accès Rapide
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if($isAdmin)
                                <a href="{{ route('departements.index') }}"
                                    class="group glass p-5 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary-500/50 dark:hover:border-primary-500/50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                    <div class="flex items-start justify-between">
                                        <div
                                            class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <div class="text-gray-400 group-hover:text-primary-500 transition-colors">↗</div>
                                    </div>
                                    <h4 class="mt-4 font-semibold text-gray-900 dark:text-white">Départements</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gérer la structure</p>
                                </a>

                                <a href="{{ route('enseignants.index') }}"
                                    class="group glass p-5 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary-500/50 dark:hover:border-primary-500/50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                    <div class="flex items-start justify-between">
                                        <div
                                            class="p-3 rounded-lg bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div class="text-gray-400 group-hover:text-primary-500 transition-colors">↗</div>
                                    </div>
                                    <h4 class="mt-4 font-semibold text-gray-900 dark:text-white">Enseignants</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gérer le personnel</p>
                                </a>
                            @endif

                            <a href="{{ route('cours.index') }}"
                                class="group glass p-5 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary-500/50 dark:hover:border-primary-500/50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex items-start justify-between">
                                    <div
                                        class="p-3 rounded-lg bg-pink-50 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div class="text-gray-400 group-hover:text-primary-500 transition-colors">↗</div>
                                </div>
                                <h4 class="mt-4 font-semibold text-gray-900 dark:text-white">Séances</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Consulter l'historique</p>
                            </a>

                            <a href="{{ route('avancement.index') }}"
                                class="group glass p-5 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary-500/50 dark:hover:border-primary-500/50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex items-start justify-between">
                                    <div
                                        class="p-3 rounded-lg bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="text-gray-400 group-hover:text-primary-500 transition-colors">↗</div>
                                </div>
                                <h4 class="mt-4 font-semibold text-gray-900 dark:text-white">Avancement</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Suivi de progression</p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar / Widgets -->
                <div class="space-y-8">
                    <!-- Date Widget -->
                    <div class="glass rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Aujourd'hui</h3>
                            <span
                                class="text-xs font-medium px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">{{ date('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-center p-4">
                            <div class="text-center">
                                <div class="text-5xl font-display font-bold text-gray-900 dark:text-white">
                                    {{ date('d') }}</div>
                                <div class="text-xl font-medium text-primary-600">{{ date('F') }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ date('l') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Shortcut Links -->
                    <div class="glass rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Raccourcis</h3>
                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/50 flex items-center justify-center text-gray-500 dark:text-gray-400 group-hover:text-primary-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-primary-600 transition-colors">Mon
                                    Profil</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors group text-left">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 group-hover:bg-red-100 dark:group-hover:bg-red-900/50 flex items-center justify-center text-gray-500 dark:text-gray-400 group-hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-red-600 transition-colors">Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>