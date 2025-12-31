<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('Bienvenue') }}, {{ Auth::user()->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="relative overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-amber-500/10 blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl"></div>
                </div>

                <div class="relative p-6 sm:p-10">
                    <div class="inline-flex items-center gap-2 rounded-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 px-3 py-1 text-xs text-gray-600 dark:text-gray-300">
                        <span class="font-semibold text-amber-600 dark:text-amber-500">{{ __('Nouveau') }}</span>
                        <span>{{ __('Gestion clients, commandes & factures') }}</span>
                    </div>

                    <div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        <div class="lg:col-span-7">
                            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                                {{ __('Pilotez votre activité') }}
                                <span class="text-amber-600 dark:text-amber-500">{{ __('en un seul endroit') }}</span>
                            </h1>
                            <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-2xl">
                                {{ __('Accédez rapidement à vos clients, saisissez des commandes et générez des factures en gardant une vue claire sur les données.') }}
                            </p>

                            <div class="mt-6 flex flex-wrap items-center gap-3">
                                <a href="{{ route('clients.index') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                                    {{ __('Voir les clients') }}
                                </a>
                                <a href="{{ route('commandes.create') }}" class="inline-flex items-center rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-semibold text-gray-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-900">
                                    {{ __('Créer une commande') }}
                                </a>
                                <a href="{{ route('factures.create') }}" class="inline-flex items-center rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-semibold text-gray-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-900">
                                    {{ __('Créer une facture') }}
                                </a>
                            </div>

                            <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Astuce : utilisez le bouton soleil/lune dans la navbar pour changer le thème.') }}
                            </div>
                        </div>

                        <div class="lg:col-span-5">
                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-5">
                                <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ __('Accès rapide') }}</div>
                                <div class="mt-4 grid grid-cols-1 gap-3">
                                    <a href="{{ route('clients.create') }}" class="group rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Nouveau client') }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Créer une fiche client') }}</div>
                                            </div>
                                            <div class="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200">→</div>
                                        </div>
                                    </a>
                                    <a href="{{ route('commandes.index') }}" class="group rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Commandes') }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Lister et modifier les commandes') }}</div>
                                            </div>
                                            <div class="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200">→</div>
                                        </div>
                                    </a>
                                    <a href="{{ route('factures.index') }}" class="group rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Factures') }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Consulter les factures') }}</div>
                                            </div>
                                            <div class="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200">→</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6">
                    <div class="text-xs font-semibold text-gray-500 dark:text-gray-400">{{ __('Espace') }}</div>
                    <div class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Clients') }}</div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ __('Gestion des fiches et contacts') }}</p>
                    <div class="mt-4">
                        <a href="{{ route('clients.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Ouvrir') }} →</a>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6">
                    <div class="text-xs font-semibold text-gray-500 dark:text-gray-400">{{ __('Espace') }}</div>
                    <div class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Commandes') }}</div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ __('Saisie et suivi des montants') }}</p>
                    <div class="mt-4">
                        <a href="{{ route('commandes.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Ouvrir') }} →</a>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6">
                    <div class="text-xs font-semibold text-gray-500 dark:text-gray-400">{{ __('Espace') }}</div>
                    <div class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Factures') }}</div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ __('Création et consultation') }}</p>
                    <div class="mt-4">
                        <a href="{{ route('factures.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Ouvrir') }} →</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
