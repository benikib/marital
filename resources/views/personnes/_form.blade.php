@php
    $personne = $personne ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    {{-- Nom --}}
    <div>
        <x-input-label for="nom" value="Nom" />
        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full"
            value="{{ old('nom', $personne?->nom ?? '') }}" required />
        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
    </div>

    {{-- Prénom --}}
    <div>
        <x-input-label for="prenom" value="Prénom" />
        <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full"
            value="{{ old('prenom', $personne?->prenom ?? '') }}" required />
        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
    </div>

    {{-- Postnom --}}
    <div>
        <x-input-label for="postnom" value="Postnom" />
        <x-text-input id="postnom" name="postnom" type="text" class="mt-1 block w-full"
            value="{{ old('postnom', $personne?->postnom ?? '') }}" />
        <x-input-error :messages="$errors->get('postnom')" class="mt-2" />
    </div>

    {{-- Sexe --}}
    <div>
        <x-input-label for="sexe" value="Sexe" />
        <select id="sexe" name="sexe" class="mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            <option value="M" @selected(old('sexe', $personne?->sexe) === 'M')>Masculin</option>
            <option value="F" @selected(old('sexe', $personne?->sexe) === 'F')>Féminin</option>
        </select>
        <x-input-error :messages="$errors->get('sexe')" />
    </div>

    {{-- Etat civil --}}
    <div>
        <x-input-label for="etat_civil" value="État civil" />
        <select name="etat_civil" class="mt-1 block w-full rounded-md border-gray-300">
            @foreach(['célibataire','marié','divorcé','veuf'] as $etat)
                <option value="{{ $etat }}" @selected(old('etat_civil', $personne?->etat_civil) === $etat)>
                    {{ ucfirst($etat) }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('etat_civil')" />
    </div>

    {{-- Date naissance --}}
    <div>
        <x-input-label for="date_naissance" value="Date de naissance" />
        <x-text-input type="date" name="date_naissance" class="mt-1 block w-full"
            value="{{ old('date_naissance', $personne?->date_naissance?->format('Y-m-d')) }}" required />
        <x-input-error :messages="$errors->get('date_naissance')" />
    </div>

    {{-- Lieu naissance --}}
    <div>
        <x-input-label for="lieu_naissance" value="Lieu de naissance" />
        <x-text-input name="lieu_naissance" class="mt-1 block w-full"
            value="{{ old('lieu_naissance', $personne?->lieu_naissance) }}" required />
        <x-input-error :messages="$errors->get('lieu_naissance')" />
    </div>

    {{-- Adresse --}}
    <div>
        <x-input-label for="adresse" value="Adresse" />
        <x-text-input name="adresse" class="mt-1 block w-full"
            value="{{ old('adresse', $personne?->adresse) }}" />
        <x-input-error :messages="$errors->get('adresse')" />
    </div>

    {{-- Profession --}}
    <div>
        <x-input-label for="profession" value="Profession" />
        <x-text-input name="profession" class="mt-1 block w-full"
            value="{{ old('profession', $personne?->profession) }}" />
        <x-input-error :messages="$errors->get('profession')" />
    </div>

    {{-- Nationalité --}}
    <div>
        <x-input-label for="nationalite" value="Nationalité" />
        <x-text-input name="nationalite" class="mt-1 block w-full"
            value="{{ old('nationalite', $personne?->nationalite) }}" required />
        <x-input-error :messages="$errors->get('nationalite')" />
    </div>

    {{-- CIN --}}
    <div>
        <x-input-label for="cin" value="CIN" />
        <x-text-input name="cin" class="mt-1 block w-full"
            value="{{ old('cin', $personne?->cin) }}" />
        <x-input-error :messages="$errors->get('cin')" />
    </div>

    {{-- Téléphone --}}
    <div>
        <x-input-label for="telephone" value="Téléphone" />
        <x-text-input name="telephone" class="mt-1 block w-full"
            value="{{ old('telephone', $personne?->telephone) }}" />
        <x-input-error :messages="$errors->get('telephone')" />
    </div>

    {{-- Père --}}
    <div>
        <x-input-label for="pere" value="Père" />
        <x-text-input name="pere" class="mt-1 block w-full"
            value="{{ old('pere', $personne?->pere) }}" />
        <x-input-error :messages="$errors->get('pere')" />
    </div>

    {{-- Mère --}}
    <div>
        <x-input-label for="mere" value="Mère" />
        <x-text-input name="mere" class="mt-1 block w-full"
            value="{{ old('mere', $personne?->mere) }}" />
        <x-input-error :messages="$errors->get('mere')" />
    </div>

    {{-- Statut vie --}}
    <div>
        <x-input-label for="statut_vie" value="Statut de vie" />
        <select name="statut_vie" class="mt-1 block w-full rounded-md border-gray-300">
            <option value="en vie" @selected(old('statut_vie', $personne?->statut_vie) === 'en vie')>En vie</option>
            <option value="décédé" @selected(old('statut_vie', $personne?->statut_vie) === 'décédé')>Décédé</option>
        </select>
        <x-input-error :messages="$errors->get('statut_vie')" />
    </div>
<x-photo-capture
    name="photo_base64"
    :value="$personne?->photo
        ? asset('storage/' . $personne->photo)
        : null"
/>

    {{-- Province --}}
    <div>
        <x-input-label for="province_id" value="Province" />
        <select name="province_id" class="search-select mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            @foreach($entites as $province)
                @if ($province->type == 'province')
                    <option value="{{ $province->id }}"
                        @selected(old('province_id', $personne?->province_id) == $province->id)>
                        {{ $province->nom }}
                    </option>
                @endif
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('province_id')" />
    </div>

    {{-- Ville --}}
    <div>
        <x-input-label for="ville_id" value="Ville" />
        <select name="ville_id" class="search-select mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            @foreach($entites as $ville)
                @if ($ville->type == 'ville')
                    <option value="{{ $ville->id }}"
                        @selected(old('ville_id', $personne?->ville_id) == $ville->id)>
                        {{ $ville->nom }}
                    </option>
                @endif
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('ville_id')" />
    </div>

    {{-- District --}}
    <div>
        <x-input-label for="district_id" value="District" />
        <select name="district_id" class="search-select mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            @foreach($entites as $district)
                @if ($district->type == 'district')
                    <option value="{{ $district->id }}"
                        @selected(old('district_id', $personne?->district_id) == $district->id)>
                        {{ $district->nom }}
                    </option>
                @endif
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('district_id')" />
    </div>

    {{-- Territoire --}}
    <div>
        <x-input-label for="territoire_id" value="Territoire" />
        <select name="territoire_id" class="search-select mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            @foreach($entites as $territoire)
                @if ($territoire->type == 'territoire')
                    <option value="{{ $territoire->id }}"
                        @selected(old('territoire_id', $personne?->territoire_id) == $territoire->id)>
                        {{ $territoire->nom }}
                    </option>
                @endif
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('territoire_id')" />
    </div>

    {{-- Secteur --}}
    <div>
        <x-input-label for="secteur_id" value="Secteur" />
        <select name="secteur_id" class="search-select mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            @foreach($entites as $secteur)
                @if ($secteur->type == 'secteur')
                    <option value="{{ $secteur->id }}"
                        @selected(old('secteur_id', $personne?->secteur_id) == $secteur->id)>
                        {{ $secteur->nom }}
                    </option>
                @endif
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('secteur_id')" />
    </div>

    {{-- Localité --}}
    <div>
        <x-input-label for="localite_id" value="Localité" />
        <select name="localite_id" class="search-select mt-1 block w-full rounded-md border-gray-300">
            <option value="">Sélectionnez</option>
            @foreach($entites as $localite)
                @if ($localite->type == 'localite')
                    <option value="{{ $localite->id }}"
                        @selected(old('localite_id', $personne?->localite_id) == $localite->id)>
                        {{ $localite->nom }}
                    </option>
                @endif
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('localite_id')" />
    </div>

</div>
