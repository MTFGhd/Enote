<nav x-data="{
        mobileOpen: false,
        gestionOpen: false,
        userOpen: false,
        theme: (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
        toggleTheme() {
            this.theme = (this.theme === 'dark') ? 'light' : 'dark';
            if (this.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            try { localStorage.setItem('theme', this.theme); } catch (e) {}
        }
    }"
    class="sticky top-0 z-50 w-full glass border-b border-gray-200/50 dark:border-gray-700/50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <div class="flex items-center gap-10">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('enote-logo.png') }}" alt="{{ config('app.name', 'Enote') }}" class="h-12 w-auto group-hover:scale-105 transition-transform duration-300">
                    <span class="text-2xl font-display font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                        {{ config('app.name', 'Enote') }}
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        Dashboard
                    </a>


                    <div class="relative" @click.outside="gestionOpen = false">
                        <button type="button"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                            {{ request()->is('users*', 'departements*', 'classes*', 'matieres*', 'enseignants*', 'cours*', 'avancement*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}"
                            @click="gestionOpen = !gestionOpen" :aria-expanded="gestionOpen.toString()">
                            <span>Gestion</span>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="{'rotate-180': gestionOpen}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="gestionOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute left-0 mt-3 w-60 rounded-xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden z-50">

                            @if (Auth::user()->role === 'admin')
                                <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Administration</div>
                                <a href="{{ route('users.index') }}"
                                    class="block px-4 py-2.5 text-sm transition-colors {{ request()->is('users*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/40 dark:text-primary-300' : 'text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300' }}">Utilisateurs</a>
                                <a href="{{ route('departements.index') }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">Départements</a>
                                <a href="{{ route('classes.index') }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">Classes</a>
                                <a href="{{ route('matieres.index') }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">Matières</a>
                                <a href="{{ route('enseignants.index') }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">Enseignants</a>
                                <div class="my-1 border-t border-gray-100 dark:border-gray-700"></div>
                            @endif
                            <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Académique</div>
                            <a href="{{ route('cours.index') }}"
                                class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">Séances</a>
                            <a href="{{ route('avancement.index') }}"
                                class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">Avancement</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button type="button"
                    class="p-2 text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20"
                    @click="toggleTheme()">
                    <svg x-show="theme === 'light'" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 2a.75.75 0 01.75.75V4a.75.75 0 01-1.5 0V2.75A.75.75 0 0110 2zM10 16a.75.75 0 01.75.75V18a.75.75 0 01-1.5 0v-1.25A.75.75 0 0110 16zM4.222 4.222a.75.75 0 011.06 0l.884.884a.75.75 0 11-1.06 1.06l-.884-.884a.75.75 0 010-1.06zM13.834 13.834a.75.75 0 011.06 0l.884.884a.75.75 0 11-1.06 1.06l-.884-.884a.75.75 0 010-1.06zM2 10a.75.75 0 01.75-.75H4a.75.75 0 010 1.5H2.75A.75.75 0 012 10zM16 10a.75.75 0 01.75-.75H18a.75.75 0 010 1.5h-1.25A.75.75 0 0116 10zM4.222 15.778a.75.75 0 010-1.06l.884-.884a.75.75 0 111.06 1.06l-.884.884a.75.75 0 01-1.06 0zM13.834 6.166a.75.75 0 010-1.06l.884-.884a.75.75 0 111.06 1.06l-.884.884a.75.75 0 01-1.06 0z" />
                        <path d="M10 6a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg x-cloak x-show="theme === 'dark'" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M17.293 13.293a8 8 0 01-10.586-10.586.75.75 0 00-1.012-.88A9.5 9.5 0 1018.173 14.305a.75.75 0 00-.88-1.012z" />
                    </svg>
                </button>

                @guest
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 shadow-md shadow-primary-500/20 transition-all duration-200">
                        Log in
                    </a>
                @endguest

                @auth
                    <!-- User Dropdown -->
                    <div class="relative hidden md:block" @click.outside="userOpen = false">
                        <button type="button" class="flex items-center gap-2 group focus:outline-none"
                            @click="userOpen = !userOpen">
                            <div
                                class="h-9 w-9 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center text-primary-700 dark:text-primary-300 font-bold shadow-sm ring-2 ring-transparent group-hover:ring-primary-500/30 transition-all">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="text-left hidden lg:block">
                                <div
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                    {{ Auth::user()->name }}</div>
                            </div>
                            <svg class="h-4 w-4 text-gray-400 group-hover:text-gray-600 transition-colors duration-200"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="userOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-3 w-56 rounded-xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-xl ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700 z-50">

                            <div class="px-4 py-3">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}"
                                    class="group flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/40 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-primary-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>
                            </div>

                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full group flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-red-500" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button type="button"
                    class="md:hidden p-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none"
                    @click="mobileOpen = !mobileOpen">
                    <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-cloak x-show="mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-cloak x-show="mobileOpen" x-collapse
        class="md:hidden border-t border-gray-200 dark:border-gray-700 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl">
        <div class="px-4 pt-3 pb-8 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100' }}">Dashboard</a>

            <div class="px-3 pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Gestion</p>
            </div>

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('users.index') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->is('users*') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900' }}">Utilisateurs</a>
                <a href="{{ route('departements.index') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900">Départements</a>
                <a href="{{ route('classes.index') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900">Classes</a>
                <a href="{{ route('matieres.index') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900">Matières</a>
                <a href="{{ route('enseignants.index') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900">Enseignants</a>
            @endif
            <a href="{{ route('cours.index') }}"
                class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900">Séances</a>
            <a href="{{ route('avancement.index') }}"
                class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900">Avancement</a>

            @auth
                <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                    <div class="px-3 flex items-center gap-3">
                        <div
                            class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-4 px-2 space-y-1">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block px-3 py-2 rounded-lg text-base font-medium text-red-600 hover:bg-red-50">Log
                                Out</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
