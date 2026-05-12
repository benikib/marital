@php
    $compositionFamiliale = $compositionFamiliale ?? null;
    $selectedEnfants = old('enfants', $compositionFamiliale?->enfants?->pluck('id')->toArray() ?? []);
@endphp

<div class="grid gap-6 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <x-input-label for="soussignataire" value="Soussignataire" />
        <x-text-input
            id="soussignataire"
            name="soussignataire"
            type="text"
            class="mt-1 block w-full rounded-2xl"
            :value="old('soussignataire', $compositionFamiliale?->soussignataire)"
            required
        />
        <x-input-error :messages="$errors->get('soussignataire')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="mariage_id" value="Mariage concerné" />
        <select id="mariage_id" name="mariage_id"
            class="search-select mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            required>
            <option value="">Sélectionner un mariage</option>
            @foreach($mariages as $mariage)
                <option value="{{ $mariage->id }}" @selected(old('mariage_id', $compositionFamiliale?->mariage_id) == $mariage->id)>
                    {{ $mariage->epoux->nom ?? '-' }} {{ $mariage->epoux->prenom ?? '' }}
                    &amp;
                    {{ $mariage->epouse->nom ?? '-' }} {{ $mariage->epouse->prenom ?? '' }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('mariage_id')" class="mt-2" />
    </div>

   

    <div class="lg:col-span-2">
        <x-input-label for="enfants" value="Enfants du foyer" />
        <select id="enfants" name="enfants[]"
            class="search-select mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            multiple>
            @foreach($personnes as $personne)
                <option value="{{ $personne->id }}" @selected(in_array($personne->id, $selectedEnfants))>
                    {{ $personne->nom }} {{ $personne->postnom }} {{ $personne->prenom }}
                </option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-gray-500">Astuce: utilisez Ctrl/Cmd + clic pour sélectionner plusieurs enfants.</p>
        <x-input-error :messages="$errors->get('enfants')" class="mt-2" />
    </div>

    

    <div>
        <x-input-label for="documents" value="Document justificatif" />
        <input
            id="documents"
            name="documents"
            type="file"
            accept=".pdf,.jpg,.jpeg,.png"
            class="mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
        @if($compositionFamiliale?->documents)
            <p class="mt-2 text-sm text-gray-600">
                Document actuel :
                <a href="{{ asset('storage/' . $compositionFamiliale->documents) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Voir le document</a>
            </p>
        @endif
        <x-input-error :messages="$errors->get('documents')" class="mt-2" />
    </div>
</div>

<div id="mariage-confirmation-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl border border-gray-200">
        <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Confirmer le mariage sélectionné</h3>
                <p class="text-sm text-gray-500">Vérifiez les informations avant de valider.</p>
            </div>
            <button type="button" id="mariage-modal-close" class="rounded-full bg-gray-100 p-2 text-gray-500 hover:bg-gray-200">✕</button>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-indigo-50 p-4">
                    <p class="text-sm text-gray-500">Époux</p>
                    <p id="modal-epoux" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
                <div class="rounded-3xl bg-pink-50 p-4">
                    <p class="text-sm text-gray-500">Épouse</p>
                    <p id="modal-epouse" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-sm text-gray-500">Date du mariage</p>
                    <p id="modal-date-mariage" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-sm text-gray-500">Lieu</p>
                    <p id="modal-lieu-mariage" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-sm text-gray-500">Régime</p>
                    <p id="modal-regime-mariage" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">
            <button type="button" id="mariage-modal-cancel" class="inline-flex w-full items-center justify-center rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 sm:w-auto">Annuler</button>
            <button type="button" id="mariage-modal-confirm" class="inline-flex w-full items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 sm:w-auto">Confirmer</button>
        </div>
    </div>
</div>

<div id="enfant-confirmation-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-xl overflow-hidden rounded-3xl bg-white shadow-2xl border border-gray-200">
        <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Confirmer l'enfant sélectionné</h3>
                <p class="text-sm text-gray-500">Confirmez l'ajout de cet enfant dans la composition familiale.</p>
            </div>
            <button type="button" id="enfant-modal-close" class="rounded-full bg-gray-100 p-2 text-gray-500 hover:bg-gray-200">✕</button>
        </div>
        <div class="p-6">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-indigo-50 p-4 sm:col-span-2">
                    <p class="text-sm text-gray-500">Nom complet</p>
                    <p id="modal-enfant-nom" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-sm text-gray-500">Sexe</p>
                    <p id="modal-enfant-sexe" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-sm text-gray-500">Date de naissance</p>
                    <p id="modal-enfant-date-naissance" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4 sm:col-span-2">
                    <p class="text-sm text-gray-500">Lieu de naissance</p>
                    <p id="modal-enfant-lieu-naissance" class="mt-2 text-base font-semibold text-gray-900">-</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">
            <button type="button" id="enfant-modal-cancel" class="inline-flex w-full items-center justify-center rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 sm:w-auto">Annuler</button>
            <button type="button" id="enfant-modal-confirm" class="inline-flex w-full items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 sm:w-auto">Confirmer</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mariageSelect = document.getElementById('mariage_id');
    const enfantsSelect = document.getElementById('enfants');

    const mariageModal = document.getElementById('mariage-confirmation-modal');
    const mariageFields = {
        epoux: document.getElementById('modal-epoux'),
        epouse: document.getElementById('modal-epouse'),
        date: document.getElementById('modal-date-mariage'),
        lieu: document.getElementById('modal-lieu-mariage'),
        regime: document.getElementById('modal-regime-mariage'),
    };

    const enfantModal = document.getElementById('enfant-confirmation-modal');
    const enfantFields = {
        nom: document.getElementById('modal-enfant-nom'),
        sexe: document.getElementById('modal-enfant-sexe'),
        date: document.getElementById('modal-enfant-date-naissance'),
        lieu: document.getElementById('modal-enfant-lieu-naissance'),
    };

    let previousMariageValue = mariageSelect ? (mariageSelect.value || '') : '';
    let pendingMariageValue = null;
    let lastEnfantsSelection = Array.from(enfantsSelect?.selectedOptions || []).map(opt => opt.value);
    let pendingEnfantId = null;

    function openMariageModal(data) {
        mariageFields.epoux.textContent = data.epoux?.full_name || '-';
        mariageFields.epouse.textContent = data.epouse?.full_name || '-';
        mariageFields.date.textContent = data.date_mariage || 'N/A';
        mariageFields.lieu.textContent = data.lieu_mariage || 'N/A';
        mariageFields.regime.textContent = data.regime || 'N/A';
        mariageModal.classList.remove('hidden');
    }

    function closeMariageModal() {
        mariageModal.classList.add('hidden');
    }

    function openEnfantModal(personne) {
        const nomComplet = `${personne.nom || ''} ${personne.postnom || ''} ${personne.prenom || ''}`.replace(/\s+/g, ' ').trim();
        enfantFields.nom.textContent = nomComplet || '-';
        enfantFields.sexe.textContent = personne.sexe || '-';
        enfantFields.date.textContent = personne.date_naissance || '-';
        enfantFields.lieu.textContent = personne.lieu_naissance || '-';
        enfantModal.classList.remove('hidden');
    }

    function closeEnfantModal() {
        enfantModal.classList.add('hidden');
    }

    if (mariageSelect) {
        mariageSelect.addEventListener('change', function () {
            const selectedValue = this.value;
            if (!selectedValue) {
                previousMariageValue = '';
                return;
            }

            pendingMariageValue = selectedValue;
            this.value = previousMariageValue;

            fetch(`/api/mariages/details?id=${selectedValue}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Impossible de charger les details du mariage.');
                }
                return response.json();
            })
            .then(data => openMariageModal(data))
            .catch(() => {
                pendingMariageValue = null;
                alert('Erreur lors du chargement du mariage.');
            });
        });
    }

    if (enfantsSelect) {
        enfantsSelect.addEventListener('change', function () {
            const currentSelection = Array.from(this.selectedOptions).map(opt => opt.value);
            const added = currentSelection.find(id => !lastEnfantsSelection.includes(id));

            if (!added) {
                lastEnfantsSelection = currentSelection;
                return;
            }

            pendingEnfantId = added;
            this.value = null;
            lastEnfantsSelection.forEach(id => {
                const option = this.querySelector(`option[value="${id}"]`);
                if (option) option.selected = true;
            });

            fetch(`/personnes/${added}/json`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Impossible de charger les details de la personne.');
                }
                return response.json();
            })
            .then(data => openEnfantModal(data))
            .catch(() => {
                pendingEnfantId = null;
                alert('Erreur lors du chargement des details de l enfant.');
            });
        });
    }

    document.getElementById('mariage-modal-close')?.addEventListener('click', function () {
        pendingMariageValue = null;
        closeMariageModal();
    });
    document.getElementById('mariage-modal-cancel')?.addEventListener('click', function () {
        pendingMariageValue = null;
        closeMariageModal();
    });
    document.getElementById('mariage-modal-confirm')?.addEventListener('click', function () {
        if (mariageSelect && pendingMariageValue !== null) {
            mariageSelect.value = pendingMariageValue;
            previousMariageValue = pendingMariageValue;
        }
        pendingMariageValue = null;
        closeMariageModal();
    });

    document.getElementById('enfant-modal-close')?.addEventListener('click', function () {
        pendingEnfantId = null;
        closeEnfantModal();
    });
    document.getElementById('enfant-modal-cancel')?.addEventListener('click', function () {
        pendingEnfantId = null;
        closeEnfantModal();
    });
    document.getElementById('enfant-modal-confirm')?.addEventListener('click', function () {
        if (enfantsSelect && pendingEnfantId) {
            const option = enfantsSelect.querySelector(`option[value="${pendingEnfantId}"]`);
            if (option) option.selected = true;
            lastEnfantsSelection = Array.from(enfantsSelect.selectedOptions).map(opt => opt.value);
        }
        pendingEnfantId = null;
        closeEnfantModal();
    });

    mariageModal?.addEventListener('click', function (event) {
        if (event.target === mariageModal) {
            pendingMariageValue = null;
            closeMariageModal();
        }
    });

    enfantModal?.addEventListener('click', function (event) {
        if (event.target === enfantModal) {
            pendingEnfantId = null;
            closeEnfantModal();
        }
    });
});
</script>
