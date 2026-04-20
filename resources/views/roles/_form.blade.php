@php
    $role = $role ?? null;
@endphp
    <div>
        <x-input-label for="nom" value="Nom" />
        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" value="{{ old('nom', $role->nom ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Description" />
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description', $role->description ?? '') }}" autocomplete="off" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
