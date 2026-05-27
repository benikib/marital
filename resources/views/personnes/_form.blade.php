    @php
        $personne = $personne ?? null;
        $initialStep = 1;

        $stepGroups = [
            1 => ['nom', 'prenom', 'postnom', 'sexe', 'etat_civil', 'date_naissance'],
            2 => ['lieu_naissance', 'adresse', 'profession', 'nationalite', 'cin', 'telephone'],
            3 => ['pere', 'mere', 'statut_vie', 'photo_base64'],
            4 => ['province_id', 'ville_id', 'district_id', 'territoire_id', 'secteur_id', 'localite_id'],
        ];

        foreach ($stepGroups as $index => $fields) {
            if ($errors->hasAny($fields)) {
                $initialStep = $index;
                break;
            }
        }
    @endphp

    <div x-data="{ step: {{ $initialStep }}, steps: 4 }" x-init="setTimeout(() => { const errorEl = $el.querySelector('ul.text-red-600'); if (errorEl) { const field = errorEl.previousElementSibling?.querySelector('input,select,textarea') || errorEl.closest('div')?.querySelector('input,select,textarea'); if (field) { field.focus(); } errorEl.scrollIntoView({ behavior: 'smooth', block: 'center' }); } }, 50)" x-cloak class="space-y-8">
        <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Étape <span x-text="step"></span> / <span x-text="steps"></span></p>
                        <h2 class="text-2xl font-semibold text-slate-900">Formulaire multi-étapes</h2>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <template x-for="index in steps" :key="index">
                            <div class="flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold"
                                :class="step >= index ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-slate-200 bg-slate-100 text-slate-500'">
                                <span x-text="index"></span>
                                <span x-text="index === 1 ? 'Perso' : index === 2 ? 'Contact' : index === 3 ? 'Famille' : 'Localisation'"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-200">
                    <div class="h-full rounded-full bg-blue-600 transition-all duration-500"
                        :style="`width: ${Math.round((step / steps) * 100)}%`"></div>
                </div>
            </div>

            <div class="relative min-h-[320px] overflow-hidden">
                <div x-show="step === 1"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-6"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-6"
                    class="space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <x-input-label for="nom" value="Nom" />
                            <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full"
                                value="{{ old('nom', $personne?->nom ?? '') }}" required />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="prenom" value="Prénom" />
                            <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full"
                                value="{{ old('prenom', $personne?->prenom ?? '') }}" required />
                            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="postnom" value="Postnom" />
                            <x-text-input id="postnom" name="postnom" type="text" class="mt-1 block w-full"
                                value="{{ old('postnom', $personne?->postnom ?? '') }}" />
                            <x-input-error :messages="$errors->get('postnom')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="sexe" value="Sexe" />
                            <select id="sexe" name="sexe" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">Sélectionnez</option>
                                <option value="M" @selected(old('sexe', $personne?->sexe) === 'M')>Masculin</option>
                                <option value="F" @selected(old('sexe', $personne?->sexe) === 'F')>Féminin</option>
                            </select>
                            <x-input-error :messages="$errors->get('sexe')" />
                        </div>
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
                        <div>
                            <x-input-label for="date_naissance" value="Date de naissance" />
                            <x-text-input type="date" name="date_naissance" class="mt-1 block w-full"
                                value="{{ old('date_naissance', $personne?->date_naissance?->format('Y-m-d')) }}" required />
                            <x-input-error :messages="$errors->get('date_naissance')" />
                        </div>
                    </div>
                </div>

                <div x-show="step === 2"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-6"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-6"
                    class="space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <x-input-label for="lieu_naissance" value="Lieu de naissance" />
                            <x-text-input name="lieu_naissance" class="mt-1 block w-full"
                                value="{{ old('lieu_naissance', $personne?->lieu_naissance) }}" required />
                            <x-input-error :messages="$errors->get('lieu_naissance')" />
                        </div>
                        <div>
                            <x-input-label for="adresse" value="Adresse" />
                            <x-text-input name="adresse" class="mt-1 block w-full"
                                value="{{ old('adresse', $personne?->adresse) }}" />
                            <x-input-error :messages="$errors->get('adresse')" />
                        </div>
                        <div>
                            <x-input-label for="profession" value="Profession" />
                            <x-text-input name="profession" class="mt-1 block w-full"
                                value="{{ old('profession', $personne?->profession) }}" />
                            <x-input-error :messages="$errors->get('profession')" />
                        </div>
                        <div>
                            <x-input-label for="nationalite" value="Nationalité" />
                            <x-text-input name="nationalite" class="mt-1 block w-full"
                                value="{{ old('nationalite', $personne?->nationalite) }}" required />
                            <x-input-error :messages="$errors->get('nationalite')" />
                        </div>
                        <div>
                            <x-input-label for="cin" value="CIN" />
                            <x-text-input name="cin" class="mt-1 block w-full"
                                value="{{ old('cin', $personne?->cin) }}" />
                            <x-input-error :messages="$errors->get('cin')" />
                        </div>
                        <div>
                            <x-input-label for="telephone" value="Téléphone" />
                            <x-text-input name="telephone" class="mt-1 block w-full"
                                value="{{ old('telephone', $personne?->telephone) }}" />
                            <x-input-error :messages="$errors->get('telephone')" />
                        </div>
                    </div>
                </div>

                <div x-show="step === 3"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-6"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-6"
                    class="space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <x-input-label for="pere" value="Père" />
                            <x-text-input name="pere" class="mt-1 block w-full"
                                value="{{ old('pere', $personne?->pere) }}" />
                            <x-input-error :messages="$errors->get('pere')" />
                        </div>
                        <div>
                            <x-input-label for="mere" value="Mère" />
                            <x-text-input name="mere" class="mt-1 block w-full"
                                value="{{ old('mere', $personne?->mere) }}" />
                            <x-input-error :messages="$errors->get('mere')" />
                        </div>
                        <div>
                            <x-input-label for="statut_vie" value="Statut de vie" />
                            <select name="statut_vie" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="en vie" @selected(old('statut_vie', $personne?->statut_vie) === 'en vie')>En vie</option>
                                <option value="décédé" @selected(old('statut_vie', $personne?->statut_vie) === 'décédé')>Décédé</option>
                            </select>
                            <x-input-error :messages="$errors->get('statut_vie')" />
                        </div>
                        <div class="md:col-span-2">
                            <x-photo-capture
                                name="photo_base64"
                                :value="$personne?->photo
                                    ? asset('storage/' . $personne->photo)
                                    : null"
                            />
                        </div>
                    </div>
                </div>

                <div x-show="step === 4"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-6"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-6"
                    class="space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <button type="button" x-on:click="step = Math.max(step - 1, 1)"
                    :disabled="step === 1"
                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50">
                    Retour
                </button>

                <div class="flex flex-wrap gap-3">
                    <button type="button" x-show="step < steps" x-on:click="step++"
                        class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Suivant
                    </button>
                    <button type="submit" x-show="step === steps"
                        class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>
