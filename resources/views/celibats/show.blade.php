<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                👶 Détails de l'acte de veuvage
            </h2>
            
            <div class="flex items-center gap-3">
                <!-- Boutons d'action rapide -->
                <a href="{{ route('celibats.attestation', $celibat  ) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                    👁️ Voir attestation
                </a>
                
                {{-- <a href="{{ route('celibats.attestation.pdf', $celibat) }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                    📄 Télécharger PDF
                </a> --}}
                
                <div class="h-6 w-px bg-gray-300"></div>
                
                <a href="{{ route('celibats.edit', $celibat) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                    ✏️ Modifier
                </a>
                
                <a href="{{ route('celibats.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- STATUT ET NUMÉRO DE DOSSIER -->
        <div class="mb-6 p-4 bg-gradient-to-r from-sky-50 to-blue-50 rounded-xl border border-sky-200">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="bg-sky-600 text-white px-4 py-2 rounded-lg font-bold">
                        Acte N° {{ str_pad($celibat->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">Enregistré le :</span> {{ $celibat->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @php
                        $numeroOfficiel = $celibat->numero_acte ?? 'CEL-' . date('Y') . '-' . str_pad($celibat->id, 4, '0', STR_PAD_LEFT);
                    @endphp
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                        📋 {{ $numeroOfficiel }}
                    </span>
                    
                    <!-- Statut de l'acte -->
                    @php
                        $statutClass = match($celibat->statut ?? 'enregistre') {
                            'enregistre' => 'bg-green-100 text-green-800',
                            'en_attente' => 'bg-yellow-100 text-yellow-800',
                            'annule' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                        $statutLabel = match($celibat->statut ?? 'enregistre') {
                            'enregistre' => '✅ Enregistré',
                            'en_attente' => '⏳ En attente',
                            'annule' => '❌ Annulé',
                            default => '📄 ' . ($celibat->statut ?? 'Enregistré')
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statutClass }}">
                        {{ $statutLabel }}
                    </span>
                </div>
            </div>
        </div>

        <!-- CARTE IDENTITÉ DE L'ENFANT -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-sky-600 to-blue-600 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>👶</span> Identité de l'enfant
                </h4>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Informations de l'enfant -->
                    <div class="space-y-4">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Nom complet :</span>
                                <span class="font-semibold text-gray-800 text-lg">
                                    {{ $celibat->personne->nom }} {{ $celibat->personne->prenom }} 
                                    @if($celibat->personne->postnom)
                                        <span class="text-gray-600 font-normal">{{ $celibat->personne->postnom }}</span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Date de naissance :</span>
                                <span class="text-gray-700">
                                    {{ $celibat->personne->date_naissance ? \Carbon\Carbon::parse($celibat->personne->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Heure de naissance :</span>
                                <span class="text-gray-700">{{ $celibat->heure_naissance ?? 'Non renseignée' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-500 font-medium">Lieu de naissance :</span>
                                <span class="text-gray-700">{{ $celibat->personne->lieu_naissance ?? $celibat->lieu_naissance ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Sexe :</span>
                                <span class="px-3 py-1 {{ $celibat->personne->sexe == 'M' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }} rounded-full text-sm font-medium">
                                    {{ $celibat->personne->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                                </span>
                            </div>
                        </div>

                        <!-- Lieu de naissance détaillé -->
                        <div class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-sky-50 rounded-xl border border-gray-200">
                            <h5 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <span>📍</span> Lieu de naissance
                            </h5>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-28">Établissement :</span>
                                    <span class="font-medium text-gray-800">{{ $celibat->etablissement ?? 'Non renseigné' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-28">Localité :</span>
                                    <span class="font-medium text-gray-800">{{ $celibat->localite->nom ?? $celibat->personne->lieu_naissance ?? 'Non renseignée' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-28">Commune/Secteur :</span>
                                    <span class="font-medium text-gray-800">{{ $celibat->commune ?? $celibat->personne->secteur->nom ?? 'Non renseigné' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-28">Territoire :</span>
                                    <span class="font-medium text-gray-800">{{ $celibat->territoire->nom ?? $celibat->personne->territoire->nom ?? 'Non renseigné' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-500 min-w-28">Province :</span>
                                    <span class="font-medium text-gray-800">{{ $celibat->province->nom ?? $celibat->personne->province->nom ?? 'Non renseignée' }}</span>
                                </div>
                                <div class="flex items-start gap-2 pt-2 border-t border-gray-200">
                                    <span class="text-gray-500 min-w-28">Pays :</span>
                                    <span class="font-medium text-gray-800 flex items-center gap-1">
                                        <span>🇨🇩</span> République Démocratique du Congo
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Photo et badge -->
                    <div class="flex flex-col items-center justify-start">
                        @if($celibat->personne->photo)
                            <div class="relative w-48 h-48 rounded-xl overflow-hidden shadow-lg border-2 border-gray-200">
                                <img src="{{ asset('storage/' . $celibat->personne->photo) }}" 
                                     alt="Photo d'identité"
                                     class="w-full h-full object-cover">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Photo d'identité</p>
                        @else
                            <div class="w-48 h-48 rounded-xl bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center gap-2">
                                <span class="text-4xl">👶</span>
                                <span class="text-gray-400 text-center text-sm">Aucune photo<br>disponible</span>
                            </div>
                        @endif

                        <!-- Badge acte de naissance -->
                        <div class="mt-4 w-full max-w-xs">
                            <div class="bg-sky-600 text-white rounded-lg p-3 text-center">
                                <div class="text-xs uppercase tracking-wider opacity-90">Acte de naissance</div>
                                <div class="font-bold text-lg">N° {{ $numeroOfficiel }}</div>
                                <div class="text-xs mt-1 opacity-80">
                                    Déclaré le {{ $celibat->date_declaration ? \Carbon\Carbon::parse($celibat->date_declaration)->format('d/m/Y') : $celibat->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Mention marginale -->
                        @if($celibat->mention_marginale)
                        <div class="mt-3 w-full max-w-xs bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-xs text-yellow-800 font-medium">📌 Mention marginale :</p>
                            <p class="text-sm text-gray-700">{{ $celibat->mention_marginale }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- GRILLE INFORMATIONS (PARENTS + DÉCLARANT) -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            
            <!-- CARTE PARENTS -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-sky-500 to-blue-500 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>👪</span> Parents
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <!-- Père -->
                    <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            👨
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500 uppercase font-medium">Père</div>
                            <div class="font-semibold text-gray-800">
                                {{ $celibat->pere_nom ?? $celibat->personne->pere ?? 'Non renseigné' }}
                            </div>
                            @if($celibat->pere_profession)
                                <div class="text-xs text-gray-500 mt-1">{{ $celibat->pere_profession }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Mère -->
                    <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                            👩
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500 uppercase font-medium">Mère</div>
                            <div class="font-semibold text-gray-800">
                                {{ $celibat->mere_nom ?? $celibat->personne->mere ?? 'Non renseignée' }}
                            </div>
                            @if($celibat->mere_profession)
                                <div class="text-xs text-gray-500 mt-1">{{ $celibat->mere_profession }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARTE DÉCLARANT ET ADMIN -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>📝</span> Déclaration et administration
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <!-- Déclarant -->
                    <div class="pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium text-sm uppercase">Déclarant</span>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $celibat->declarant_nom ?? 'Non renseigné' }}
                        </p>
                        @if($celibat->declarant_qualite)
                            <p class="text-sm text-gray-500">{{ $celibat->declarant_qualite }}</p>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Date de déclaration :</span>
                        <span class="font-semibold">
                            {{ $celibat->date_declaration ? \Carbon\Carbon::parse($celibat->date_declaration)->format('d/m/Y') : $celibat->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Entité d'enregistrement :</span>
                        <span class="font-semibold">{{ $celibat->entite->nom ?? 'Non définie' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Officier d'état civil :</span>
                        <span class="font-medium">{{ $celibat->officier_nom ?? $celibat->user->name ?? 'Inconnu' }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-500 font-medium">Dernière modification :</span>
                        <span class="text-sm text-gray-600">{{ $celibat->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION INFORMATIONS COMPLÉMENTAIRES -->
        <div class="grid md:grid-cols-3 gap-4 mb-6">
          
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-blue-500">
                <span class="text-xs text-gray-500 uppercase">Numéro de registre</span>
                <p class="font-bold text-gray-800">{{ $celibat->numero_registre ?? 'Non attribué' }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-indigo-500">
                <span class="text-xs text-gray-500 uppercase">Année d'enregistrement</span>
                <p class="font-bold text-gray-800">{{ $celibat->annee_enregistrement ?? date('Y') }}</p>
            </div>
        </div>

        <!-- SECTION PIÈCES JOINTES -->
        @if($celibat->documents || $celibat->certificat_medical || $celibat->personne->photo)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>📎</span> Pièces justificatives
                </h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if($celibat->certificat_medical)
                        <div class="group relative">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                <img src="{{ asset('storage/' . $celibat->certificat_medical) }}" 
                                     alt="Certificat médical"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="mt-2 text-center text-sm font-medium text-gray-700">Certificat médical</div>
                        </div>
                    @endif
                    
                    @if($celibat->documents)
                        <div class="group relative">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                <img src="{{ asset('storage/' . $celibat->documents) }}" 
                                     alt="Document"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="mt-2 text-center text-sm font-medium text-gray-700">Document annexe</div>
                        </div>
                    @endif

                    @if($celibat->personne->photo)
                        <div class="group relative">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                <img src="{{ asset('storage/' . $celibat->personne->photo) }}" 
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
            Acte dressé le {{ $celibat->created_at->format('d/m/Y à H:i') }} 
            • Dernière mise à jour {{ $celibat->updated_at->diffForHumans() }}
        </div>
    </div>
</x-app-layout>