<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                📜 Détails du certificat de bonne vie et mœurs
            </h2>
            
            <div class="flex items-center gap-3">
                <!-- Boutons d'action rapide -->
                <a href="{{ route('bonneviemoeurs.attestation', $bonneviemoeur) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                    👁️ Voir attestation
                </a>
                
                {{-- <a href="{{ route('bonneviemoeurs.attestation.pdf', $bonneviemoeur) }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                    📄 Télécharger PDF
                </a> --}}
                
                <div class="h-6 w-px bg-gray-300"></div>
                
                <a href="{{ route('bonneviemoeurs.edit', $bonneviemoeur) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                    ✏️ Modifier
                </a>
                
                <a href="{{ route('bonneviemoeurs.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- STATUT ET NUMÉRO DE DOSSIER -->
        <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-200">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-bold">
                        Dossier N° {{ str_pad($bonneviemoeur->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">Créé le :</span> {{ $bonneviemoeur->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @php
                        $numeroOfficiel = $bonneviemoeur->numero_officiel ?? 'BVM-' . date('Y') . '-' . str_pad($bonneviemoeur->id, 4, '0', STR_PAD_LEFT);
                    @endphp
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                        📋 {{ $numeroOfficiel }}
                    </span>
                    
                    <!-- Statut du certificat -->
                    @php
                        $statutClass = match($bonneviemoeur->statut ?? 'valide') {
                            'valide' => 'bg-green-100 text-green-800',
                            'expire' => 'bg-red-100 text-red-800',
                            'en_attente' => 'bg-yellow-100 text-yellow-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                        $statutLabel = match($bonneviemoeur->statut ?? 'valide') {
                            'valide' => '✅ Valide',
                            'expire' => '❌ Expiré',
                            'en_attente' => '⏳ En attente',
                            default => '📄 ' . ($bonneviemoeur->statut ?? 'Valide')
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statutClass }}">
                        {{ $statutLabel }}
                    </span>
                </div>
            </div>
        </div>

        <!-- CARTE IDENTITÉ PRINCIPALE -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>👤</span> Identité du demandeur
                </h4>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Informations personnelles -->
                    <div class="space-y-4">
                        <!-- Identité de base -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Nom complet :</span>
                                <span class="font-semibold text-gray-800 text-lg">
                                    {{ $bonneviemoeur->personne->nom }} {{ $bonneviemoeur->personne->prenom }} 
                                    @if($bonneviemoeur->personne->postnom)
                                        <span class="text-gray-600 font-normal">{{ $bonneviemoeur->personne->postnom }}</span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Date de naissance :</span>
                                <span class="text-gray-700">
                                    {{ $bonneviemoeur->personne->date_naissance ? \Carbon\Carbon::parse($bonneviemoeur->personne->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Lieu de naissance :</span>
                                <span class="text-gray-700">{{ $bonneviemoeur->personne->lieu_naissance ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Sexe :</span>
                                <span class="px-3 py-1 {{ $bonneviemoeur->personne->sexe == 'M' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }} rounded-full text-sm font-medium">
                                    {{ $bonneviemoeur->personne->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                                </span>
                            </div>
                        </div>

                        <!-- Origine géographique -->
                        <div class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-emerald-50 rounded-xl border border-gray-200">
                            <h5 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <span>📍</span> Origine géographique
                            </h5>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-24">Localité :</span>
                                    <span class="font-medium text-gray-800">
                                        {{ $bonneviemoeur->personne->localite->nom ?? $bonneviemoeur->personne->lieu_naissance ?? 'Non renseignée' }}
                                    </span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-24">Secteur :</span>
                                    <span class="font-medium text-gray-800">{{ $bonneviemoeur->personne->secteur->nom ?? 'Non renseigné' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-24">Territoire :</span>
                                    <span class="font-medium text-gray-800">{{ $bonneviemoeur->personne->territoire->nom ?? 'Non renseigné' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-24">District :</span>
                                    <span class="font-medium text-gray-800">{{ $bonneviemoeur->personne->district->nom ?? 'Non renseigné' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-24">Province :</span>
                                    <span class="font-medium text-gray-800">{{ $bonneviemoeur->personne->province->nom ?? 'Non renseignée' }}</span>
                                </div>
                                <div class="flex items-start gap-2 pt-2 border-t border-gray-200">
                                    <span class="text-gray-500 min-w-24">Pays :</span>
                                    <span class="font-medium text-gray-800 flex items-center gap-1">
                                        <span>🇨🇩</span> République Démocratique du Congo
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Résidence actuelle -->
                        <div class="p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-200">
                            <h5 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span>🏠</span> Résidence actuelle
                            </h5>
                            <div class="text-sm">
                                <span class="text-gray-500">Adresse :</span>
                                <span class="font-medium text-gray-800 block mt-1">
                                    {{ $bonneviemoeur->personne->adresse ?? $bonneviemoeur->residence ?? 'Non renseignée' }}
                                </span>
                            </div>
                        </div>

                        <!-- Profession -->
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                            <h5 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span>💼</span> Profession
                            </h5>
                            <div class="text-sm">
                                <span class="font-medium text-gray-800">
                                    {{ $bonneviemoeur->personne->profession ?? 'Non renseignée' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Photo et certificat -->
                    <div class="flex flex-col items-center justify-start">
                        @if($bonneviemoeur->personne->photo)
                            <div class="relative w-48 h-48 rounded-xl overflow-hidden shadow-lg border-2 border-gray-200">
                                <img src="{{ asset('storage/' . $bonneviemoeur->personne->photo) }}" 
                                     alt="Photo d'identité"
                                     class="w-full h-full object-cover">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Photo d'identité officielle</p>
                        @else
                            <div class="w-48 h-48 rounded-xl bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center gap-2">
                                <span class="text-4xl">📷</span>
                                <span class="text-gray-400 text-center text-sm">Aucune photo<br>disponible</span>
                            </div>
                        @endif

                        <!-- Badge certificat -->
                        <div class="mt-4 w-full max-w-xs">
                            <div class="bg-emerald-600 text-white rounded-lg p-3 text-center">
                                <div class="text-xs uppercase tracking-wider opacity-90">Certificat de</div>
                                <div class="font-bold text-lg">Bonne Vie et Mœurs</div>
                                <div class="text-xs mt-1 opacity-80">
                                    @if($bonneviemoeur->date_delivrance)
                                        Délivré le {{ \Carbon\Carbon::parse($bonneviemoeur->date_delivrance)->format('d/m/Y') }}
                                    @else
                                        {{ $bonneviemoeur->created_at->format('d/m/Y') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Mention spéciale -->
                        @if($bonneviemoeur->mention_speciale)
                        <div class="mt-3 w-full max-w-xs bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-xs text-yellow-800 font-medium">📌 Mention :</p>
                            <p class="text-sm text-gray-700">{{ $bonneviemoeur->mention_speciale }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- GRILLE INFORMATIONS (PARENTS + ADMIN) -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            
            <!-- CARTE PARENTS -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>👪</span> Filiation
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <!-- Père -->
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            👨
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500 uppercase font-medium">Père</div>
                            <div class="font-semibold text-gray-800">
                                {{ $bonneviemoeur->personne->pere ?? 'Non renseigné' }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mère -->
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                            👩
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500 uppercase font-medium">Mère</div>
                            <div class="font-semibold text-gray-800">
                                {{ $bonneviemoeur->personne->mere ?? 'Non renseignée' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARTE ADMINISTRATIVE -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>🏛️</span> Informations administratives
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Motif de la demande :</span>
                        <span class="font-semibold">{{ $bonneviemoeur->motif ?? 'Non spécifié' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Entité de délivrance :</span>
                        <span class="font-semibold">{{ $bonneviemoeur->entite->nom ?? 'Non définie' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Autorité émettrice :</span>
                        <span class="font-medium">{{ $bonneviemoeur->autorite ?? 'Officier d\'état civil' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Enregistré par :</span>
                        <span class="font-medium">{{ $bonneviemoeur->user->name ?? 'Inconnu' }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-500 font-medium">Dernière modification :</span>
                        <span class="text-sm text-gray-600">{{ $bonneviemoeur->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION VALIDITÉ -->
        <div class="grid md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-green-500">
                <span class="text-xs text-gray-500 uppercase">Date de délivrance</span>
                <p class="font-bold text-gray-800">
                    {{ $bonneviemoeur->date_delivrance ? \Carbon\Carbon::parse($bonneviemoeur->date_delivrance)->format('d/m/Y') : $bonneviemoeur->created_at->format('d/m/Y') }}
                </p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-blue-500">
                <span class="text-xs text-gray-500 uppercase">Valable jusqu'au</span>
                <p class="font-bold text-gray-800">
                    @php
                        $dateDelivrance = $bonneviemoeur->date_delivrance 
                            ? \Carbon\Carbon::parse($bonneviemoeur->date_delivrance) 
                            : $bonneviemoeur->created_at;
                        $dateExpiration = $dateDelivrance->copy()->addMonths(3);
                    @endphp
                    {{ $dateExpiration->format('d/m/Y') }}
                    @if(now()->greaterThan($dateExpiration))
                        <span class="ml-2 text-xs text-red-600 font-normal">(Expiré)</span>
                    @endif
                </p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-purple-500">
                <span class="text-xs text-gray-500 uppercase">Jours restants</span>
                <p class="font-bold {{ now()->diffInDays($dateExpiration, false) > 0 ? 'text-green-600' : 'text-red-600' }}">
                    @php
                        $joursRestants = now()->diffInDays($dateExpiration, false);
                    @endphp
                    @if($joursRestants > 0)
                        {{ $joursRestants }} jours
                    @else
                        Expiré depuis {{ abs($joursRestants) }} jours
                    @endif
                </p>
            </div>
        </div>

        
        <!-- SECTION PIÈCES JOINTES -->
        @if($bonneviemoeur->documents || $bonneviemoeur->certificat_medical || $bonneviemoeur->personne->photo)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>📎</span> Pièces justificatives
                </h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if($bonneviemoeur->certificat_medical)
                        <div class="group relative">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                <img src="{{ asset('storage/' . $bonneVieMoeur->certificat_medical) }}" 
                                     alt="Certificat médical"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="mt-2 text-center text-sm font-medium text-gray-700">Certificat médical</div>
                        </div>
                    @endif
                    
                 @php
                            $file = $bonneviemoeur->documents;
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if ($bonneviemoeur->documents)
                            <div class="group relative">
                                <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                    <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">

                                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <!-- IMAGE -->
                                            <img src="{{ asset('storage/' . $file) }}"
                                                class="w-full h-full object-cover">
                                        @elseif($extension === 'pdf')
                                            <!-- PDF -->
                                            <iframe src="{{ asset('storage/' . $file) }}"
                                                class="w-full h-full"></iframe>
                                        @elseif(in_array($extension, ['doc', 'docx']))
                                            <!-- WORD -->
                                            <div class="flex flex-col items-center justify-center h-full">
                                                <span class="text-4xl">📄</span>
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="text-blue-500 underline">
                                                    Ouvrir le document
                                                </a>
                                            </div>
                                        @else
                                            <!-- AUTRE -->
                                            <div class="flex flex-col items-center justify-center h-full">
                                                <span class="text-4xl">📁</span>
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="text-blue-500 underline">
                                                    Télécharger
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="mt-2 text-center text-sm font-medium text-gray-700">Document annexe</div>
                            </div>
                        @endif


                    @if($bonneviemoeur->personne->photo)
                        <div class="group relative">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                <img src="{{ asset('storage/' . $bonneviemoeur->personne->photo) }}" 
                                     alt="Photo"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="mt-2 text-center text-sm font-medium text-gray-700">Photo d'identité</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- TIMELINE / HISTORIQUE -->
        <div class="mt-6 text-right text-xs text-gray-400">
            Dossier créé le {{ $bonneviemoeur->created_at->format('d/m/Y à H:i') }} 
            • Mis à jour {{ $bonneviemoeur->updated_at->diffForHumans() }}
            @if(isset($bonneviemoeur->verified_at) && $bonneviemoeur->verified_at)
                • Vérifié le {{ \Carbon\Carbon::parse($bonneviemoeur->verified_at)->format('d/m/Y') }}
            @endif
        </div>
    </div>
</x-app-layout>