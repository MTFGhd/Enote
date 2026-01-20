<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-900 overflow-x-hidden selection:bg-primary-500 selection:text-white">

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div
            class="absolute top-0 -left-1/4 w-full h-full bg-gradient-to-br from-primary-500/10 to-transparent rounded-full blur-3xl opacity-30">
        </div>
        <div
            class="absolute bottom-0 -right-1/4 w-full h-full bg-gradient-to-tl from-purple-500/10 to-transparent rounded-full blur-3xl opacity-30">
        </div>
    </div>

    <div class="relative z-10 flex min-h-screen flex-col">
        <!-- Header -->
        <header
            class="w-full py-6 px-6 lg:px-12 flex justify-between items-center glass sticky top-0 z-50 border-b border-white/20 dark:border-gray-800/50">
            <div class="flex items-center gap-3">
                <img src="{{ asset('enote-logo.png') }}" alt="{{ config('app.name', 'Enote') }}" class="h-12 w-auto">
                <span
                    class="text-2xl font-display font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300">
                    {{ config('app.name', 'Enote') }}
                </span>
            </div>

            <nav class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors px-4 py-2">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5 hover:shadow-primary-500/40">Inscription</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center pt-20 pb-32 px-6">
            <div class="max-w-6xl mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 dark:bg-primary-900/30 border border-primary-100 dark:border-primary-800 text-primary-600 dark:text-primary-300 text-sm font-medium mb-8 animate-fade-in-up">
                    <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                    Nouvelle version disponible
                </div>

                <h1 class="text-5xl md:text-7xl font-display font-bold tracking-tight mb-8">
                    La gestion scolaire <br>
                    <span
                        class="bg-gradient-to-r from-primary-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">réinventée</span>
                </h1>

                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Une plateforme moderne, intuitive et puissante pour simplifier la vie de votre établissement.
                    Pilotez vos départements, classes et cours en toute sérénité.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-primary-600 hover:bg-primary-700 text-white font-semibold text-lg shadow-xl shadow-primary-500/30 transition-all hover:-translate-y-1 hover:shadow-primary-500/50 flex items-center justify-center gap-2">
                        Commencer maintenant
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5l6 6m0 0l-6 6m6-6H3" />
                        </svg>
                    </a>
                    <a href="#features"
                        class="w-full sm:w-auto px-8 py-4 rounded-2xl glass border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 font-semibold text-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all hover:-translate-y-1">
                        En savoir plus
                    </a>
                </div>

                <!-- Feature Grid -->
                <div id="features" class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                    <div
                        class="p-8 rounded-3xl glass border border-gray-100 dark:border-gray-700/50 hover:border-primary-500/30 dark:hover:border-primary-500/30 transition-colors group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Administration Simplifiée</h3>
                        <p class="text-gray-600 dark:text-gray-400">Gérez facilement vos départements, classes et
                            structures académiques depuis un tableau de bord centralisé.</p>
                    </div>

                    <div
                        class="p-8 rounded-3xl glass border border-gray-100 dark:border-gray-700/50 hover:border-purple-500/30 dark:hover:border-purple-500/30 transition-colors group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Gestion du Personnel</h3>
                        <p class="text-gray-600 dark:text-gray-400">Suivez vos enseignants, leurs affectations et leurs
                            progressions avec des outils dédiés.</p>
                    </div>

                    <div
                        class="p-8 rounded-3xl glass border border-gray-100 dark:border-gray-700/50 hover:border-pink-500/30 dark:hover:border-pink-500/30 transition-colors group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-pink-50 dark:bg-pink-900/20 text-pink-600 dark:text-pink-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Suivi d'Avancement</h3>
                        <p class="text-gray-600 dark:text-gray-400">Visualisez en temps réel la progression des cours et
                            le respect des programmes pédagogiques.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="py-8 px-6 text-center text-sm text-gray-500 dark:text-gray-400 glass border-t border-white/20 dark:border-gray-800/50">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
        </footer>
    </div>
</body>

</html>