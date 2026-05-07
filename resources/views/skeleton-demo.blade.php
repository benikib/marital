{{-- 
  Démo Skeleton Loader - TEST PAGE
  Accédez via une route test pour voir l'effet en direct
--}}
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">🎨 Démo Skeleton Loader</h1>

        <!-- DÉMO 1: Cartes Statistiques -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Statistiques (Stats Skeleton)</h2>
            <p class="text-gray-600 mb-6 text-sm">Démonstration d'effet skeleton pour 4 cartes statistiques</p>

            <!-- Skeleton Loading State -->
            <div id="demo-stats-skeleton" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="skeleton skeleton-text lg mb-4"></div>
                        <div class="skeleton skeleton-heading mb-4" style="width: 70%;"></div>
                        <div class="skeleton skeleton-text sm"></div>
                    </div>
                @endfor
            </div>

            <!-- Real Content (hidden initially) -->
            <div id="demo-stats-content" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 uppercase">Total Mariages</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">1,245</p>
                        <p class="text-xs text-green-600 mt-2">↑ 12% vs mois dernier</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 uppercase">Naissances</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">892</p>
                        <p class="text-xs text-blue-600 mt-2">👶 Nouveaux enregistrés</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 uppercase">Décès</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">156</p>
                        <p class="text-xs text-gray-600 mt-2">Enregistrés ce mois</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 uppercase">Nationalités</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">534</p>
                        <p class="text-xs text-purple-600 mt-2">Enregistrements</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- DÉMO 2: Tableau -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tableau (Table Skeleton)</h2>
            <p class="text-gray-600 mb-6 text-sm">Démonstration d'effet skeleton pour un tableau</p>

            <!-- Skeleton Loading State -->
            <div id="demo-table-skeleton" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="skeleton skeleton-heading mb-6"></div>
                    <div class="space-y-2">
                        @for($i = 0; $i < 4; $i++)
                            <div class="flex gap-4">
                                <div class="skeleton-table-cell" style="flex: 2;"></div>
                                <div class="skeleton-table-cell"></div>
                                <div class="skeleton-table-cell"></div>
                                <div class="skeleton-table-cell"></div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Real Content (hidden initially) -->
            <div id="demo-table-content" style="display: none;" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Derniers Mariages</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Époux</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jean & Marie</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/04/2026</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Validé</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 hover:text-indigo-900 cursor-pointer">Voir</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Paul & Anne</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/04/2026</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Validé</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 hover:text-indigo-900 cursor-pointer">Voir</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Luc & Sophie</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05/04/2026</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">En attente</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 hover:text-indigo-900 cursor-pointer">Voir</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DÉMO 3: Liste -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste (List Skeleton)</h2>
            <p class="text-gray-600 mb-6 text-sm">Démonstration d'effet skeleton pour une liste d'éléments</p>

            <!-- Skeleton Loading State -->
            <div id="demo-list-skeleton" class="space-y-4">
                @for($i = 0; $i < 3; $i++)
                    <div class="skeleton-card">
                        <div class="flex items-center gap-4">
                            <div class="skeleton-avatar" style="width: 3rem; height: 3rem;"></div>
                            <div class="flex-1">
                                <div class="skeleton-card-title" style="width: 70%;"></div>
                                <div class="skeleton skeleton-text sm" style="width: 50%; margin-top: 0.5rem;"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Real Content (hidden initially) -->
            <div id="demo-list-content" style="display: none;" class="space-y-4">
                <div class="bg-white border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">👨</div>
                        <div>
                            <p class="font-semibold text-gray-900">Jean Dupont</p>
                            <p class="text-sm text-gray-500">Marié le 15/04/2026</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center text-pink-600 font-semibold">👩</div>
                        <div>
                            <p class="font-semibold text-gray-900">Marie Durand</p>
                            <p class="text-sm text-gray-500">Née le 28/02/1995</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold">👶</div>
                        <div>
                            <p class="font-semibold text-gray-900">Thomas Martin</p>
                            <p class="text-sm text-gray-500">Né le 12/03/2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Boutons de contrôle -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-12">
            <h3 class="font-semibold text-blue-900 mb-4">🎮 Contrôles (pour tester)</h3>
            <div class="flex gap-2 flex-wrap">
                <button onclick="resetDemo()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Réinitialiser (voir skeletons)</button>
                <button onclick="completeDemo()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Charger contenu (voir données)</button>
                <button onclick="slowNetworkDemo()" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700">Démo 3G lent (2s)</button>
            </div>
            <p class="text-sm text-gray-600 mt-4">
                💡 <strong>Astuce:</strong> Utilisez DevTools (F12) → Network → "Slow 3G" pour voir l'effet pendant le chargement réel.
            </p>
        </div>
    </div>
</div>

<script>
function resetDemo() {
    document.getElementById('demo-stats-skeleton').style.display = 'grid';
    document.getElementById('demo-stats-content').style.display = 'none';
    document.getElementById('demo-table-skeleton').style.display = 'block';
    document.getElementById('demo-table-content').style.display = 'none';
    document.getElementById('demo-list-skeleton').style.display = 'block';
    document.getElementById('demo-list-content').style.display = 'none';
}

function completeDemo() {
    document.getElementById('demo-stats-skeleton').style.display = 'none';
    document.getElementById('demo-stats-content').style.display = 'grid';
    document.getElementById('demo-table-skeleton').style.display = 'none';
    document.getElementById('demo-table-content').style.display = 'block';
    document.getElementById('demo-list-skeleton').style.display = 'none';
    document.getElementById('demo-list-content').style.display = 'block';
}

function slowNetworkDemo() {
    resetDemo();
    setTimeout(completeDemo, 2000);
}

// Auto-show content on page load (simulating network delay)
window.addEventListener('load', function() {
    setTimeout(() => {
        completeDemo();
    }, 1500);
});
</script>
@endsection