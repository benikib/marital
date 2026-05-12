@php
    $veuvage = $veuvage ?? null;
@endphp

    {{-- soussignataire  --}}

<div>
    <x-input-label for="soussignataire" value="Soussignataire" />
    <x-text-input id="soussignataire" name="soussignataire" type="text" class="mt-1 block w-full"
        value="{{ old('soussignataire', $veuvage?->soussignataire ?? '') }}" required />
    <x-input-error :messages="$errors->get('soussignataire')" class="mt-2" />

    {{-- prénom et nom du titulaire --}}
    <div>
                    <x-input-label for="epoux_id" value="personne" class="font-semibold" />
                    <select id="epoux_id" name="personne_id" class="search-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une personne</option>
                        @foreach($personnes as $personne)
                            <option value="{{ $personne->id }}" @selected(old('personne_id', $veuvage ?->personne_id ?? '') == $personne->id)>
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
            value="{{ old('documents', $veuvage?->documents ?? '') }}" />   
    </div>

</div>

<div id="confirmationModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40">
    <div class="w-full max-w-3xl overflow-hidden rounded-2xl bg-white shadow-2xl">
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-900">Confirmer la personne sélectionnée</h2>
            <p class="mt-1 text-sm text-gray-500">Vérifiez les informations avant de valider votre choix.</p>
        </div>
        <div class="space-y-4 px-6 py-5 text-sm text-gray-700">
            <div id="modalPhoto" class="hidden mx-auto w-32 overflow-hidden rounded-xl border bg-gray-50">
                <img id="photoImg" src="" alt="Photo personne" class="h-32 w-full object-cover" />
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Nom complet</p>
                    <p id="modalFullName" class="mt-1 text-base font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Sexe / âge</p>
                    <p id="modalSexeAge" class="mt-1 text-base font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Sexe</p>
                    <p id="modalSexe" class="mt-1 text-base font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Date de naissance</p>
                    <p id="modalDateNaissance" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Lieu de naissance</p>
                    <p id="modalLieuNaissance" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Profession</p>
                    <p id="modalProfession" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Nationalité</p>
                    <p id="modalNationalite" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">État civil</p>
                    <p id="modalEtatCivil" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Statut de vie</p>
                    <p id="modalStatutVie" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">CIN</p>
                    <p id="modalCin" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Téléphone</p>
                    <p id="modalTelephone" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Adresse</p>
                    <p id="modalAdresse" class="mt-1 font-medium text-gray-900"></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Père</p>
                    <p id="modalPere" class="mt-1 font-medium text-gray-900"></p>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Mère</p>
                    <p id="modalMere" class="mt-1 font-medium text-gray-900"></p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 border-t px-6 py-4 sm:flex-row sm:justify-end">
            <button type="button" onclick="cancelSelection()" class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Annuler
            </button>
            <button type="button" onclick="confirmSelection()" class="inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                Confirmer cette personne
            </button>
        </div>
    </div>
</div>

<script>
let pendingSelectId = null;
let pendingSelectValue = null;
let previousSelectValue = null;

document.addEventListener('DOMContentLoaded', function() {
    const personSelects = document.querySelectorAll('#epoux_id, #epouse_id');
    personSelects.forEach(select => {
        select.dataset.previousValue = select.value || '';

        select.addEventListener('change', function() {
            if (this.value === '') {
                this.dataset.previousValue = '';
                return;
            }

            pendingSelectId = this.id;
            pendingSelectValue = this.value;
            previousSelectValue = this.dataset.previousValue || '';

            fetchPersonDetails(this.value);
            this.value = previousSelectValue;
        });
    });
});

async function fetchPersonDetails(personneId) {
    try {
        const url = `/personnes/${personneId}/json`;
        const response = await fetch(url, { credentials: 'same-origin' });
        if (!response.ok) {
            const text = await response.text();
            console.error('Erreur HTTP:', response.status, response.statusText, text);
            alert('Erreur: Impossible de charger les détails de la personne.');
            return;
        }

        const contentType = response.headers.get('content-type') || '';
        if (!contentType.includes('application/json')) {
            const text = await response.text();
            console.error('Réponse non JSON:', text);
            alert('Erreur: réponse inattendue du serveur.');
            return;
        }

        const data = await response.json();
        showConfirmationModalWithDetails(data);
    } catch (error) {
        console.error('Erreur réseau:', error);
        alert('Erreur réseau: ' + error.message);
    }
}

function showConfirmationModalWithDetails(personne) {
    const modal = document.getElementById('confirmationModal');
    if (!modal) return;

    const fullName = `${personne.prenom} ${personne.postnom || ''} ${personne.nom}`.trim();
    document.getElementById('modalFullName').textContent = fullName;

    const sexeLabel = personne.sexe === 'M' ? '👨 Homme' : '👩 Femme';
    const dateNaissance = personne.date_naissance ? new Date(personne.date_naissance) : null;
    const age = dateNaissance ? Math.floor((new Date() - dateNaissance) / (365.25 * 24 * 60 * 60 * 1000)) : null;
    document.getElementById('modalSexeAge').textContent = `${sexeLabel}${age ? ` • ${age} ans` : ''}`;

    if (personne.photo) {
        document.getElementById('photoImg').src = personne.photo;
        document.getElementById('modalPhoto').classList.remove('hidden');
    } else {
        document.getElementById('modalPhoto').classList.add('hidden');
    }

    document.getElementById('modalSexe').textContent = sexeLabel;
    document.getElementById('modalDateNaissance').textContent = personne.date_naissance || '-';
    document.getElementById('modalLieuNaissance').textContent = personne.lieu_naissance || '-';
    document.getElementById('modalProfession').textContent = personne.profession || '-';
    document.getElementById('modalNationalite').textContent = personne.nationalite || '-';
    document.getElementById('modalEtatCivil').textContent = personne.etat_civil || '-';
    document.getElementById('modalStatutVie').textContent = personne.statut_vie || '-';
    document.getElementById('modalCin').textContent = personne.cin || '-';
    document.getElementById('modalAdresse').textContent = personne.adresse || '-';
    document.getElementById('modalTelephone').textContent = personne.telephone || '-';
    document.getElementById('modalPere').textContent = personne.pere || '-';
    document.getElementById('modalMere').textContent = personne.mere || '-';

    modal.classList.remove('hidden');
}

function confirmSelection() {
    const modal = document.getElementById('confirmationModal');
    const select = document.getElementById(pendingSelectId);
    if (select) {
        select.value = pendingSelectValue;
        select.dataset.previousValue = pendingSelectValue;
    }
    if (modal) modal.classList.add('hidden');
    pendingSelectId = null;
    pendingSelectValue = null;
}

function cancelSelection() {
    const modal = document.getElementById('confirmationModal');
    const select = document.getElementById(pendingSelectId);
    if (select) {
        select.value = previousSelectValue || '';
        select.dataset.previousValue = previousSelectValue || '';
    }
    if (modal) modal.classList.add('hidden');
    pendingSelectId = null;
    pendingSelectValue = null;
}

function editSelectedPerson(selectId) {
    const select = document.getElementById(selectId);
    const personneId = select?.value;
    if (!personneId) {
        alert('Veuillez désormais sélectionner une personne avant de la modifier.');
        return;
    }
    window.open(`/personnes/${personneId}/edit`, '_blank');
}

document.addEventListener('click', function(e) {
    const modal = document.getElementById('confirmationModal');
    if (modal && e.target === modal) {
        cancelSelection();
    }
});
</script>
   
     

    