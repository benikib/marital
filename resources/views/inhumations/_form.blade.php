@php
    $inhumation = $inhumation ?? null;
@endphp

    {{-- soussignataire  --}}

<div>
    <x-input-label for="soussignataire" value="Soussignataire" />
    <x-text-input id="soussignataire" name="soussignataire" type="text" class="mt-1 block w-full"
        value="{{ old('soussignataire', $inhumation?->soussignataire ?? '') }}" required />
    <x-input-error :messages="$errors->get('soussignataire')" class="mt-2" />

    {{-- prénom et nom du titulaire --}}
    <div>
                    <x-input-label for="epoux_id" value="personne" class="font-semibold" />
                    <select id="epoux_id" name="personne_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une personne</option>
                        @foreach($personnes as $personne)
                            <option value="{{ $personne->id }}" @selected(old('personne_id', $inhumation?->personne_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}  {{ $personne->postnom }}({{ $personne->date_naissance->format('Y-m-d') }}) - {{ $personne->sexe }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('personne_id')" class="mt-2" />
                </div>

   
                <div>
                    
                    <x-input-label for="residence_temporaire" value="Résidence temporaire" />
                    <x-text-input id="residence_temporaire" name="residence_temporaire" type="text" class="mt-1 block w-full"
                        value="{{ old('residence_temporaire', $inhumation?->residence_temporaire ?? '') }}" required />
                    <x-input-error :messages="$errors->get('residence_temporaire')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="lieu_inhumation" value="Lieu d'inhumation" />
                    <x-text-input id="lieu_inhumation" name="lieu_inhumation" type="text" class="mt-1 block w-full"
                        value="{{ old('lieu_inhumation', $inhumation?->lieu_inhumation ?? '') }}" required />   
                    <x-input-error :messages="$errors->get('lieu_inhumation')" class="mt-2" />

                </div>

                <div>
                    <x-input-label for="date_inhumation" value="Date d'inhumation" />
                    <x-text-input id="date_inhumation" name="date_inhumation" type="date" class="mt-1 block w-full"
                        value="{{ old('date_inhumation', $inhumation?->date_inhumation ?? '') }}" required />   
                    <x-input-error :messages="$errors->get('date_inhumation')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="cimetiere" value="Cimetière" />
                    <x-text-input id="cimetiere" name="cimetiere" type="text" class="mt-1 block w-full"
                        value="{{ old('cimetiere', $inhumation?->cimetiere ?? '') }}" required />   
                    <x-input-error :messages="$errors->get('cimetiere')" class="mt-2" />
    
    <div>
        <x-input-label for="documents" value="Documents fournis" />
        <x-text-input id="documents" name="documents" type="file " class="mt-1 block w-full"
            value="{{ old('documents', $inhumation?->documents ?? '') }}" />   
    </div>
   
     

    