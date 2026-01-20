<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

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
            } catch (e) { }
        })();
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased overflow-hidden">
    <div class="fixed inset-0 pointer-events-none z-0">
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

    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-gray-900 relative z-10">
        <div class="mb-6">
            <a href="/" class="flex items-center gap-2">
                <div class="bg-gradient-to-br from-primary-600 to-purple-600 text-white p-2 rounded-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>
                </div>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-8 glass border border-white/20 dark:border-gray-700/50 shadow-2xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>