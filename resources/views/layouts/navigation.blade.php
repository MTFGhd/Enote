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
    }" class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="hidden md:flex items-center gap-2">
                    <div class="relative" @click.outside="gestionOpen = false">
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900"
                            @click="gestionOpen = !gestionOpen"
                            :aria-expanded="gestionOpen.toString()"
                            aria-haspopup="true">
                            Gestion
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="gestionOpen" x-transition
                            class="absolute left-0 mt-2 w-56 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
                            <a href="{{ route('clients.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">Clients</a>
                            <a href="{{ route('commandes.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">Commandes</a>
                            <a href="{{ route('factures.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">Factures</a>
                        </div>
                    </div>

                    <a href="{{ route('dashboard') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">
                        Dashboard
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900"
                    @click="toggleTheme()"
                    :aria-label="theme === 'dark' ? 'Activer le thème clair' : 'Activer le thème sombre'">
                    <svg x-show="theme === 'light'" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10 2a.75.75 0 01.75.75V4a.75.75 0 01-1.5 0V2.75A.75.75 0 0110 2zM10 16a.75.75 0 01.75.75V18a.75.75 0 01-1.5 0v-1.25A.75.75 0 0110 16zM4.222 4.222a.75.75 0 011.06 0l.884.884a.75.75 0 11-1.06 1.06l-.884-.884a.75.75 0 010-1.06zM13.834 13.834a.75.75 0 011.06 0l.884.884a.75.75 0 11-1.06 1.06l-.884-.884a.75.75 0 010-1.06zM2 10a.75.75 0 01.75-.75H4a.75.75 0 010 1.5H2.75A.75.75 0 012 10zM16 10a.75.75 0 01.75-.75H18a.75.75 0 010 1.5h-1.25A.75.75 0 0116 10zM4.222 15.778a.75.75 0 010-1.06l.884-.884a.75.75 0 111.06 1.06l-.884.884a.75.75 0 01-1.06 0zM13.834 6.166a.75.75 0 010-1.06l.884-.884a.75.75 0 111.06 1.06l-.884.884a.75.75 0 01-1.06 0z"/>
                        <path d="M10 6a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <svg x-cloak x-show="theme === 'dark'" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M17.293 13.293a8 8 0 01-10.586-10.586.75.75 0 00-1.012-.88A9.5 9.5 0 1018.173 14.305a.75.75 0 00-.88-1.012z"/>
                    </svg>
                </button>

                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                        Login
                    </a>
                @endguest

                @auth
                    <div class="relative hidden md:block" @click.outside="userOpen = false">
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900"
                            @click="userOpen = !userOpen"
                            :aria-expanded="userOpen.toString()"
                            aria-haspopup="true">
                            {{ Auth::user()->name }}
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="userOpen" x-transition
                            class="absolute right-0 mt-2 w-56 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200 dark:border-gray-700">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <button type="button"
                    class="inline-flex md:hidden items-center justify-center rounded-md p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900"
                    @click="mobileOpen = !mobileOpen"
                    :aria-expanded="mobileOpen.toString()"
                    aria-controls="mobile-menu"
                    aria-label="Menu">
                    <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-cloak x-show="mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-cloak x-show="mobileOpen" x-transition id="mobile-menu" class="md:hidden border-t border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Dashboard</a>
            <div class="px-3 pt-2 text-xs font-semibold text-gray-500 dark:text-gray-400">Gestion</div>
            <a href="{{ route('clients.index') }}" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Clients</a>
            <a href="{{ route('commandes.index') }}" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Commandes</a>
            <a href="{{ route('factures.index') }}" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Factures</a>

            @auth
                <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="px-3 text-sm font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="px-3 text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    <a href="{{ route('profile.edit') }}" class="mt-2 block rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Log Out</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">Login</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
