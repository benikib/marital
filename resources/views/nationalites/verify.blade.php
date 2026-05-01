<x-guest-layout>
  

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- STATUT ET NUMÉRO DE DOSSIER -->
        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold">
                        Dossier N° {{ str_pad($nationalite->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">Créé le :</span> {{ $nationalite->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
                <div>
                    @php
                        $numeroOfficiel = $nationalite->numero_officiel ?? 'NAT-' . date('Y') . '-' . str_pad($nationalite->id, 4, '0', STR_PAD_LEFT);
                    @endphp
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                        📋 {{ $numeroOfficiel }}
                    </span>
                </div>
            </div>
        </div>

      <!-- CARTE IDENTITÉ PRINCIPALE -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
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
                            {{ $nationalite->personne->nom }} {{ $nationalite->personne->prenom }} 
                            @if($nationalite->personne->postnom)
                                <span class="text-gray-600 font-normal">{{ $nationalite->personne->postnom }}</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Date de naissance :</span>
                        <span class="text-gray-700">
                            {{ $nationalite->personne->date_naissance ? \Carbon\Carbon::parse($nationalite->personne->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Lieu de naissance :</span>
                        <span class="text-gray-700">{{ $nationalite->personne->lieu_naissance ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Sexe :</span>
                        <span class="px-3 py-1 {{ $nationalite->personne->sexe == 'M' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }} rounded-full text-sm font-medium">
                            {{ $nationalite->personne->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                        </span>
                    </div>
                </div>

                <!-- Origine géographique -->
                @php
                    $personne = $nationalite->personne;
                    $entitePersonne = $personne->entite;
                    $entiteParent = $entitePersonne->parent ?? null;
                    $territoire = $entiteParent->parent ?? null;
                    $district = $territoire->parent ?? null;
                    $province = $district->parent ?? null;
                @endphp

                <div class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-200">
                    <h5 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <span>📍</span> Origine géographique
                    </h5>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 min-w-24">Localité :</span>
                            <span class="font-medium text-gray-800">{{ $entitePersonne->nom ?? 'Non renseignée' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 min-w-24">Secteur :</span>
                            <span class="font-medium text-gray-800">{{ $entiteParent->nom ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 min-w-24">Territoire :</span>
                            <span class="font-medium text-gray-800">{{ $nationalite->personne->territoire->nom ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 min-w-24">District :</span>
                            <span class="font-medium text-gray-800">{{ $nationalite->personne->district->nom ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 min-w-24">Province :</span>
                            <span class="font-medium text-gray-800">{{ $nationalite->personne->province->nom ?? 'Non renseignée' }}</span>
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
                <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                    <h5 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span>🏠</span> Résidence actuelle
                    </h5>
                    <div class="text-sm">
                        <span class="text-gray-500">Adresse :</span>
                        <span class="font-medium text-gray-800 block mt-1">
                            {{ $nationalite->personne->adresse ?? $nationalite->residence ?? 'Non renseignée' }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Photo -->
            <div class="flex flex-col items-center justify-start">
                @if($nationalite->personne->photo)
                    <div class="relative w-48 h-48 rounded-xl overflow-hidden shadow-lg border-2 border-gray-200">
                        <img src="{{ asset('storage/' . $nationalite->personne->photo) }}" 
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

                <!-- Badge de nationalité -->
                <div class="mt-4 w-full max-w-xs">
                    <div class="bg-blue-600 text-white rounded-lg p-3 text-center">
                        <div class="text-xs uppercase tracking-wider opacity-90">Nationalité</div>
                        <div class="font-bold text-lg">Congolaise</div>

                    </div>
                </div>
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
                                {{ $nationalite->personne->pere ?? 'Non renseigné' }}
                            </div>
                            @if(isset($parent->nationalite_pere))
                                <div class="text-sm text-gray-500">{{ $parent->nationalite_pere }}</div>
                            @endif
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
                                {{ $nationalite->personne->mere ?? 'Non renseignée' }}
                            </div>
                            @if(isset($parent->nationalite_mere))
                                <div class="text-sm text-gray-500">{{ $parent->nationalite_mere }}</div>
                            @endif
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
                        <span class="text-gray-500 font-medium">Résidence :</span>
                        <span class="font-semibold">{{ $nationalite->residence ?? 'Non définie' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Entité territoriale :</span>
                        <span class="font-semibold">{{ $nationalite->entite->nom ?? 'Non définie' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Enregistré par :</span>
                        <span class="font-medium">{{ $nationalite->user->name ?? 'Inconnu' }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-500 font-medium">Dernière modification :</span>
                        <span class="text-sm text-gray-600">{{ $nationalite->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION JUSTIFICATIFS -->
        @if($nationalite->personne->photo || isset($nationalite->documents))
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>📎</span> Documents justificatifs
                </h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if($nationalite->personne->photo)
                    <div class="group relative">
                        <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-[3/4]">
                            <img src="{{ asset('storage/' . $nationalite->personne->photo) }}" 
                                 alt="Photo d'identité"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 text-center text-sm font-medium text-gray-700">Photo d'identité</div>
                    </div>
                    @endif
                    
                    <!-- Placeholder pour d'autres documents si nécessaire -->
                    <div class="group relative">
                        <div class="relative overflow-hidden rounded-lg bg-gray-50 border-2 border-dashed border-gray-300 aspect-[3/4] flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Acte de naissance</span>
                        </div>
                        <div class="mt-2 text-center text-sm font-medium text-gray-700">Acte de naissance</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TIMELINE / HISTORIQUE -->
        <div class="mt-6 text-right text-xs text-gray-400">
            Dossier créé le {{ $nationalite->created_at->format('d/m/Y à H:i') }} 
            • Mis à jour {{ $nationalite->updated_at->diffForHumans() }}
            @if($nationalite->verified_at)
                • Vérifié le {{ \Carbon\Carbon::parse($nationalite->verified_at)->format('d/m/Y') }}
            @endif
        </div>
    </div>
</x-guest-layout>