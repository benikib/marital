<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('mariages.index') }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-indigo-500 hover:shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900">Mariages</h3>
                            <p class="mt-2 text-sm text-gray-600">Gérer les mariages enregistrés et leurs informations.</p>
                        </a>
                        <a href="{{ route('personnes.index') }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-indigo-500 hover:shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900">Personnes</h3>
                            <p class="mt-2 text-sm text-gray-600">Ajouter et modifier les personnes référencées.</p>
                        </a>
                        <a href="{{ route('entites.index') }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-indigo-500 hover:shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900">Entités</h3>
                            <p class="mt-2 text-sm text-gray-600">Gérer les entités administratives et leurs hiérarchies.</p>
                        </a>
                        <a href="{{ route('roles.index') }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-indigo-500 hover:shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900">Rôles</h3>
                            <p class="mt-2 text-sm text-gray-600">Configurer les rôles d'utilisateur du système.</p>
                        </a>
                        <a href="{{ route('contrats.index') }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-indigo-500 hover:shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900">Contrats</h3>
                            <p class="mt-2 text-sm text-gray-600">Gérer les contrats liés aux régimes matrimoniaux.</p>
                        </a>
                        <a href="{{ route('regimes.index') }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-indigo-500 hover:shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900">Régimes matrimoniaux</h3>
                            <p class="mt-2 text-sm text-gray-600">Définir les régimes et les dotations coutumières.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
