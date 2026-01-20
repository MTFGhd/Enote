<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à la liste
                </a>
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Détails de l\'utilisateur') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Informations complètes et rôle assigné.
                </p>
            </div>

            <div class="glass rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6 sm:p-8">
                <div class="flex flex-col md:flex-row md:items-start gap-8">
                    <div class="flex-shrink-0">
                        <div
                            class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg shadow-primary-500/30">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom complet</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->email }}</div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Rôle</div>
                            @php
                                $role = $user->role;
                                $roleLabels = [
                                    'admin' => ['label' => 'Administrateur', 'bg' => 'bg-primary-50 dark:bg-primary-900/30', 'text' => 'text-primary-700 dark:text-primary-300', 'dot' => 'bg-primary-500'],
                                    'E' => ['label' => 'Enseignant', 'bg' => 'bg-blue-50 dark:bg-blue-900/30', 'text' => 'text-blue-700 dark:text-blue-300', 'dot' => 'bg-blue-500'],
                                    'D' => ['label' => 'Direction', 'bg' => 'bg-emerald-50 dark:bg-emerald-900/30', 'text' => 'text-emerald-700 dark:text-emerald-300', 'dot' => 'bg-emerald-500'],
                                ];
                                $style = $roleLabels[$role] ?? $roleLabels['D'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $style['bg'] }} {{ $style['text'] }}">
                                <span class="w-2 h-2 rounded-full mr-2 {{ $style['dot'] }}"></span>
                                {{ $style['label'] }}
                            </span>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Code Enseignant</div>
                            @if($user->role === 'E')
                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-mono">
                                    {{ $user->CodeE ?? '—' }}
                                </div>
                                @if($user->enseignant)
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $user->enseignant->Libelle }}
                                    </div>
                                @endif
                            @else
                                <span class="text-gray-400 dark:text-gray-500">N/A</span>
                            @endif
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Créé le</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $user->created_at?->format('d/m/Y H:i') ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Dernière mise à jour</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $user->updated_at?->format('d/m/Y H:i') ?? '—' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('users.edit', $user) }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-md shadow-indigo-500/20 transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
