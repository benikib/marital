<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fiche de la personne') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('personnes.edit', $personne) }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                    {{ __('Modifier') }}
                </a>
                <a href="{{ route('personnes.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                    {{ __('Retour à la liste') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- En-tête avec photo --}}
                    <div class="flex items-center space-x-6 mb-8 pb-6 border-b">
                        @if($personne->photo)
                            <div>
                                <img src="{{ asset('storage/' . $personne->photo) }}" 
                                     alt="Photo de {{ $personne->prenom }} {{ $personne->nom }}"
                                     class="h-24 w-24 rounded-full object-cover border-2 border-gray-300">
                            </div>
                        @else
                            <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $personne->prenom }} {{ $personne->nom }} {{ $personne->postnom }}
                            </h3>
                            <p class="text-gray-600 mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $personne->statut_vie === 'en vie' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $personne->statut_vie === 'en vie' ? 'En vie' : 'Décédé(e)' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- Grille des informations --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Identité --}}
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-lg text-gray-800 mb-3 border-b pb-2">Identité</h4>
                            <dl class="space-y-2">
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Nom :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->nom }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Prénom :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->prenom }}</dd>
                                </div>
                                @if($personne->postnom)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Postnom :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->postnom }}</dd>
                                </div>
                                @endif
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Sexe :</dt>
                                    <dd class="w-2/3 font-medium">
                                        {{ $personne->sexe === 'M' ? 'Masculin' : ($personne->sexe === 'F' ? 'Féminin' : '-') }}
                                    </dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">État civil :</dt>
                                    <dd class="w-2/3 font-medium">{{ ucfirst($personne->etat_civil ?? '-') }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Naissance --}}
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-lg text-gray-800 mb-3 border-b pb-2">Naissance</h4>
                            <dl class="space-y-2">
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Date :</dt>
                                    <dd class="w-2/3 font-medium">
                                        {{ $personne->date_naissance?->format('d/m/Y') ?? '-' }}
                                    </dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Lieu :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->lieu_naissance ?? '-' }}</dd>
                                </div>
                                @if($personne->nationalite)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Nationalité :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->nationalite }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        {{-- Coordonnées --}}
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-lg text-gray-800 mb-3 border-b pb-2">Coordonnées</h4>
                            <dl class="space-y-2">
                                @if($personne->adresse)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Adresse :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->adresse }}</dd>
                                </div>
                                @endif
                                @if($personne->telephone)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Téléphone :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->telephone }}</dd>
                                </div>
                                @endif
                                @if($personne->profession)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Profession :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->profession }}</dd>
                                </div>
                                @endif
                                @if($personne->cin)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">CIN :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->cin }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        {{-- Filiation --}}
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-lg text-gray-800 mb-3 border-b pb-2">Filiation</h4>
                            <dl class="space-y-2">
                                @if($personne->pere)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Père :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->pere }}</dd>
                                </div>
                                @endif
                                @if($personne->mere)
                                <div class="flex">
                                    <dt class="w-1/3 text-gray-600">Mère :</dt>
                                    <dd class="w-2/3 font-medium">{{ $personne->mere }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        {{-- Localisation géographique --}}
                        <div class="bg-gray-50 rounded-lg p-4 md:col-span-2">
                            <h4 class="font-semibold text-lg text-gray-800 mb-3 border-b pb-2">Localisation géographique</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @if($personne->province)
                                <div>
                                    <dt class="text-gray-600 text-sm">Province</dt>
                                    <dd class="font-medium">{{ $personne->province->nom ?? '-' }}</dd>
                                </div>
                                @endif
                                @if($personne->ville)
                                <div>
                                    <dt class="text-gray-600 text-sm">Ville</dt>
                                    <dd class="font-medium">{{ $personne->ville->nom ?? '-' }}</dd>
                                </div>
                                @endif
                                @if($personne->district)
                                <div>
                                    <dt class="text-gray-600 text-sm">District</dt>
                                    <dd class="font-medium">{{ $personne->district->nom ?? '-' }}</dd>
                                </div>
                                @endif
                                @if($personne->territoire)
                                <div>
                                    <dt class="text-gray-600 text-sm">Territoire</dt>
                                    <dd class="font-medium">{{ $personne->territoire->nom ?? '-' }}</dd>
                                </div>
                                @endif
                                @if($personne->secteur)
                                <div>
                                    <dt class="text-gray-600 text-sm">Secteur</dt>
                                    <dd class="font-medium">{{ $personne->secteur->nom ?? '-' }}</dd>
                                </div>
                                @endif
                                @if($personne->localite)
                                <div>
                                    <dt class="text-gray-600 text-sm">Localité</dt>
                                    <dd class="font-medium">{{ $personne->localite->nom ?? '-' }}</dd>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Actions supplémentaires --}}
                    <div class="mt-8 pt-6 border-t flex justify-end space-x-3">
                        {{-- <form action="{{ route('personnes.destroy', $personne) }}" method="POST" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette personne ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                {{ __('Supprimer') }}
                            </button>
                        </form> --}}
                        <a href="{{ route('personnes.edit', $personne) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            {{ __('Modifier') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>