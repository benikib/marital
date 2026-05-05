@php
    $mariage = $mariage ?? null;
@endphp

<div class="space-y-8">
    
    <!-- SECTION: IDENTITÉ DES ÉPOUX -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <span>💑</span> Identité des époux
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="epoux_id" value="👨 Époux" class="font-semibold" />
                    <select id="epoux_id" name="epoux_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner un époux</option>
                        @foreach($personnes_epoux as $personne)
                            <option value="{{ $personne->id }}" @selected(old('epoux_id', $mariage->epoux_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('epoux_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="epouse_id" value="👩 Épouse" class="font-semibold" />
                    <select id="epouse_id" name="epouse_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une épouse</option>
                        @foreach($personnes_epouse as $personne)
                            <option value="{{ $personne->id }}" @selected(old('epouse_id', $mariage->epouse_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('epouse_id')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION: INFORMATIONS DU MARIAGE -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-rose-500 to-orange-500 px-6 py-4">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <span>📋</span> Informations du mariage
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="date_mariage" value="📅 Date du mariage" class="font-semibold" />
                    <x-text-input id="date_mariage" name="date_mariage" type="date" class="mt-1 block w-full rounded-lg" value="{{ old('date_mariage', $mariage?->date_mariage?->format('Y-m-d') ?? '') }}" required />
                    <x-input-error :messages="$errors->get('date_mariage')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="lieu_mariage" value="📍 Lieu du mariage" class="font-semibold" />
                    <x-text-input id="lieu_mariage" name="lieu_mariage" type="text" class="mt-1 block w-full rounded-lg" value="{{ old('lieu_mariage', $mariage->lieu_mariage ?? '') }}" required autocomplete="off" placeholder="Ex: Mairie du 5ème arrondissement" />
                    <x-input-error :messages="$errors->get('lieu_mariage')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="regime_id" value="⚖️ Régime matrimonial" class="font-semibold" />
                    <select id="regime_id" name="regime_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner un régime</option>
                        @foreach($regimes as $regime)
                            <option value="{{ $regime->id }}" @selected(old('regime_id', $mariage->regime_id ?? '') == $regime->id)>
                                {{ $regime->contrat->nom ?? 'Contrat inconnu' }} - {{ number_format($regime->dotation_coutumiere, 2, ',', ' ') }} FC
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('regime_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="statut_id" value="📌 Statut du mariage" class="font-semibold" />
                    <select id="statut_id" name="statut_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner un statut</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut->id }}" @selected(old('statut_id', $mariage->statut_id ?? '') == $statut->id)>{{ $statut->nom }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('statut_id')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="entite_id" value="🏛️ Entité administrative" class="font-semibold" />
                    <select id="entite_id" name="entite_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une entité</option>
                        @foreach($entites as $entite)
                            <option value="{{ $entite->id }}" @selected(old('entite_id', $mariage->entite_id ?? '') == $entite->id)>
                                {{ $entite->nom }} ({{ $entite->type }})
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('entite_id')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION: ÉTAT CIVIL ET EMPREINTES -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <span>🔏</span> Documents & signatures
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <div>
    <x-input-label for="etat_civil_epoux" value="📄 État civil époux" class="font-semibold" />

    <select id="etat_civil_epoux" name="etat_civil_epoux"
        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required>

        <option value="">-- Sélectionner --</option>
        <option value="celibataire" {{ old('etat_civil_epoux', $mariage->etat_civil_epoux ?? '') == 'celibataire' ? 'selected' : '' }}>Célibataire</option>
        <option value="marie" {{ old('etat_civil_epoux', $mariage->etat_civil_epoux ?? '') == 'marie' ? 'selected' : '' }}>Marié</option>
        <option value="divorce" {{ old('etat_civil_epoux', $mariage->etat_civil_epoux ?? '') == 'divorce' ? 'selected' : '' }}>Divorcé</option>
        <option value="veuf" {{ old('etat_civil_epoux', $mariage->etat_civil_epoux ?? '') == 'veuf' ? 'selected' : '' }}>Veuf</option>
    </select>

    <x-input-error :messages="$errors->get('etat_civil_epoux')" class="mt-2" />
</div>

<div>
    <x-input-label for="etat_civil_epouse" value="📄 État civil épouse" class="font-semibold" />

    <select id="etat_civil_epouse" name="etat_civil_epouse"
        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required>

        <option value="">-- Sélectionner --</option>
        <option value="celibataire" {{ old('etat_civil_epouse', $mariage->etat_civil_epouse ?? '') == 'celibataire' ? 'selected' : '' }}>Célibataire</option>
        <option value="marie" {{ old('etat_civil_epouse', $mariage->etat_civil_epouse ?? '') == 'marie' ? 'selected' : '' }}>Mariée</option>
        <option value="divorce" {{ old('etat_civil_epouse', $mariage->etat_civil_epouse ?? '') == 'divorce' ? 'selected' : '' }}>Divorcée</option>
        <option value="veuf" {{ old('etat_civil_epouse', $mariage->etat_civil_epouse ?? '') == 'veuf' ? 'selected' : '' }}>Veuve</option>
    </select>

    <x-input-error :messages="$errors->get('etat_civil_epouse')" class="mt-2" />
</div>

                <div>
                    <x-input-label for="empreinte_epoux" value="🖐️ Empreinte époux" class="font-semibold" />
                    <x-text-input id="empreinte_epoux" name="empreinte_epoux" type="text" class="mt-1 block w-full rounded-lg" value="{{ old('empreinte_epoux', $mariage->empreinte_epoux ?? '') }}" autocomplete="off" placeholder="Numéro d'empreinte ou référence" />
                    <x-input-error :messages="$errors->get('empreinte_epoux')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="empreinte_epouse" value="🖐️ Empreinte épouse" class="font-semibold" />
                    <x-text-input id="empreinte_epouse" name="empreinte_epouse" type="text" class="mt-1 block w-full rounded-lg" value="{{ old('empreinte_epouse', $mariage->empreinte_epouse ?? '') }}" autocomplete="off" placeholder="Numéro d'empreinte ou référence" />
                    <x-input-error :messages="$errors->get('empreinte_epouse')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION: PHOTOS -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <span>📸</span> Galerie photos
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Photo époux -->
                <div>
                    <x-input-label for="photo_epoux" value="👨 Photo de l'époux" class="font-semibold" />
                    <input type="file" id="photo_epoux" name="photo_epoux" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
                           accept="image/*" 
                           onchange="previewImage(this, 'preview_epoux')">
                    
                    @if($mariage && $mariage->photo_epoux)
                        <div class="mt-3">
                            <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset($mariage->photo_epoux) }}" 
                                     alt="Photo époux actuelle" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-xs">Actuel</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div id="preview_epoux" class="mt-3 hidden">
                        <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                            <img src="" alt="Aperçu" class="w-full h-full object-cover">
                            <button type="button" onclick="clearPreview('preview_epoux', 'photo_epoux')" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ✕
                            </button>
                        </div>
                    </div>
                    
                    <x-input-error :messages="$errors->get('photo_epoux')" class="mt-2" />
                </div>

                <!-- Photo épouse -->
                <div>
                    <x-input-label for="photo_epouse" value="👩 Photo de l'épouse" class="font-semibold" />
                    <input type="file" id="photo_epouse" name="photo_epouse" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
                           accept="image/*"
                           onchange="previewImage(this, 'preview_epouse')">
                    
                    @if($mariage && $mariage->photo_epouse)
                        <div class="mt-3">
                            <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset($mariage->photo_epouse) }}" 
                                     alt="Photo épouse actuelle" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-xs">Actuel</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div id="preview_epouse" class="mt-3 hidden">
                        <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                            <img src="" alt="Aperçu" class="w-full h-full object-cover">
                            <button type="button" onclick="clearPreview('preview_epouse', 'photo_epouse')" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ✕
                            </button>
                        </div>
                    </div>
                    
                    <x-input-error :messages="$errors->get('photo_epouse')" class="mt-2" />
                </div>

                <!-- Photo couple -->
                <div>
                    <x-input-label for="photo_couple" value="💑 Photo du couple" class="font-semibold" />
                    <input type="file" id="photo_couple" name="photo_couple" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
                           accept="image/*"
                           onchange="previewImage(this, 'preview_couple')">
                    
                    @if($mariage && $mariage->photo_couple)
                        <div class="mt-3">
                            <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset($mariage->photo_couple) }}" 
                                     alt="Photo couple actuelle" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-xs">Actuel</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div id="preview_couple" class="mt-3 hidden">
                        <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                            <img src="" alt="Aperçu" class="w-full h-full object-cover">
                            <button type="button" onclick="clearPreview('preview_couple', 'photo_couple')" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ✕
                            </button>
                        </div>
                    </div>
                    
                    <x-input-error :messages="$errors->get('photo_couple')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        clearPreview(previewId, input.id);
    }
}

function clearPreview(previewId, inputId) {
    const preview = document.getElementById(previewId);
    const fileInput = document.getElementById(inputId);
    
    preview.classList.add('hidden');
    preview.querySelector('img').src = '';
    
    if (fileInput) {
        fileInput.value = '';
    }
}
</script>

<style>
/* Amélioration du style des selects */
.search-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    appearance: none;
    padding-right: 2.5rem;
}

.search-select:hover {
    border-color: #9ca3af;
}

/* Animation pour les aperçus photos */
#preview_epoux, #preview_epouse, #preview_couple {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>