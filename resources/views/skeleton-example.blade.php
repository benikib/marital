{{-- Exemple d'utilisation du Skeleton Loader --}}
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- EXEMPLE 1: Statistiques avec Skeleton -->
        <div id="stats-skeleton-placeholder" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            @for($i = 0; $i < 4; $i++)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="skeleton skeleton-text lg mb-4"></div>
                    <div class="skeleton skeleton-heading mb-4" style="width: 70%;"></div>
                    <div class="skeleton skeleton-text sm"></div>
                </div>
            @endfor
        </div>

        <!-- Contenu réel (caché initialement) -->
        <div id="stats-real-content" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Vos vraies cartes de statistiques -->
        </div>

        <!-- EXEMPLE 2: Tableau avec Skeleton -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Exemple Table</h3>
                
                <!-- Skeleton table -->
                <div id="table-skeleton-placeholder">
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

                <!-- Contenu réel -->
                <div id="table-real-content" style="display: none;">
                    <!-- Votre table ici -->
                </div>
            </div>
        </div>

        <!-- EXEMPLE 3: Liste avec Skeleton -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Exemple Liste</h3>
                
                <!-- Skeleton list -->
                <div id="list-skeleton-placeholder" class="space-y-4">
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

                <!-- Contenu réel -->
                <div id="list-real-content" style="display: none;">
                    <!-- Votre liste ici -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Attendre que la page soit complètement chargée
    window.addEventListener('load', function() {
        // EXEMPLE 1: Masquer statistiques skeleton et afficher contenu réel
        document.getElementById('stats-skeleton-placeholder').style.display = 'none';
        document.getElementById('stats-real-content').style.display = 'grid';

        // EXEMPLE 2: Masquer table skeleton et afficher contenu réel
        document.getElementById('table-skeleton-placeholder').style.display = 'none';
        document.getElementById('table-real-content').style.display = 'block';

        // EXEMPLE 3: Masquer list skeleton et afficher contenu réel
        document.getElementById('list-skeleton-placeholder').style.display = 'none';
        document.getElementById('list-real-content').style.display = 'block';

        // Optionnel: Utiliser SkeletonLoader pour un contrôle plus fin
        // SkeletonLoader.hide('stats-skeleton-placeholder');
        // SkeletonLoader.show('stats-skeleton-placeholder', 'stats');
        // setTimeout(() => SkeletonLoader.hide('stats-skeleton-placeholder'), 2000);
    });
});
</script>
@endsection