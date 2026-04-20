@php
    $user = $user ?? null;
@endphp
    <div>
        <x-input-label for="name" value="Nom" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email ?? '') }}" required autocomplete="off" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    
        <div>
            <x-input-label for="role_id" value="Rôle" />
            <select id="role_id" name="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Sélectionnez un rôle</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                        {{ $role->nom }}
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />  
        </div>
        
        <div>
            <x-input-label for="entite_id" value="Entité Administrative" />
            <select id="entite_id" name="entite_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Sélectionnez une entité administrative</option>
                @foreach($entites as $entite)
                    <option value="{{ $entite->id }}" {{ old('entite_id', $user->entite_id ?? '') == $entite->id ? 'selected' : '' }}>
                        {{ $entite->nom }} ({{ $entite->type }})
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('entite_id')" class="mt-2" />
    <div>
