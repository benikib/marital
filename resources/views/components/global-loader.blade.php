{{-- Composant Loader Global --}}
@php
    $context = $context ?? 'general';
    $messages = [
        'general' => [
            ['Chargement en cours...', 'Préparation de votre espace de travail'],
            ['Connexion aux services...', 'Vérification de vos autorisations'],
            ['Chargement des données...', 'Récupération de vos informations'],
            ['Finalisation...', 'Presque terminé']
        ],
        'dashboard' => [
            ['Chargement du dashboard...', 'Analyse des statistiques'],
            ['Connexion aux bases de données...', 'Récupération des données'],
            ['Traitement en cours...', 'Préparation des graphiques'],
            ['Finalisation...', 'Chargement terminé']
        ],
        'reports' => [
            ['Génération du rapport...', 'Collecte des données'],
            ['Traitement en cours...', 'Analyse des informations'],
            ['Formatage...', 'Préparation de l\'affichage'],
            ['Finalisation...', 'Rapport prêt']
        ]
    ];
    $currentMessages = $messages[$context] ?? $messages['general'];
@endphp

<div id="global-loader" class="fixed inset-0 bg-gradient-to-br from-blue-600 to-indigo-800 flex items-center justify-center z-50 transition-opacity duration-500">
    <div class="text-center">
        <!-- Logo/Brand -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-4">
                <span class="text-3xl text-white font-bold">M</span>
            </div>
            <h1 class="text-2xl font-bold text-white mb-2">Marital Bank</h1>
            <p class="text-blue-100">Système de Gestion État Civil</p>
        </div>

        <!-- Loader Animation -->
        <div class="relative mb-8">
            <div class="w-16 h-16 border-4 border-white border-opacity-30 border-t-white rounded-full animate-spin mx-auto"></div>
            <div class="absolute inset-0 w-16 h-16 border-4 border-transparent border-t-blue-300 rounded-full animate-spin mx-auto" style="animation-duration: 0.8s;"></div>
        </div>

        <!-- Loading Text -->
        <div class="text-white">
            <p class="text-lg font-medium mb-2" id="loader-text">{{ $currentMessages[0][0] }}</p>
            <p class="text-sm text-blue-100" id="loader-subtitle">{{ $currentMessages[0][1] }}</p>
        </div>

        <!-- Progress Bar -->
        <div class="mt-6 w-64 mx-auto">
            <div class="bg-white bg-opacity-20 rounded-full h-2">
                <div id="progress-bar" class="bg-white h-2 rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

@keyframes slideUp {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}

.global-loader-hide {
    animation: fadeOut 0.5s ease-out forwards;
}

@media (max-width: 640px) {
    #global-loader {
        padding: 1rem;
    }

    #global-loader .text-2xl {
        font-size: 1.5rem;
    }

    #global-loader .w-64 {
        width: 12rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('global-loader');
    if (!loader) return;

    const progressBar = document.getElementById('progress-bar');
    const loaderText = document.getElementById('loader-text');
    const loaderSubtitle = document.getElementById('loader-subtitle');
    const messages = @json($currentMessages);

    let currentMessage = 0;
    let progress = 0;
    let hideTimeout = null;
    let progressInterval = null;

    function updateMessage() {
        if (messages[currentMessage]) {
            loaderText.textContent = messages[currentMessage][0];
            loaderSubtitle.textContent = messages[currentMessage][1];
        }
    }

    function hideLoader() {
        if (hideTimeout) clearTimeout(hideTimeout);
        if (progressInterval) clearInterval(progressInterval);
        
        hideTimeout = setTimeout(() => {
            if (loader) {
                loader.classList.add('global-loader-hide');
                setTimeout(() => {
                    if (loader) loader.style.display = 'none';
                }, 500);
            }
        }, 300);
    }

    // Animation de progression
    progressInterval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress > 100) progress = 100;

        if (progressBar) {
            progressBar.style.width = progress + '%';
        }

        // Changement de message basé sur la progression
        if (progress > 25 && currentMessage === 0) {
            currentMessage = 1;
            updateMessage();
        } else if (progress > 50 && currentMessage === 1) {
            currentMessage = 2;
            updateMessage();
        } else if (progress > 75 && currentMessage === 2) {
            currentMessage = 3;
            updateMessage();
        }

        // Masquer le loader à 100%
        if (progress >= 100) {
            clearInterval(progressInterval);
            hideLoader();
        }
    }, 200);

    // Fallback: masquer le loader après 3 secondes MAXIMUM
    setTimeout(() => {
        hideLoader();
    }, 3000);

    // Masquer également le loader quand la page est complètement chargée
    window.addEventListener('load', function() {
        hideLoader();
    });
});
</script>