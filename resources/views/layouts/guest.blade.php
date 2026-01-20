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
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('enote-logo.png') }}" alt="{{ config('app.name', 'Enote') }}" class="h-16 w-auto">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-8 glass border border-white/20 dark:border-gray-700/50 shadow-2xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>