<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            🏛 Dashboard Agent Communal
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Total mariages -->
            <div class="card">
                <h3 class="text-gray-500">Total mariages</h3>
                <p class="text-3xl font-bold text-indigo-600">
                    {{ $totalMariages }}
                </p>
            </div>

            <!-- Aujourd’hui -->
            <div class="card">
                <h3 class="text-gray-500">Aujourd’hui</h3>
                <p class="text-3xl font-bold text-green-600">
                    {{ $mariagesAujourdHui }}
                </p>
            </div>

            <!-- Personnes -->
            <div class="card">
                <h3 class="text-gray-500">Personnes</h3>
                <p class="text-3xl font-bold text-blue-600">
                    {{ $personnes }}
                </p>
            </div>

        </div>

        <!-- ACTIONS -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-lg font-semibold mb-4">⚡ Actions rapides</h3>

            <div class="grid md:grid-cols-3 gap-4">

                <a href="{{ route('mariages.create') }}" class="btn-action">
                    ➕ Nouveau mariage
                </a>

                <a href="{{ route('personnes.create') }}" class="btn-action">
                    👤 Nouvelle personne
                </a>

                <a href="{{ route('mariages.index') }}" class="btn-action">
                    📄 Voir les mariages
                </a>

            </div>
        </div>

    </div>
</x-app-layout>