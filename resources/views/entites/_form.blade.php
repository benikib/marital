@php
    $entite = $entite ?? null;
@endphp
    <div>
        <x-input-label for="nom" value="Nom" />
        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" value="{{ old('nom', $entite->nom ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="type" value="Type" />
        <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" value="{{ old('type', $entite->type ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="parent_id" value="Parent" />
        <select id="parent_id" name="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Aucun</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $entite->parent_id ?? '') == $parent->id)>{{ $parent->nom }} ({{ $parent->type }})</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
    </div>
