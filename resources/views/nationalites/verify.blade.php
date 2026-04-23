<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification - Attestation de Nationalité RDC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        
        <!-- En-tête RDC -->
        <div class="text-center mb-6">
            <div class="flex w-full h-3 mb-3 rounded-full overflow-hidden">
                <div class="bg-blue-600 flex-1"></div>
                <div class="bg-yellow-400 flex-1"></div>
                <div class="bg-blue-600 flex-1"></div>
                <div class="bg-yellow-400 flex-1"></div>
                <div class="bg-red-600 flex-1"></div>
            </div>
            <h2 class="text-lg font-bold text-blue-900 uppercase tracking-wider">
                RÉPUBLIQUE DÉMOCRATIQUE DU CONGO
            </h2>
            <p class="text-sm text-gray-600">Service de vérification des actes officiels</p>
        </div>

        <!-- Carte principale -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            
            <!-- Statut -->
            <div class="px-6 py-5 {{ $isValid ? 'bg-green-50 border-b border-green-200' : 'bg-red-50 border-b border-red-200' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if($isValid)
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-green-800">ATTESTATION VALIDE</h3>
                                <p class="text-sm text-green-700">Ce document est authentique et valide</p>
                            </div>
                        @else
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-red-800">ATTESTATION EXPIRÉE</h3>
                                <p class="text-sm text-red-700">Ce document n'est plus valide</p>
                            </div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-mono font-bold text-gray-700">
                            #{{ str_pad($nationalite->id, 6, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu -->
            <div class="p-6 space-y-5">
                
                <!-- Type de document -->
                <div class="text-center pb-3 border-b border-gray-200">
                    <h4 class="text-xl font-bold text-blue-900 uppercase">Attestation de Nationalité</h4>
                    <p class="text-sm text-gray-500 mt-1">
                        N° {{ $nationalite->numero_officiel ?? 'NAT-' . date('Y') . '-' . $nationalite->id }}
                    </p>
                </div>

                <!-- Informations du titulaire -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <h5 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <span>👤</span> Titulaire de l'attestation
                    </h5>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <span class="text-gray-500">Nom complet :</span>
                            <p class="font-semibold text-gray-800">
                                {{ $nationalite->personne->nom }} {{ $nationalite->personne->prenom }}
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-500">Sexe :</span>
                            <p class="font-semibold text-gray-800">
                                {{ $nationalite->personne->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-500">Date de naissance :</span>
                            <p class="font-semibold text-gray-800">
                                {{ $nationalite->personne->date_naissance ? \Carbon\Carbon::parse($nationalite->personne->date_naissance)->format('d/m/Y') : '—' }}
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-500">Lieu de naissance :</span>
                            <p class="font-semibold text-gray-800">
                                {{ $nationalite->personne->lieu_naissance ?? '—' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Détails du document -->
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-blue-50 rounded-lg p-3">
                        <span class="text-blue-700 text-xs uppercase tracking-wider">Délivré le</span>
                        <p class="font-bold text-gray-800">
                            {{ $dateDelivrance->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="{{ $isValid ? 'bg-green-50' : 'bg-red-50' }} rounded-lg p-3">
                        <span class="{{ $isValid ? 'text-green-700' : 'text-red-700' }} text-xs uppercase tracking-wider">Valable jusqu'au</span>
                        <p class="font-bold {{ $isValid ? 'text-gray-800' : 'text-red-800' }}">
                            {{ $dateExpiration->format('d/m/Y') }}
                            @if($isExpired)
                                <span class="ml-2 text-xs font-normal">(expiré)</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-gray-500 text-xs uppercase tracking-wider">Lieu de délivrance</span>
                        <p class="font-semibold text-gray-800">
                            {{ $nationalite->entite->nom ?? 'Kinshasa' }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-gray-500 text-xs uppercase tracking-wider">Officier d'état civil</span>
                        <p class="font-semibold text-gray-800">
                            {{ $nationalite->user->name ?? '—' }}
                        </p>
                    </div>
                </div>

                <!-- Hash de vérification -->
                <div class="bg-gray-100 rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Hash de vérification</span>
                        <span class="text-xs font-mono text-gray-600">{{ substr($verificationHash, 0, 16) }}...</span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Vérifié le</span>
                        <span class="text-xs font-semibold text-gray-700">{{ now()->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>

                <!-- Messages -->
                @if($isValid)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <p class="text-green-800 text-sm">
                            ✅ Cette attestation est authentique et a été délivrée conformément 
                            à la législation en vigueur en République Démocratique du Congo.
                        </p>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                        <p class="text-red-800 text-sm">
                            ⚠️ Cette attestation a expiré. Une attestation de nationalité est 
                            valable 3 mois à compter de sa date de délivrance.
                        </p>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex justify-center gap-4 pt-3 border-t border-gray-200">
                    <button onclick="window.print()" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
                        <span>🖨️</span> Imprimer cette vérification
                    </button>
                    <a href="{{ url('/') }}" class="px-5 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition">
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center text-xs text-gray-500">
            <p>République Démocratique du Congo — Service officiel de vérification des actes d'état civil</p>
            <p class="mt-1">© {{ date('Y') }} Ministère de la Justice et Garde des Sceaux. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>