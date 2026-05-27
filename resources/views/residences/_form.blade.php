@php
    $naissance = $naissance ?? null;
@endphp

    {{-- soussignataire  --}}

<div>
    <x-input-label for="soussignataire" value="Soussignataire" />
    <x-text-input id="soussignataire" name="soussignataire" type="text" class="mt-1 block w-full"
        value="{{ old('soussignataire', $naissance?->soussignataire ?? '') }}" required />
    <x-input-error :messages="$errors->get('soussignataire')" class="mt-2" />

    {{-- prénom et nom du titulaire --}}
    <div>
                    <x-input-label for="epoux_id" value="personne" class="font-semibold" />
                    <select id="epoux_id" name="personne_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une personne</option>
                        @foreach($personnes as $personne)
                            <option value="{{ $personne->id }}" @selected(old('personne_id', $naissance ?->personne_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}  {{ $personne->postnom }}({{ $personne->date_naissance->format('Y-m-d') }}) - {{ $personne->sexe }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <a href="{{ route('personnes.create') }}" target="_blank" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                            ➕ Créer une personne
                        </a>
                        <button type="button" onclick="editSelectedPerson('epoux_id')" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            ✏️ Modifier la personne
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('personne_id')" class="mt-2" />
                </div>

   

    
    <div>
        <x-input-label for="documents" value="Documents fournis" />
        <x-text-input id="documents" name="documents" type="file " class="mt-1 block w-full"
            value="{{ old('documents', $naissance?->documents ?? '') }}" />   
    </div>

</div>

    @include('personnes._modal')
   
     

    