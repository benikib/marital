<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Province - {{ $province->nom }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Vue d'ensemble des activités dans votre province
                </p>
            </div>
            
            <div class="flex gap-2">
                <button onclick="window.location.href='{{ route('province.export') }}'"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700">
                    📊 Exporter les stats
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Global Loader -->
   
    
    <div class="py-6">
        <!-- Loader de chargement -->
        <div id="loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg p-6 flex items-center space-x-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                <span class="text-gray-700">Chargement des statistiques...</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartes statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">Population enregistrée</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_personnes']) }}</p>
                                <p class="text-xs text-gray-500 mt-2">
                                    👥 {{ number_format($stats['total_agents']) }} agents actifs
                                </p>
                            </div>
                            <div class="text-indigo-500 text-4xl">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">Mariages</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_mariages']) }}</p>
                                <p class="text-xs text-green-600 mt-2">
                                    ↑ 12% vs mois dernier
                                </p>
                            </div>
                            <div class="text-pink-500 text-4xl">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">Naissances</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_naissances']) }}</p>
                                <p class="text-xs text-blue-600 mt-2">
                                    👶 Nouveaux-nés enregistrés
                                </p>
                            </div>
                            <div class="text-blue-500 text-4xl">
                                <i class="fas fa-baby"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">Actes totaux</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">
                                    {{ number_format($stats['total_mariages'] + $stats['total_naissances'] + $stats['total_deces']) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-2">
                                    Tous types d'actes confondus
                                </p>
                            </div>
                            <div class="text-purple-500 text-4xl">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Évolution des actes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Évolution des actes (12 mois)</h3>
                        <canvas id="evolutionChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Répartition par type d'acte -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Répartition par type d'acte</h3>
                        <canvas id="actesPieChart" class="w-full h-64"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top villes et statistiques par ville -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Top 5 villes les plus actives -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">🏆 Top 5 des villes les plus actives</h3>
                        <div class="space-y-4">
                            @foreach($topVilles as $index => $ville)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $ville['ville'] }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $ville['mariages'] }} mariages | {{ $ville['naissances'] }} naissances
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-indigo-600">{{ number_format($ville['total']) }}</p>
                                        <p class="text-xs text-gray-500">total actes</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Statistiques par type d'acte détaillées -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">📊 Détail par type d'acte</h3>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>💍 Mariages</span>
                                    <span class="font-semibold">{{ number_format($statsParActe['mariages']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-pink-500 rounded-full h-2" 
                                       style="width: {{ max($statsParActe) > 0 ? ($statsParActe['mariages'] / max($statsParActe)) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>👶 Naissances</span>
                                    <span class="font-semibold">{{ number_format($statsParActe['naissances']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 rounded-full h-2" 
                                     style="width: {{ max($statsParActe) > 0 ? ($statsParActe['naissances'] / max($statsParActe)) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>⚰️ Décès</span>
                                    <span class="font-semibold">{{ number_format($statsParActe['deces']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gray-500 rounded-full h-2" 
                                         style="width: {{ max($statsParActe) > 0 ? ($statsParActe['deces'] / max($statsParActe)) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>💑 Célibats</span>
                                    <span class="font-semibold">{{ number_format($statsParActe['celibats']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 rounded-full h-2" 
                                         style="width: {{ max($statsParActe) > 0 ? ($statsParActe['celibats'] / max($statsParActe)) * 100 : 0   }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>🏠 Résidences</span>
                                    <span class="font-semibold">{{ number_format($statsParActe['residences']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 rounded-full h-2" 
                                         style="width: {{ max($statsParActe) > 0 ? ($statsParActe['residences'] / max($statsParActe)) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau détaillé par ville -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">📍 Détail par ville</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ville</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Mariages</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Naissances</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Décès</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Célibats</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Résidences</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Veuvages</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nationalités</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Bonne Vie et Moeurs</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Agents</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($statsParVille as $ville)
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $ville['ville'] }}
                                        </td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['mariages']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['naissances']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['deces']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['celibats']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['residences']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['veuvages']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['nationalites']) }}</td>
                                        <td class="px-6 py-4 text-center">{{ number_format($ville['Bonneviemoeurs']) }}</td>    
                                        
                                        <td class="px-6 py-4 text-center font-bold text-indigo-600">
                                            {{ number_format($ville['total']) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $villeAgents = $agentsStats->where('ville', $ville['ville'])->first();
                                            @endphp
                                            {{ $villeAgents['total_agents'] ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <button onclick="showVilleDetails({{ $ville['ville_id'] }})"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                Détails
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails Ville -->
    <div id="villeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Détails de la ville</h3>
                <button onclick="closeVilleModal()" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <div id="modalContent">
                <!-- Contenu chargé dynamiquement -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique d'évolution
        const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
        const evolutionData = @json($evolution);
        
        new Chart(evolutionCtx, {
            type: 'line',
            data: {
                labels: Object.keys(evolutionData.mariages),
                datasets: [
                    {
                        label: 'Mariages',
                        data: Object.values(evolutionData.mariages),
                        borderColor: 'rgb(236, 72, 153)',
                        backgroundColor: 'rgba(236, 72, 153, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Naissances',
                        data: Object.values(evolutionData.naissances),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Décès',
                        data: Object.values(evolutionData.deces),
                        borderColor: 'rgb(107, 114, 128)',
                        backgroundColor: 'rgba(107, 114, 128, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Célibats',
                        data: Object.values(evolutionData.celibats),
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Résidences',
                        data: Object.values(evolutionData.residences),
                        borderColor: 'rgb(245, 158, 11)',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Veuvages',
                        data: Object.values(evolutionData.veuvages),
                        borderColor: 'rgb(139, 92, 246)',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Nationalités',
                        data: Object.values(evolutionData.nationalites),
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                        {
                            label: 'Bonne Vie et Moeurs',
                            data: Object.values(evolutionData.Bonneviemoeurs),
                            borderColor: 'rgb(79, 70, 229)',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                   
                        
                        
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        
        // Graphique circulaire
        const pieCtx = document.getElementById('actesPieChart').getContext('2d');
        const actesData = @json($statsParActe);
        
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Mariages', 'Naissances', 'Décès', 'Célibats', 'Résidences', 'Veuvages', 'Nationalités'],
                datasets: [{
                    data: [
                        actesData.mariages,
                        actesData.naissances,
                        actesData.deces,
                        actesData.celibats,
                        actesData.residences,
                        actesData.veuvages,
                        actesData.nationalites
                    ],
                    backgroundColor: [
                        '#ec4899',
                        '#3b82f6',
                        '#6b7280',
                        '#10b981',
                        '#f59e0b',
                        '#8b5cf6',
                        '#ef4444'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
        
        // Modal functions
        function showVilleDetails(villeId) {
            fetch(`/province/ville/${villeId}/details`)
                .then(response => response.json())
                .then(data => {
                    const content = `
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-lg mb-2">${data.ville.nom}</h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Mariages</p>
                                        <p class="text-2xl font-bold text-pink-600">${data.stats.mariages}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Naissances</p>
                                        <p class="text-2xl font-bold text-blue-600">${data.stats.naissances}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Décès</p>
                                        <p class="text-2xl font-bold text-gray-600">${data.stats.deces}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Célibats</p>
                                        <p class="text-2xl font-bold text-green-600">${data.stats.celibats}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold mb-2">Communes (${data.communes.length})</h4>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                    ${data.communes.map(commune => `<div class="bg-gray-100 p-2 rounded">${commune}</div>`).join('')}
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold mb-2">Agents (${data.agents.length})</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Nom</th>
                                                <th class="text-left">Email</th>
                                                <th class="text-left">Téléphone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${data.agents.map(agent => `
                                                <tr>
                                                    <td>${agent.name}</td>
                                                    <td>${agent.email}</td>
                                                    <td>${agent.telephone || '-'}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    document.getElementById('modalContent').innerHTML = content;
                    document.getElementById('villeModal').classList.remove('hidden');
                });
        }
        
        function closeVilleModal() {
            document.getElementById('villeModal').classList.add('hidden');
        }
        
        // Fermer en cliquant à l'extérieur
        window.onclick = function(event) {
            const modal = document.getElementById('villeModal');
            if (event.target === modal) {
                closeVilleModal();
            }
        }

        // Gestion du loader
        window.addEventListener('load', function() {
            document.getElementById('loading-overlay').classList.add('hidden');
            
            // Masquer les skeletons et afficher le contenu réel
            document.querySelectorAll('[data-skeleton="true"]').forEach(el => {
                el.style.display = 'none';
            });
            document.querySelectorAll('[data-content="true"]').forEach(el => {
                el.style.display = 'block';
            });
        });

        // Afficher le loader lors des changements de page ou actualisation
        window.addEventListener('beforeunload', function() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        });

        // S'assurer que le loader global disparaît
        window.addEventListener('load', function() {
            const globalLoader = document.getElementById('global-loader');
            if (globalLoader) {
                globalLoader.style.display = 'none';
            }
            document.getElementById('loading-overlay').classList.add('hidden');
        });
    </script>
</x-app-layout>