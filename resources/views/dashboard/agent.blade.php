<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tableau de bord  
            </h2>
            
            <!-- Boutons d'impression -->
            <div class="flex gap-2">
                <button onclick="openPrintModal('journalier')" 
                        class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition">
                    <i class="fas fa-print"></i> Rapport Journalier
                </button>
                <button onclick="openPrintModal('mensuel')" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                    <i class="fas fa-print"></i> Rapport Mensuel
                </button>
                <button onclick="openPrintModal('annuel')" 
                        class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-700 transition">
                    <i class="fas fa-print"></i> Rapport Annuel
                </button>
                <button onclick="openPrintModal('personnalise')" 
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                    <i class="fas fa-calendar-alt"></i> Rapport Personnalisé
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Mariages -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-wide">Mariages</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $todayStats['mariages'] }}</p>
                                @if(isset($evolution['mariages']))
                                    <p class="text-xs mt-2 {{ $evolution['mariages'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        <i class="fas fa-arrow-{{ $evolution['mariages'] >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($evolution['mariages']) }}% vs hier
                                    </p>
                                @endif
                            </div>
                            <div class="text-indigo-500 text-4xl">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Naissances -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-wide">Naissances</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $todayStats['naissances'] }}</p>
                                @if(isset($evolution['naissances']))
                                    <p class="text-xs mt-2 {{ $evolution['naissances'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        <i class="fas fa-arrow-{{ $evolution['naissances'] >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($evolution['naissances']) }}% vs hier
                                    </p>
                                @endif
                            </div>
                            <div class="text-blue-500 text-4xl">
                                <i class="fas fa-baby"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Décès -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-wide">Décès</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $todayStats['deces'] }}</p>
                                @if(isset($evolution['deces']))
                                    <p class="text-xs mt-2 {{ $evolution['deces'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        <i class="fas fa-arrow-{{ $evolution['deces'] >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($evolution['deces']) }}% vs hier
                                    </p>
                                @endif
                            </div>
                            <div class="text-gray-500 text-4xl">
                                <i class="fas fa-skull"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personnes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-wide">Personnes</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $personnesStats['total'] }}</p>
                                <p class="text-xs mt-2 text-gray-500">
                                    <i class="fas fa-mars text-blue-500"></i> {{ $personnesStats['hommes'] }} 
                                    <i class="fas fa-venus text-pink-500 ml-2"></i> {{ $personnesStats['femmes'] }}
                                </p>
                            </div>
                            <div class="text-green-500 text-4xl">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique et Top Activités -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Graphique -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Évolution des mariages (12 mois)</h3>
                        <canvas id="mariagesChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Top Activités -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Top 5 des actes</h3>
                        <div class="space-y-4">
                            @foreach($topActivites as $nom => $total)
                                @php
                                    $maxValue = max($topActivites);
                                    $percentage = $maxValue > 0 ? ($total / $maxValue) * 100 : 0;   
                                    $icons = [
                                        'mariages' => '💍',
                                        'naissances' => '👶',
                                        'deces' => '⚰️',
                                        'celibats' => '💑',
                                        'inhumations' => '🪦',
                                        'residences' => '🏠',
                                        'veuvages' => '💔',
                                        'nationalites' => '🌍',
                                    ];
                                    $icon = $icons[$nom] ?? '📄';
                                @endphp
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>{{ $icon }} {{ ucfirst($nom) }}</span>
                                        <span class="font-semibold">{{ $total }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full h-2 transition-all duration-500" 
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau récapitulatif -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Récapitulatif détaillé</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type d'acte</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aujourd'hui</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ce mois</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Cette année</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr><td class="px-6 py-4">💍 Mariages</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['mariages'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['mariages'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['mariages'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['mariages'] }}</td>
                                </tr>
                                <tr><td class="px-6 py-4">👶 Naissances</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['naissances'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['naissances'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['naissances'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['naissances'] }}</td>
                                </tr>
                                <tr><td class="px-6 py-4">⚰️ Décès</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['deces'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['deces'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['deces'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['deces'] }}</td>
                                </tr>
                                <tr><td class="px-6 py-4">💑 Célibats</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['celibats'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['celibats'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['celibats'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['celibats'] }}</td>
                                </tr>
                                <tr><td class="px-6 py-4">🏠 Résidences</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['residences'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['residences'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['residences'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['residences'] }}</td>
                                </tr>
                                <tr><td class="px-6 py-4">💔 Veuvages</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['veuvages'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['veuvages'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['veuvages'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['veuvages'] }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4">🪦 Inhumations</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['inhumations'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['inhumations'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['inhumations'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['inhumations'] }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4">🌍 Nationalités</td>
                                    <td class="px-6 py-4 text-center">{{ $todayStats['nationalites'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $monthlyStats['nationalites'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $yearlyStats['nationalites'] }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-indigo-600">{{ $globalStats['nationalites'] }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Impression Rapport -->
    <div id="printModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Rapport</h3>
                <button onclick="closePrintModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="printForm" action="{{ route('rapport.imprimer') }}" method="GET" target="_blank">
                <input type="hidden" name="type" id="rapportType">
                
                <div id="customDateRange" class="hidden mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="date" name="start_date" id="startDate" 
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <input type="date" name="end_date" id="endDate" 
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="include_details" value="1" class="rounded border-gray-300">
                        <span class="ml-2 text-sm text-gray-600">Inclure les détails des actes</span>
                    </label>
                </div>
                
                <div class="flex gap-2">
                    <button type="button" onclick="submitPrint('pdf')" 
                            class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                    <button type="button" onclick="submitPrint('excel')" 
                            class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                </div>
            </form>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique
        const ctx = document.getElementById('mariagesChart').getContext('2d');
        const mariagesData = @json(array_values($mariagesParMois));
        const moisLabels = @json(array_keys($mariagesParMois));
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: moisLabels,
                datasets: [{
                    label: 'Mariages',
                    data: mariagesData,
                    borderColor: 'rgb(79, 70, 229)',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(79, 70, 229)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
        
        // Modal functions
        let currentType = '';
        
        function openPrintModal(type) {
            currentType = type;
            document.getElementById('rapportType').value = type;
            document.getElementById('modalTitle').innerHTML = 
                type === 'journalier' ? 'Rapport Journalier' :
                type === 'mensuel' ? 'Rapport Mensuel' :
                type === 'annuel' ? 'Rapport Annuel' : 'Rapport Personnalisé';
            
            const customDateRange = document.getElementById('customDateRange');
            if (type === 'personnalise') {
                customDateRange.classList.remove('hidden');
                // Pré-remplir avec les dates du mois courant
                const today = new Date();
                const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
                document.getElementById('startDate').value = firstDay.toISOString().split('T')[0];
                document.getElementById('endDate').value = today.toISOString().split('T')[0];
            } else {
                customDateRange.classList.add('hidden');
            }
            
            document.getElementById('printModal').classList.remove('hidden');
        }
        
        function closePrintModal() {
            document.getElementById('printModal').classList.add('hidden');
        }
        
        function submitPrint(format) {
            const form = document.getElementById('printForm');
            const type = document.getElementById('rapportType').value;
            
            if (type === 'personnalise') {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                
                if (!startDate || !endDate) {
                    alert('Veuillez sélectionner une période');
                    return;
                }
                
                if (new Date(startDate) > new Date(endDate)) {
                    alert('La date de début doit être antérieure à la date de fin');
                    return;
                }
            }
            
            if (format === 'pdf') {
                form.action = "{{ route('rapport.imprimer') }}";
            } else {
                form.action = "{{ route('rapport.exporter') }}";
            }
            
            form.submit();
            closePrintModal();
        }
        
        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function(event) {
            const modal = document.getElementById('printModal');
            if (event.target === modal) {
                closePrintModal();
            }
        }
    </script>
   
</x-app-layout>