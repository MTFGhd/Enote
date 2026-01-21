<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Enote') }}</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                var useDark = stored ? stored === 'dark' : prefersDark;

                if (useDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-hidden selection:bg-primary selection:text-white">
    <script>
        try {
            if (localStorage.getItem('sidebar-expanded') === 'true') {
                document.body.classList.add('sb-expanded');
            }
        } catch (e) {}
    </script>
    <div class="flex h-screen w-full overflow-hidden">
        @include('layouts.sidebar')
        
        <main class="flex-1 flex flex-col h-full min-w-0 overflow-hidden relative transition-all duration-300">
            <!-- Header -->
            <header class="flex items-center justify-between px-8 py-4 border-b border-slate-200 dark:border-[#292938] bg-white/80 dark:bg-[#111121]/90 backdrop-blur-md z-10">
                <div class="flex items-center gap-4">
                    <h2 class="text-slate-900 dark:text-white text-lg font-bold tracking-tight">{{ $header ?? 'Tableau de bord' }}</h2>
                </div>
                
                <div class="flex items-center gap-4">
                     <!-- Minimal Search -->
                    <div class="hidden lg:flex items-center bg-slate-100 dark:bg-[#1e1e2d] rounded-full h-10 px-4 w-64 focus-within:ring-2 focus-within:ring-primary/50 transition-all border border-transparent">
                        <i class="bx bx-search text-slate-400 text-lg"></i>
                        <input class="bg-transparent border-none text-slate-900 dark:text-white placeholder-slate-400 text-sm w-full focus:ring-0 ml-2" placeholder="Rechercher..." type="text"/>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light')" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-[#1e1e2d] transition-colors">
                            <i class="bx bx-moon dark:hidden text-xl"></i>
                            <i class="bx bx-sun hidden dark:block text-xl text-yellow-400"></i>
                        </button>

                        <button class="relative p-2 rounded-lg text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e1e2d] transition-colors">
                            <i class="bx bx-bell text-xl"></i>
                            <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-[#111121]"></span>
                        </button>
                        
                        <div class="flex items-center gap-3 ml-2 pl-4 border-l border-slate-200 dark:border-slate-800">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</p>
                                <span class="text-[10px] uppercase tracking-wider font-bold text-primary-500">
                                    {{ Auth::user()->role === 'admin' ? 'Administrateur' : (Auth::user()->role === 'E' ? 'Enseignant' : 'Direction') }}
                                </span>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2e31ea&color=fff" class="h-9 w-9 rounded-full object-cover ring-2 ring-slate-100 dark:ring-slate-800" alt="Avatar">
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="flex-1 overflow-y-auto p-8">
                 {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const resizeBtn = document.querySelector("[data-resize-btn]");
            if(resizeBtn) {
                resizeBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    document.body.classList.toggle("sb-expanded");
                    localStorage.setItem('sidebar-expanded', document.body.classList.contains("sb-expanded"));
                });
            }
        });
    </script>
</body>
</html>
