@php
    $mariage = $mariage ?? null;
@endphp

<div class="space-y-8">
    
    <!-- MODAL DE CONFIRMATION -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4 sticky top-0">
                <h3 class="text-xl font-bold text-white" id="modalTitle">Confirmation de sélection</h3>
            </div>
            
            <div class="p-6">
                <!-- Photo et infos principales -->
                <div class="flex gap-6 mb-6">
                    <div id="modalPhoto" class="hidden">
                        <img id="photoImg" src="" alt="Photo" class="w-32 h-32 rounded-lg object-cover shadow-md">
                    </div>
                    <div class="flex-1">
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Vous sélectionnez :</p>
                            <p class="text-3xl font-bold text-indigo-600" id="modalFullName"></p>
                            <p class="text-gray-600 mt-2" id="modalSexeAge"></p>
                        </div>
                    </div>
                </div>

                <!-- Grille d'informations -->
                <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Sexe</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalSexe">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Date de naissance</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalDateNaissance">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Lieu de naissance</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalLieuNaissance">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Profession</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalProfession">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Nationalité</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalNationalite">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">État civil</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalEtatCivil">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Statut de vie</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalStatutVie">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">CIN</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalCin">-</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Adresse</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalAdresse">-</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Téléphone</p>
                        <p class="text-lg font-semibold text-gray-800" id="modalTelephone">-</p>
                    </div>
                </div>

                <!-- Informations familiales -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-sm font-bold text-gray-700 mb-3 uppercase">Informations familiales</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">Père</p>
                            <p class="text-lg font-semibold text-gray-800" id="modalPere">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">Mère</p>
                            <p class="text-lg font-semibold text-gray-800" id="modalMere">-</p>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex gap-3">
                    <button type="button" onclick="cancelSelection()" class="flex-1 px-4 py-3 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition">
                        ❌ Annuler
                    </button>
                    <button type="button" onclick="confirmSelection()" class="flex-1 px-4 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                        ✅ Confirmer la sélection
                    </button>
                </div>
            </div>
        </div>
    </div>
    
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
                    <select id="epoux_id" name="epoux_id" class="search-select mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white" required>
                        <option value="">Sélectionner un époux</option>
                        @foreach($personnes_epoux as $personne)
                            <option value="{{ $personne->id }}" @selected(old('epoux_id', $mariage->epoux_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <a href="{{ route('personnes.create') }}" target="_blank" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                            ➕ Créer une personne
                        </a>
                        <button type="button" onclick="editSelectedPerson('epoux_id')" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            ✏️ Modifier l’époux
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('epoux_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="epouse_id" value="👩 Épouse" class="font-semibold" />
                    <select id="epouse_id" name="epouse_id" class="search-select mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white" required>
                        <option value="">Sélectionner une épouse</option>
                        @foreach($personnes_epouse as $personne)
                            <option value="{{ $personne->id }}" @selected(old('epouse_id', $mariage->epouse_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <a href="{{ route('personnes.create') }}" target="_blank" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                            ➕ Créer une personne
                        </a>
                        <button type="button" onclick="editSelectedPerson('epouse_id')" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            ✏️ Modifier l’épouse
                        </button>
                    </div>
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
                    <select id="regime_id" name="regime_id" class="search-select mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white" required>
                        <option value="">Sélectionner un régime</option>
                        @foreach($regimes as $regime)
                            <option value="{{ $regime->id }}" @selected(old('regime_id', $mariage->regime_id ?? '') == $regime->id)>
                                {{ $regime->contrat->nom ?? 'Contrat inconnu' }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('regime_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="statut_id" value="📌 Statut du mariage" class="font-semibold" />
                    <select id="statut_id" name="statut_id" class="search-select mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white" required>
                        <option value="">Sélectionner un statut</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut->id }}" @selected(old('statut_id', $mariage->statut_id ?? '') == $statut->id)>{{ $statut->nom }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('statut_id')" class="mt-2" />
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
        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white"
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
        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white"
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

<div id="confirmationModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40">
    <div class="w-full max-w-3xl overflow-hidden rounded-2xl bg-white shadow-2xl">
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-900">Confirmer la personne sélectionnée</h2>
            <p class="mt-1 text-sm text-gray-500">Vérifiez les informations avant de valider votre choix.</p>
        </div>
        <div class="space-y-4 px-6 py-5 text-sm text-gray-700">
            <div id="modalPhoto" class="hidden mx-auto w-32 overflow-hidden rounded-xl border bg-gray-50">
                <img id="photoImg" src="" alt="Photo personne" class="h-32 w-full object-cover" />
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Nom complet</p>
                    <p id="modalFullName" class="mt-1 text-base font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Sexe / âge</p>
                    <p id="modalSexeAge" class="mt-1 text-base font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Sexe</p>
                    <p id="modalSexe" class="mt-1 text-base font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Date de naissance</p>
                    <p id="modalDateNaissance" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Lieu de naissance</p>
                    <p id="modalLieuNaissance" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Profession</p>
                    <p id="modalProfession" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Nationalité</p>
                    <p id="modalNationalite" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">État civil</p>
                    <p id="modalEtatCivil" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Statut de vie</p>
                    <p id="modalStatutVie" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">CIN</p>
                    <p id="modalCin" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Téléphone</p>
                    <p id="modalTelephone" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Adresse</p>
                    <p id="modalAdresse" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Père</p>
                    <p id="modalPere" class="mt-1 font-medium text-gray-900"></p>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Mère</p>
                    <p id="modalMere" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 border-t px-6 py-4 sm:flex-row sm:justify-end">
            <button type="button" onclick="cancelSelection()" class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Annuler
            </button>
            <button type="button" onclick="confirmSelection()" class="inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                Confirmer cette personne
            </button>
        </div>
    </div>
</div>

<script>
// Variables globales pour la confirmation
let pendingSelectId = null;
let pendingSelectValue = null;
let previousSelectValue = null;

// Initialisation des selects de personnes avec modal de confirmation
document.addEventListener('DOMContentLoaded', function() {
    // Seulement pour les selects de sélection de personnes (époux et épouse)
    const personSelects = document.querySelectorAll('#epoux_id, #epouse_id');
    
    personSelects.forEach(select => {
        select.dataset.previousValue = select.value || '';

        select.addEventListener('change', function() {
            if (this.value === '') {
                this.dataset.previousValue = '';
                return;
            }
            
            pendingSelectId = this.id;
            pendingSelectValue = this.value;
            previousSelectValue = this.dataset.previousValue || '';
            
            // Récupérer les détails complets de la personne via l'API
            fetchPersonDetails(this.value);
            
            // Réinitialiser le select en attendant la confirmation
            this.value = previousSelectValue;
        });
    });
});

// Récupérer les détails complets de la personne
async function fetchPersonDetails(personneId) {
    console.log('Récupération des détails pour ID:', personneId);
    try {
        const url = `/personnes/${personneId}/json`;
        console.log('URL d\'appel:', url);
        
        const response = await fetch(url, { credentials: 'same-origin' });
        console.log('Réponse status:', response.status, response.headers.get('content-type'));
        
        if (!response.ok) {
            console.error('Erreur HTTP:', response.status, response.statusText);
            const text = await response.text();
            console.error('Response HTML/Text:', text);
            alert('Erreur: Impossible de charger les détails de la personne (Erreur ' + response.status + ')');
            return;
        }

        const contentType = response.headers.get('content-type') || '';
        if (!contentType.includes('application/json')) {
            const text = await response.text();
            console.error('Réponse non JSON:', text);
            alert('Erreur: réponse inattendue du serveur');
            return;
        }
        
        const data = await response.json();
        console.log('Données reçues:', data);
        
        showConfirmationModalWithDetails(data);
    } catch (error) {
        console.error('Erreur complète:', error);
        alert('Erreur réseau: ' + error.message);
    }
}

// Afficher le modal avec tous les détails
function showConfirmationModalWithDetails(personne) {
    const modal = document.getElementById('confirmationModal');
    
    // Nom complet
    const fullName = `${personne.prenom} ${personne.postnom || ''} ${personne.nom}`.trim();
    document.getElementById('modalFullName').textContent = fullName;
    
    // Sexe et âge
    const sexeLabel = personne.sexe === 'M' ? '👨 Homme' : '👩 Femme';
    const dateNaissance = personne.date_naissance ? new Date(personne.date_naissance) : null;
    const age = dateNaissance ? Math.floor((new Date() - dateNaissance) / (365.25 * 24 * 60 * 60 * 1000)) : null;
    document.getElementById('modalSexeAge').textContent = `${sexeLabel}${age ? ` • ${age} ans` : ''}`;
    
    // Photo
    if (personne.photo) {
        document.getElementById('photoImg').src = personne.photo;
        document.getElementById('modalPhoto').classList.remove('hidden');
    } else {
        document.getElementById('modalPhoto').classList.add('hidden');
    }
    
    // Détails personnels
    document.getElementById('modalSexe').textContent = sexeLabel;
    document.getElementById('modalDateNaissance').textContent = personne.date_naissance || '-';
    document.getElementById('modalLieuNaissance').textContent = personne.lieu_naissance || '-';
    document.getElementById('modalProfession').textContent = personne.profession || '-';
    document.getElementById('modalNationalite').textContent = personne.nationalite || '-';
    document.getElementById('modalEtatCivil').textContent = personne.etat_civil || '-';
    document.getElementById('modalStatutVie').textContent = personne.statut_vie || '-';
    document.getElementById('modalCin').textContent = personne.cin || '-';
    document.getElementById('modalAdresse').textContent = personne.adresse || '-';
    document.getElementById('modalTelephone').textContent = personne.telephone || '-';
    
    // Informations familiales
    document.getElementById('modalPere').textContent = personne.pere || '-';
    document.getElementById('modalMere').textContent = personne.mere || '-';
    
    // Afficher le modal
    modal.classList.remove('hidden');
}

function confirmSelection() {
    const modal = document.getElementById('confirmationModal');
    const select = document.getElementById(pendingSelectId);
    
    if (select) {
        select.value = pendingSelectValue;
        select.dataset.previousValue = pendingSelectValue;
    }
    
    modal.classList.add('hidden');
    pendingSelectId = null;
    pendingSelectValue = null;
}

function cancelSelection() {
    const modal = document.getElementById('confirmationModal');
    const select = document.getElementById(pendingSelectId);
    
    if (select) {
        select.value = previousSelectValue || '';
        select.dataset.previousValue = previousSelectValue || '';
    }
    
    modal.classList.add('hidden');
    pendingSelectId = null;
    pendingSelectValue = null;
}

function editSelectedPerson(selectId) {
    const select = document.getElementById(selectId);
    const personneId = select?.value;

    if (!personneId) {
        alert('Veuillez d\u00e9sormais s\u00e9lectionner une personne avant de la modifier.');
        return;
    }

    window.open(`/personnes/${personneId}/edit`, '_blank');
}

// Fermer le modal en cliquant en dehors
document.addEventListener('click', function(e) {
    const modal = document.getElementById('confirmationModal');
    if (e.target === modal) {
        cancelSelection();
    }
});

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
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    cursor: pointer;
}

.search-select:hover {
    border-color: #9ca3af;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.search-select:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.ts-wrapper.single .ts-control {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.ts-wrapper.single.focus .ts-control {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
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