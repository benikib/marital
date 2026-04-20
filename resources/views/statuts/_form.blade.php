@php
    $statut = $statut ?? null;
@endphp

    <div>
        <x-input-label for="nom" value="Nom" />
        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" value="{{ old('nom', $statut->nom ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
    </div>
