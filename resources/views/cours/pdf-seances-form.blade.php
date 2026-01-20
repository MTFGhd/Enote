<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <a href="{{ route('cours.index') }}"
                    class="inline-flex items-center text-primary-600 hover:text-primary-500 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux séances
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    Générer PDF - Séances validées
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Sélectionnez une période pour générer le rapport PDF des séances validées.
                </p>
            </div>

            <!-- Form Card -->
            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 overflow-hidden">
                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-100 dark:border-red-800">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cours.pdf.seances') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date de début -->
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Date de début <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_debut" id="date_debut" required
                                    value="{{ old('date_debut') }}"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                            </div>

                            <!-- Date de fin -->
                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Date de fin <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_fin" id="date_fin" required
                                    value="{{ old('date_fin') }}"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-end gap-4 pt-6">
                            <a href="{{ route('cours.index') }}"
                                class="px-6 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium transition-colors">
                                Annuler
                            </a>
                            <button type="submit"
                                class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Générer le PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
