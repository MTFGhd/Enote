<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Enote') }} - La gestion scolaire réinventée</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-white dark:bg-[#0a0a0c] overflow-x-hidden selection:bg-primary-500 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- Navbar -->
    <nav class="fixed w-full top-0 z-50 px-4 md:px-16 lg:px-24 xl:px-32 py-4 transition-all duration-300 border-b border-gray-200/50 dark:border-gray-800/50 glass">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('enote-logo.png') }}" alt="Enote" class="h-10 w-auto">
                <span class="text-2xl font-display font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                    Enote
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-sm font-medium hover:text-primary-600 transition-colors">Fonctionnalités</a>
                <a href="#stats" class="text-sm font-medium hover:text-primary-600 transition-colors">Impact</a>
                <a href="#testimonials" class="text-sm font-medium hover:text-primary-600 transition-colors">Témoignages</a>
                
                <div class="h-5 w-px bg-gray-200 dark:bg-gray-700"></div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="py-2.5 px-6 bg-primary-600 hover:bg-primary-700 text-white rounded-full text-sm font-semibold transition-all shadow-lg shadow-primary-500/25">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-primary-600 px-4">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="py-2.5 px-6 bg-primary-600 hover:bg-primary-700 text-white rounded-full text-sm font-semibold transition-all shadow-lg shadow-primary-500/25">Inscription</a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600 dark:text-gray-400">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-[-10px]"
         class="fixed inset-0 z-40 md:hidden pt-20 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 overflow-hidden h-max">
        <div class="flex flex-col gap-4 p-6 text-base font-medium">
            <a @click="mobileMenuOpen = false" href="#features" class="py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors">Fonctionnalités</a>
            <a @click="mobileMenuOpen = false" href="#stats" class="py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors">Impact</a>
            <a @click="mobileMenuOpen = false" href="#testimonials" class="py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors">Témoignages</a>
            <hr class="border-gray-100 dark:border-gray-800">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="py-3 px-6 bg-primary-600 text-white rounded-xl text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="py-3 px-6 bg-primary-600 text-white rounded-xl text-center">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden dark:bg-[radial-gradient(circle_at_top_right,#1e1b4b,transparent_40%)]">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -z-10 bg-primary-500/10 w-[500px] h-[500px] rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 -z-10 bg-purple-500/10 w-[400px] h-[400px] rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-16 lg:px-24 xl:px-32 flex flex-col items-center text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white/50 dark:bg-white/[0.03] backdrop-blur-md p-1.5 pr-4 rounded-full border border-gray-200 dark:border-white/[0.08] shadow-sm mb-8 animate-fade-in">
                <div class="flex items-center -space-x-2">
                    <img class="size-7 rounded-full border-2 border-white dark:border-gray-900" src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="user">
                    <img class="size-7 rounded-full border-2 border-white dark:border-gray-900" src="https://api.dicebear.com/7.x/avataaars/svg?seed=2" alt="user">
                    <img class="size-7 rounded-full border-2 border-white dark:border-gray-900" src="https://api.dicebear.com/7.x/avataaars/svg?seed=3" alt="user">
                </div>
                <span class="text-xs font-semibold text-gray-600 dark:text-gray-400 ml-1">Rejoint par +100 établissements</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-display font-bold tracking-tight mb-6 leading-[1.1]">
                La gestion scolaire <br>
                <span class="bg-gradient-to-r from-primary-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent italic">réinventée pour demain.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mb-10 leading-relaxed">
                Une plateforme unifiée pour piloter vos départements, suivre les enseignants et monitorer la progression académique en temps réel.
            </p>

            <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                <a href="{{ route('register') }}" class="w-full sm:w-auto py-4 px-8 bg-primary-600 hover:bg-primary-700 text-white rounded-full font-bold text-lg shadow-xl shadow-primary-500/25 transition-all hover:-translate-y-1">
                    Essayer gratuitement
                </a>
                <a href="#features" class="w-full sm:w-auto py-4 px-8 bg-gray-100 dark:bg-white/[0.05] hover:bg-gray-200 dark:hover:bg-white/[0.1] text-gray-700 dark:text-gray-300 rounded-full font-semibold text-lg transition-all border border-gray-200 dark:border-white/[0.08]">
                    Découvrir les fonctions
                </a>
            </div>

            <!-- Dashboard Mockup (Visual highlight) -->
            <div class="mt-20 relative w-full group">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-purple-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-1000"></div>
                <div class="relative bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2426&q=80" 
                         alt="Dashboard Preview" 
                         class="w-full h-auto opacity-90 group-hover:opacity-100 transition-opacity">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="border-y border-gray-100 dark:border-gray-800/50 py-16 bg-gray-50/50 dark:bg-black/20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center space-y-2">
                <div class="text-4xl font-bold font-display text-primary-600">100+</div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">Écoles</div>
            </div>
            <div class="text-center space-y-2">
                <div class="text-4xl font-bold font-display text-indigo-600">50K+</div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">Étudiants</div>
            </div>
            <div class="text-center space-y-2">
                <div class="text-4xl font-bold font-display text-purple-600">99.9%</div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">Disponibilité</div>
            </div>
            <div class="text-center space-y-2">
                <div class="text-4xl font-bold font-display text-pink-600">24/7</div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">Support</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 px-4 md:px-16 lg:px-24 xl:px-32">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                <!-- Content -->
                <div class="flex flex-col justify-center space-y-6">
                    <div class="inline-flex text-primary-600 font-bold tracking-widest uppercase text-sm">Pourquoi choisir Enote ?</div>
                    <h2 class="text-4xl md:text-5xl font-display font-bold leading-tight">
                        Tout ce dont vous avez besoin pour <span class="text-primary-600">exceller</span>.
                    </h2>
                    <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
                        Plus qu'un simple logiciel, Enote est votre partenaire quotidien pour une éducation mieux organisée et plus performante.
                    </p>
                    <div class="pt-6">
                        <a href="{{ route('register') }}" class="group flex items-center gap-3 font-bold text-primary-600 hover:text-primary-700 transition-colors">
                            Commencer l'aventure 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 group-hover:translate-x-1 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5l6 6m0 0l-6 6m6-6H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-8 rounded-3xl bg-white dark:bg-white/[0.02] border border-gray-100 dark:border-white/[0.05] shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="size-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18.75" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Administration</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Structurez vos départements et classes avec une simplicité déconcertante.</p>
                    </div>

                    <div class="p-8 rounded-3xl bg-white dark:bg-white/[0.02] border border-gray-100 dark:border-white/[0.05] shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="size-12 rounded-2xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a5.971 5.971 0 00-.941 3.197m0 0a5.995 5.995 0 005.058 2.771M12 12.75a5.996 5.996 0 005.058-2.772M12 12.75a5.996 5.996 0 01-5.058-2.772M12 12.75V4.5m0 0a2.25 2.25 0 114.5 0 2.25 2.25 0 11-4.5 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5a2.25 2.25 0 10-4.5 0 2.25 2.25 0 104.5 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Enseignants</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Gérez les affectations, les absences et les dossiers du personnel.</p>
                    </div>

                    <div class="p-8 rounded-3xl bg-white dark:bg-white/[0.02] border border-gray-100 dark:border-white/[0.05] shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="size-12 rounded-2xl bg-orange-50 dark:bg-orange-900/20 text-orange-600 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Avancement</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Tableaux de bord dynamiques pour suivre l'avancement des cours.</p>
                    </div>

                    <div class="p-8 rounded-3xl bg-white dark:bg-white/[0.02] border border-gray-100 dark:border-white/[0.05] shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="size-12 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.052-.882 1.9-1.97 1.9H5.72a1.965 1.965 0 01-1.97-1.9V14.15M12 3v11.25m0 0l3-3m-3 3l-3-3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Rapports PDF</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Générez des rapports instantanés et des PV de notes automatisés.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-gray-50 dark:bg-white/[0.01]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-display font-bold mb-4">Ils nous font confiance</h2>
                <p class="text-gray-500 dark:text-gray-400">Voyez ce que disent les chefs d'établissement.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        ['name' => 'Jean Dupont', 'role' => 'Directeur, Lycée Excellence', 'text' => "Enote a radicalement simplifié notre gestion des notes. Le gain de temps est immense."],
                        ['name' => 'Marie Curie', 'role' => 'Secretariat, Collège Horizon', 'text' => "L'interface est d'une fluidité exemplaire. Même nos enseignants les moins technophiles l'adorent."],
                        ['name' => 'Luc Martin', 'role' => 'Fondateur, Académie Tech', 'text' => "Le suivi d'avancement des programmes est le meilleur outil que j'ai pu utiliser en 20 ans."],
                    ];
                @endphp

                @foreach($testimonials as $t)
                    <div class="p-8 rounded-3xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm relative">
                        <div class="flex items-center gap-1 text-orange-400 mb-4">
                            @for($i=0; $i<5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" /></svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic mb-6">"{{ $t['text'] }}"</p>
                        <div>
                            <div class="font-bold text-gray-900 dark:text-white">{{ $t['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $t['role'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="pt-24 pb-12 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('enote-logo.png') }}" alt="Enote" class="h-8 w-auto">
                        <span class="text-xl font-display font-bold">Enote</span>
                    </a>
                    <p class="text-gray-500 dark:text-gray-400 max-w-sm">
                        La solution tout-en-un pour la gestion moderne des établissements scolaires en Afrique et ailleurs.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Plateforme</h4>
                    <ul class="space-y-4 text-gray-500 dark:text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Fonctionnalités</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Tarification</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Guide d'utilisation</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Légal</h4>
                    <ul class="space-y-4 text-gray-500 dark:text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Confidentialité</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 pt-8 border-t border-gray-100 dark:border-gray-800">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Enote. Tous droits réservés.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { 
            background: #e2e8f0; 
            border-radius: 5px;
            border: 3px solid transparent;
            background-clip: padding-box;
        }
        .dark ::-webkit-scrollbar-thumb { background: #1e293b; border: 3px solid transparent; background-clip: padding-box; }
    </style>
</body>

</html>