<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                        {{ __('Enseignants') }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Gestion du corps enseignant.
                    </p>
                </div>

                @php
                    $canManage = Auth::user()->role === 'admin';
                @endphp

                @if ($canManage)
                    <a href="{{ route('enseignants.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5 hover:shadow-primary-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Nouvel enseignant') }}
                    </a>
                @endif
            </div>

            <!-- Content Card -->
            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 overflow-hidden">
                <div class="p-6">
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-100 dark:border-green-800 flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-100 dark:border-red-800">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Code</th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nom Complet
                                    </th>
                                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300 text-right">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($enseignants as $enseignant)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                        <td class="py-4 px-4 font-medium text-gray-900 dark:text-white">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 font-mono">
                                                {{ $enseignant->CodeE }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                                                    {{ substr($enseignant->Libelle, 0, 1) }}
                                                </div>
                                                <span
                                                    class="text-gray-900 dark:text-gray-100 font-medium">{{ $enseignant->Libelle }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('enseignants.show', $enseignant) }}"
                                                    class="p-2 rounded-lg text-gray-500 hover:text-primary-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                                    title="Voir">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                @if ($canManage)
                                                    <a href="{{ route('enseignants.edit', $enseignant) }}"
                                                        class="p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                                        title="Modifier">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form method="POST" action="{{ route('enseignants.destroy', $enseignant) }}"
                                                        onsubmit="return confirm('Supprimer cet enseignant ?');"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 rounded-lg text-gray-500 hover:text-red-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                                            title="Supprimer">
                                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-8 text-center text-gray-500 dark:text-gray-400" colspan="3">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <p>Aucun enseignant trouvé.</p>
                                                @if ($canManage)
                                                    <a href="{{ route('enseignants.create') }}"
                                                        class="mt-2 text-primary-600 hover:text-primary-500 font-medium">Ajouter
                                                        le premier enseignant</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>