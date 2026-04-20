<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            🚀 Super Admin Dashboard
        </h2>
    </x-slot>

    <div class="p-6 space-y-6 bg-gray-100 min-h-screen">

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="card bg-gradient-to-r from-indigo-500 to-indigo-700 text-white">
                <p>Total mariages</p>
                <h2 class="text-3xl font-bold">{{ $totalMariages }}</h2>
            </div>

            <div class="card bg-gradient-to-r from-blue-500 to-blue-700 text-white">
                <p>Personnes</p>
                <h2 class="text-3xl font-bold">{{ $totalPersonnes }}</h2>
            </div>

            <div class="card bg-gradient-to-r from-green-500 to-green-700 text-white">
                <p>Utilisateurs</p>
                <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
            </div>

        </div>

        <!-- GRAPHIQUES -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Ligne -->
            <div class="card">
                <h3 class="mb-4 font-semibold">📈 Mariages par mois</h3>
                <canvas id="chartLine"></canvas>
            </div>

            <!-- Camembert -->
            <div class="card">
                <h3 class="mb-4 font-semibold">📊 Répartition par statut</h3>
                <canvas id="chartPie"></canvas>
            </div>

        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // LINE CHART
        new Chart(document.getElementById('chartLine'), {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Mariages',
                    data: @json($data),
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            }
        });

        // PIE CHART
        new Chart(document.getElementById('chartPie'), {
            type: 'doughnut',
            data: {
                labels: @json($mariagesParStatut->pluck('nom')),
                datasets: [{
                    data: @json($mariagesParStatut->pluck('total'))
                }]
            }
        });
    </script>
    <style>
        .card {
    @apply p-6 rounded-2xl shadow-lg bg-white hover:shadow-xl transition duration-300;
}
        </style>
</x-app-layout>