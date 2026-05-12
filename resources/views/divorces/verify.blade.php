<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- HEADER -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 bg-red-100 text-red-800 px-6 py-3 rounded-full">
                <span class="text-2xl">⚖️</span>
                <span class="font-bold text-lg">VÉRIFICATION D'ACTE DE DIVORCE</span>
            </div>
            <p class="text-gray-600 mt-2">Document officiel de l'État Civil</p>
        </div>

        <!-- STATUT ET NUMÉRO DE DOSSIER -->
        <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl border border-red-200">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold">
                        Divorce N° {{ str_pad($divorce->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">Enregistré le :</span> {{ $divorce->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                        📋 {{ $divorce->num_acte }}
                    </span>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        ✅ Vérifié
                    </span>
                </div>
            </div>
        </div>

        <!-- BANDEAU COUPLE -->
        <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-2xl shadow-lg mb-8 overflow-hidden">
            <div class="p-8 text-center text-white">
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-3xl">
                        💔
                    </div>
                </div>
                <h3 class="text-3xl font-bold mb-2">
                    {{ $divorce->mariage->epoux->prenom ?? '-' }} {{ $divorce->mariage->epoux->nom ?? '-' }}
                </h3>
                <div class="text-2xl mb-2">et</div>
                <h3 class="text-3xl font-bold mb-4">
                    {{ $divorce->mariage->epouse->prenom ?? '-' }} {{ $divorce->mariage->epouse->nom ?? '-' }}
                </h3>
                <div class="flex justify-center gap-6 text-sm opacity-90">
                    <div>📅 Divorce le {{ optional(optional($divorce)->date_divorce)->format('d/m/Y') ?? 'N/A' }}</div>
                    <div>⚖️ {{ $divorce->divorce_rendu ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- INFORMATIONS DU DIVORCE -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-red-600 to-pink-600 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>⚖️</span> Informations du divorce
                </h4>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Date du divorce :</span>
                            <span class="font-semibold text-gray-800">{{ optional(optional($divorce)->date_divorce)->format('d/m/Y') ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Tribunal :</span>
                            <span class="text-gray-700">{{ $divorce->divorce_rendu }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Date de transcription :</span>
                            <span class="text-gray-700">{{ $divorce->date_transcription ? \Carbon\Carbon::parse($divorce->date_transcription)->format('d/m/Y') : 'Non renseignée' }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Date du jugement :</span>
                            <span class="text-gray-700">{{ $divorce->date_jugement ? \Carbon\Carbon::parse($divorce->date_jugement)->format('d/m/Y') : 'Non renseignée' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Numéro du jugement :</span>
                            <span class="text-gray-700">{{ $divorce->numero_jugement ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Soussignataire :</span>
                            <span class="text-gray-700">{{ $divorce->soussignataire }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Entité d'enregistrement :</span>
                            <span class="text-gray-700">{{ $divorce->entite->nom ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Utilisateur :</span>
                            <span class="text-gray-700">{{ $divorce->user->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Numéro d'acte :</span>
                            <span class="font-semibold text-gray-800">{{ $divorce->num_acte }}</span>
                        </div>
                    </div>
                </div>

                @if($divorce->mentions_complementaire)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800 mb-3">Mentions complémentaires</h5>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $divorce->mentions_complementaire }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- MARIAGE D'ORIGINE -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>💍</span> Mariage d'origine
                </h4>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Date du mariage :</span>
                            <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($divorce->mariage->date_mariage)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Lieu du mariage :</span>
                            <span class="text-gray-700">{{ $divorce->mariage->lieu_mariage }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Statut actuel :</span>
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">{{ $divorce->mariage->statut->nom ?? 'dissous' }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-500 font-medium">Régime matrimonial :</span>
                            <span class="text-gray-700">{{ $divorce->mariage->regime->nom ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Entité :</span>
                            <span class="text-gray-700">{{ $divorce->mariage->entite->nom ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIGNATURE -->
        <div class="mt-8 text-center">
            <div class="inline-block p-4 bg-white rounded-lg shadow-lg border">
                <p class="text-sm text-gray-600">Acte vérifié et authentique.</p>
                <p class="text-xs text-gray-500 mt-2">Référence : {{ $divorce->num_acte }}</p>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>Document officiel de l'État Civil - République Démocratique du Congo</p>
            <p>Vérifié le {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</x-guest-layout>