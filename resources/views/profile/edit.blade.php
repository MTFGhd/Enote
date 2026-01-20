<x-app-layout>
    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mb-4">
                <h2 class="text-3xl font-display font-bold text-gray-900 dark:text-white">
                    {{ __('Mon Profil') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Gérez vos informations personnelles et sécurisez votre compte.
                </p>
            </div>

            <div class="p-4 sm:p-8 glass rounded-2xl border border-gray-200 dark:border-gray-700/50 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 glass rounded-2xl border border-gray-200 dark:border-gray-700/50 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 glass rounded-2xl border border-gray-200 dark:border-gray-700/50 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>