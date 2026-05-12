<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                📋 Détails du mariage
            </h2>
             <div class="flex items-center gap-4">
          <a href="{{ route('mariages.certificat', $mariage) }}"
   target="_blank"
   class="text-blue-600 hover:text-blue-900">
   👁 Voir
</a>

{{-- <a href="{{ route('mariages.certificat.pdf', $mariage) }}"
   class="text-red-600 hover:text-red-900">
   📄 PDF
</a> --}}
</div>
            <div class="space-x-2">
                @if(optional($mariage->statut)->nom === 'en cours')
                    <a href="{{ route('divorces.create', ['mariage_id' => $mariage->id]) }}"
                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        💔 Créer un divorce
                    </a>
                @endif
                <a href="{{ route('mariages.edit', $mariage) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    ✏️ Modifier
                </a>
                <a href="{{ route('mariages.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- BANDEAU COUPLE (style hero) -->
        <div class="bg-gradient-to-r from-rose-500 to-purple-600 rounded-2xl shadow-lg mb-8 overflow-hidden">
            <div class="p-8 text-center text-white">
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-3xl">
                        👰
                    </div>
                    <div class="text-4xl">❤️</div>
                    <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-3xl">
                        🤵
                    </div>
                </div>
                <h3 class="text-3xl font-bold mb-2">
                    {{ $mariage->epoux->prenom }} {{ $mariage->epoux->nom }}
                </h3>
                <div class="text-2xl mb-2">&</div>
                <h3 class="text-3xl font-bold mb-4">
                    {{ $mariage->epouse->prenom }} {{ $mariage->epouse->nom }}
                </h3>
                <div class="flex justify-center gap-6 text-sm opacity-90">
                    <div>📅 {{ \Carbon\Carbon::parse($mariage->date_mariage)->format('d/m/Y') }}</div>
                    <div>📍 {{ $mariage->lieu_mariage }}</div>
                </div>
            </div>
        </div>

        <!-- GRILLE PRINCIPALE -->
        <div class="grid lg:grid-cols-2 gap-6 mb-8">
            
            <!-- CARTE ÉPOUX -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>👨‍💼</span> Époux
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Nom complet :</span>
                        <span class="font-semibold text-gray-800">{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Date de naissance :</span>
                        <span class="text-gray-700">{{ $mariage->epoux->date_naissance ?? 'Non renseignée' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Lieu de naissance :</span>
                        <span class="text-gray-700">{{ $mariage->epoux->lieu_naissance ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">État civil :</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">{{ $mariage->epoux->etat_civil }}</span>
                    </div>
                </div>
            </div>

            <!-- CARTE ÉPOUSE -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>👩‍💼</span> Épouse
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Nom complet :</span>
                        <span class="font-semibold text-gray-800">{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Date de naissance :</span>
                        <span class="text-gray-700">{{ $mariage->epouse->date_naissance ?? 'Non renseignée' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Lieu de naissance :</span>
                        <span class="text-gray-700">{{ $mariage->epouse->lieu_naissance ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">État civil :</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">{{ $mariage->epouse->etat_civil }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- GRILLE INFORMATIONS COMPLÉMENTAIRES -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            
            <!-- CARTE PARENTS -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>👪</span> Parents
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    @forelse($mariage->parents as $parent)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                @if(str_contains($parent->type_parent, 'pere'))
                                    👨
                                @else
                                    👩
                                @endif
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 uppercase">{{ ucfirst(str_replace('_', ' ', $parent->type_parent)) }}</div>
                                <div class="font-semibold text-gray-800">{{ $parent->personne->nom }} {{ $parent->personne->prenom }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucun parent renseigné</p>
                    @endforelse
                </div>
            </div>

            <!-- CARTE TÉMOINS -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>👥</span> Témoins
                    </h4>
                </div>
                <div class="p-6">
                    @forelse($mariage->temoins as $temoin)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg mb-2 last:mb-0">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                👤
                            </div>
                            <div class="font-semibold text-gray-800">
                                {{ $temoin->personne->nom }} {{ $temoin->personne->prenom }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucun témoin renseigné</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- SECTION ADMINISTRATIVE -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            
            <!-- CARTE ADMIN -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>🏛️</span> Informations administratives
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Statut :</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            {{ $mariage->statut->nom ?? 'Non défini' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Régime matrimonial :</span>
                        <span class="font-medium">{{ $mariage->regime->contrat->nom ?? 'Non défini' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Entité :</span>
                        <span class="font-medium">{{ $mariage->entite->nom ?? 'Non définie' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Enregistré par :</span>
                        <span class="font-medium">{{ $mariage->user->name ?? 'Inconnu' }}</span>
                    </div>
                </div>
            </div>

            <!-- CARTE INFORMATIONS COMPLÉMENTAIRES -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <span>ℹ️</span> Autres informations
                    </h4>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Date d'enregistrement :</span>
                        <span class="font-medium">{{ $mariage->created_at ? $mariage->created_at->format('d/m/Y H:i') : 'Non renseignée' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Dernière modification :</span>
                        <span class="font-medium">{{ $mariage->updated_at ? $mariage->updated_at->format('d/m/Y H:i') : 'Non renseignée' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Numéro dossier :</span>
                        <span class="font-mono text-sm">#{{ $mariage->id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION PHOTOS -->
        @if($mariage->photo_epoux || $mariage->photo_epouse || $mariage->photo_couple)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <span>📸</span> Galerie photos
                </h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @if($mariage->photo_epoux)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-xl bg-gray-100 aspect-square">
                            <img src="{{ asset('storage/' . $mariage->photo_epoux) }}" 
                                 alt="Photo époux"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-semibold">👨 Époux</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($mariage->photo_epouse)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-xl bg-gray-100 aspect-square">
                            <img src="{{ asset('storage/' . $mariage->photo_epouse) }}" 
                                 alt="Photo épouse"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-semibold">👩 Épouse</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($mariage->photo_couple)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-xl bg-gray-100 aspect-square">
                            <img src="{{ asset('storage/' . $mariage->photo_couple) }}" 
                                 alt="Photo couple"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-semibold">💑 Couple</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
</x-app-layout>