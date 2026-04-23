<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification échouée - RDC</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        
        <div class="text-center mb-6">
            <div class="flex w-full h-3 mb-3 rounded-full overflow-hidden">
                <div class="bg-blue-600 flex-1"></div>
                <div class="bg-yellow-400 flex-1"></div>
                <div class="bg-blue-600 flex-1"></div>
                <div class="bg-yellow-400 flex-1"></div>
                <div class="bg-red-600 flex-1"></div>
            </div>
            <h2 class="text-lg font-bold text-blue-900 uppercase">RÉPUBLIQUE DÉMOCRATIQUE DU CONGO</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="px-6 py-5 bg-red-50 border-b border-red-200">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-red-800">ATTESTATION INTROUVABLE</h3>
                        <p class="text-sm text-red-700">{{ $message }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 text-center space-y-4">
                <p class="text-gray-600">
                    Le document que vous tentez de vérifier n'existe pas dans nos registres.
                    Veuillez vérifier le numéro ou scanner à nouveau le QR code.
                </p>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-sm text-yellow-800">
                        ⚠️ Si vous pensez qu'il s'agit d'une erreur, veuillez contacter 
                        le service d'état civil compétent.
                    </p>
                </div>

                <div class="pt-4">
                    <a href="{{ url('/') }}" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>