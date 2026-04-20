@php
    $regime = $regime ?? null;
@endphp
    <div>
        <x-input-label for="dotation_coutumiere" value="Dotation coutumière" />
        <x-text-input id="dotation_coutumiere" name="dotation_coutumiere" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('dotation_coutumiere', $regime->dotation_coutumiere ?? '') }}" required />
        <x-input-error :messages="$errors->get('dotation_coutumiere')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="contrat_id" value="Contrat" />
        <select id="contrat_id" name="contrat_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            <option value="">Sélectionner un contrat</option>
            @foreach($contrats as $contrat)
                <option value="{{ $contrat->id }}" @selected(old('contrat_id', $regime->contrat_id ?? '') == $contrat->id)>{{ $contrat->nom }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('contrat_id')" class="mt-2" />
    </div>
