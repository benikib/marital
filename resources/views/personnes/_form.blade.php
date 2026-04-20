@php
    $personne = $personne ?? null;
@endphp
    <div>
        <x-input-label for="nom" value="Nom" />
        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" value="{{ old('nom', $personne?->nom ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="prenom" value="Prénom" />
        <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full" value="{{ old('prenom', $personne?->prenom ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="sexe" value="Sexe" />
        <select id="sexe" name="sexe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Sélectionnez</option>
            <option value="M" @selected(old('sexe', $personne?->sexe ?? '') === 'M')>M</option>
            <option value="F" @selected(old('sexe', $personne?->sexe ?? '') === 'F')>F</option>
        </select>
        <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="date_naissance" value="Date de naissance" />
        <x-text-input id="date_naissance" name="date_naissance" type="date" class="mt-1 block w-full" value="{{ old('date_naissance', $personne?->date_naissance?->format('Y-m-d') ?? '') }}" required />
        <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="lieu_naissance" value="Lieu de naissance" />
        <x-text-input id="lieu_naissance" name="lieu_naissance" type="text" class="mt-1 block w-full" value="{{ old('lieu_naissance', $personne?->lieu_naissance ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('lieu_naissance')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="adresse" value="Adresse" />
        <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full" value="{{ old('adresse', $personne?->adresse ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="profession" value="Profession" />
        <x-text-input id="profession" name="profession" type="text" class="mt-1 block w-full" value="{{ old('profession', $personne?->profession ?? '') }}" autocomplete="off" />
        <x-input-error :messages="$errors->get('profession')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="nationalite" value="Nationalité" />
        <x-text-input id="nationalite" name="nationalite" type="text" class="mt-1 block w-full" value="{{ old('nationalite', $personne?->nationalite ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('nationalite')" class="mt-2" />
    </div>


                     <div class="mb-4">
                        <x-input-label for="photo" value="Photo de la personne" />
                        <input type="file" id="photo" name="photo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" accept="image/*">
                    </div>
