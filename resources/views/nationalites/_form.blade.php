@php
    $nationalite = $nationalite ?? null;
@endphp

    {{-- soussignataire  --}}

<div>
    <x-input-label for="soussignataire" value="Soussignataire" />
    <x-text-input id="soussignataire" name="soussignataire" type="text" class="mt-1 block w-full"
        value="{{ old('soussignataire', $nationalite?->soussignataire ?? '') }}" required />
    <x-input-error :messages="$errors->get('soussignataire')" class="mt-2" />

    {{-- prénom et nom du titulaire --}}
    <div>
                    <x-input-label for="epoux_id" value="personne" class="font-semibold" />
                    <select id="epoux_id" name="personne_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une personne</option>
                        @foreach($personnes as $personne)
                            <option value="{{ $personne->id }}" @selected(old('personne_id', $nationalite?->personne_id ?? '') == $personne->id)>
                                {{ $personne->nom }} {{ $personne->prenom }}  {{ $personne->postnom }}({{ $personne->date_naissance->format('Y-m-d') }}) - {{ $personne->sexe }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('personne_id')" class="mt-2" />
                </div>

   
    <div>
        <x-input-label for="residence" value="Résidence" />
        <x-text-input id="residence" name="residence" type="text" class="mt-1 block w-full"
            value="{{ old('residence', $nationalite?->residence ?? '') }}" required />
        <x-input-error :messages="$errors->get('residence')" class="mt-2" />
    </div>
    <input type="hidden" name="motif" value="Demande de nationalité">

    <div>
        <x-input-label for="nationalite_pere" value="Nationalité du père" />
        <x-text-input id="nationalite_pere" name="nationalite_pere" type="text" class="mt-1 block w-full"
            value="{{ old('nationalite_pere', $nationalite?->nationalite_pere ?? '') }}" />
        <x-input-error :messages="$errors->get('nationalite_pere')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="nationalite_mere" value="Nationalité de la mère" />
        <x-text-input id="nationalite_mere" name="nationalite_mere" type="text" class="mt-1 block w-full"
            value="{{ old('nationalite_mere', $nationalite?->nationalite_mere ?? '') }}" />
        <x-input-error :messages="$errors->get('nationalite_mere')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="documents" value="Documents fournis" />
        <x-text-input id="documents" name="documents" type="file " class="mt-1 block w-full"
            value="{{ old('documents', $nationalite?->documents ?? '') }}" />   
    </div>
    <div>
        <x-input-label for="quittance" value="Quittance payée" />
        <x-text-input id="quittance" name="quittance" type="text" class="mt-1 block w-full"
            value="{{ old('quittance', $nationalite?->quittance ?? '') }}" required />
        <x-input-error :messages="$errors->get('quittance')" class="mt-2" />
    </div>
     

    