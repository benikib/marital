@php
    $divorce = $divorce ?? null;
@endphp

<div class="grid gap-6 lg:grid-cols-2">
    <!-- Mariage -->
    <div>
        <x-input-label for="mariage_id" value="Mariage concerné" class="font-semibold" />

        <select id="mariage_id" name="mariage_id"
            class="search-select mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            required>
            <option value="">Sélectionner un mariage</option>
            @foreach($mariages as $mariage)
                <option value="{{ $mariage->id }}"
                    @selected(old('mariage_id', $selectedMariageId ?? $divorce?->mariage_id) == $mariage->id)>
                    {{ $mariage->epoux->nom ?? '-' }} {{ $mariage->epoux->prenom ?? '' }} &amp; {{ $mariage->epouse->nom ?? '-' }} {{ $mariage->epouse->prenom ?? '' }}
                    (Marié le {{ $mariage->date_mariage?->format('d/m/Y') }})
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('mariage_id')" class="mt-2" />
    </div>

    <!-- Modal de confirmation du mariage -->
    <div id="mariage-confirmation-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl border border-gray-200">
            <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Confirmer le mariage sélectionné</h3>
                    <p class="text-sm text-gray-500">Vérifiez les informations avant de créer l’acte de divorce.</p>
                </div>
                <button type="button" id="mariage-modal-close" class="rounded-full bg-gray-100 p-2 text-gray-500 hover:bg-gray-200">✕</button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-red-50 p-4">
                        <p class="text-sm text-gray-500">Ancien époux</p>
                        <p id="modal-epoux" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                    <div class="rounded-3xl bg-pink-50 p-4">
                        <p class="text-sm text-gray-500">Ancienne épouse</p>
                        <p id="modal-epouse" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-500">Date du mariage</p>
                        <p id="modal-date" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-500">Lieu</p>
                        <p id="modal-lieu" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-500">Régime</p>
                        <p id="modal-regime" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-500">Entité</p>
                        <p id="modal-entite" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-500">Statut du mariage</p>
                        <p id="modal-statut" class="mt-2 text-base font-semibold text-gray-900">-</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">
                <button type="button" id="mariage-modal-cancel" class="inline-flex w-full items-center justify-center rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-100 sm:w-auto">Annuler la sélection</button>
                <button type="button" id="mariage-modal-confirm" class="inline-flex w-full items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:w-auto">Confirmer ce mariage</button>
            </div>
        </div>
    </div>

    <!-- Date du divorce -->
    <div>
        <x-input-label for="date_divorce" value="Date du divorce" />
        <x-text-input
            id="date_divorce"
            name="date_divorce"
            type="date"
            class="mt-1 block w-full rounded-2xl"
            :value="old('date_divorce', $divorce?->date_divorce?->format('Y-m-d'))"
            required
        />
        <x-input-error :messages="$errors->get('date_divorce')" class="mt-2" />
    </div>

    <!-- Tribunal -->
    <div>
        <x-input-label for="divorce_rendu" value="Tribunal" />
        <x-text-input
            id="divorce_rendu"
            name="divorce_rendu"
            type="text"
            class="mt-1 block w-full rounded-2xl"
            :value="old('divorce_rendu', $divorce?->divorce_rendu ?? 'Tribunal de paix')"
            required
        />
        <x-input-error :messages="$errors->get('divorce_rendu')" class="mt-2" />
    </div>

    <!-- Entité -->
    {{-- <div>
        <x-input-label for="entite_id" value="Entité d'enregistrement" />
        <select id="entite_id" name="entite_id"
            class="mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            required>
            <option value="">Sélectionner une entité</option>
            @foreach($entites as $entite)
                <option value="{{ $entite->id }}"
                    @selected(old('entite_id', $divorce?->entite_id ?? auth()->user()->entite_id) == $entite->id)>
                    {{ $entite->nom }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('entite_id')" class="mt-2" />
    </div> --}}

    <!-- Date transcription -->
    <div>
        <x-input-label for="date_transcription" value="Date de transcription" />
        <x-text-input
            id="date_transcription"
            name="date_transcription"
            type="date"
            class="mt-1 block w-full rounded-2xl"
            :value="old('date_transcription', $divorce?->date_transcription?->format('Y-m-d'))"
        />
        <x-input-error :messages="$errors->get('date_transcription')" class="mt-2" />
    </div>

    <!-- Date jugement -->
    <div>
        <x-input-label for="date_jugement" value="Date du jugement" />
        <x-text-input
            id="date_jugement"
            name="date_jugement"
            type="date"
            class="mt-1 block w-full rounded-2xl"
            :value="old('date_jugement', $divorce?->date_jugement?->format('Y-m-d'))"
        />
        <x-input-error :messages="$errors->get('date_jugement')" class="mt-2" />
    </div>

    <!-- Numéro jugement -->
    <div>
        <x-input-label for="numero_jugement" value="Numéro du jugement" />
        <x-text-input
            id="numero_jugement"
            name="numero_jugement"
            type="text"
            class="mt-1 block w-full rounded-2xl"
            :value="old('numero_jugement', $divorce?->numero_jugement)"
        />
        <x-input-error :messages="$errors->get('numero_jugement')" class="mt-2" />
    </div>

    <!-- Mentions complémentaires -->
    <div class="lg:col-span-2">
        <x-input-label for="mentions_complementaire" value="Mentions complémentaires" />
        <textarea
            id="mentions_complementaire"
            name="mentions_complementaire"
            rows="3"
            class="mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        >{{ old('mentions_complementaire', $divorce?->mentions_complementaire) }}</textarea>
        <x-input-error :messages="$errors->get('mentions_complementaire')" class="mt-2" />
    </div>

    <!-- Documents -->
    <div class="lg:col-span-2">
        <x-input-label for="documents" value="Documents fournis" />
        <input
            id="documents"
            name="documents"
            type="file"
            accept=".pdf,.jpg,.jpeg,.png"
            class="mt-1 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
        @if($divorce?->documents)
            <p class="mt-2 text-sm text-gray-600">
                Document actuel :
                <a href="{{ asset('storage/' . $divorce->documents) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Voir le document</a>
            </p>
        @endif
        <x-input-error :messages="$errors->get('documents')" class="mt-2" />
    </div>

    <!-- Soussignataire -->
    <div class="lg:col-span-2">
        <x-input-label for="soussignataire" value="Soussignataire" />
        <x-text-input
            id="soussignataire"
            name="soussignataire"
            type="text"
            class="mt-1 block w-full rounded-2xl"
            :value="old('soussignataire', $divorce?->soussignataire)"
            required
        />
        <x-input-error :messages="$errors->get('soussignataire')" class="mt-2" />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mariageSelect = document.getElementById('mariage_id');
        const modal = document.getElementById('mariage-confirmation-modal');
        const modalClose = document.getElementById('mariage-modal-close');
        const modalCancel = document.getElementById('mariage-modal-cancel');
        const modalConfirm = document.getElementById('mariage-modal-confirm');
        const fields = {
            epoux: document.getElementById('modal-epoux'),
            epouse: document.getElementById('modal-epouse'),
            date: document.getElementById('modal-date'),
            lieu: document.getElementById('modal-lieu'),
            regime: document.getElementById('modal-regime'),
            entite: document.getElementById('modal-entite'),
            statut: document.getElementById('modal-statut'),
        };

        let previousValue = mariageSelect.value || '';

        function openModal(data) {
            fields.epoux.textContent = data.epoux && data.epoux.full_name ? data.epoux.full_name : '-';
            fields.epouse.textContent = data.epouse && data.epouse.full_name ? data.epouse.full_name : '-';
            fields.date.textContent = data.date_mariage || 'N/A';
            fields.lieu.textContent = data.lieu_mariage || 'N/A';
            fields.regime.textContent = data.regime || 'N/A';
            fields.entite.textContent = data.entite || 'N/A';
            fields.statut.textContent = data.statut || 'N/A';
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        mariageSelect.addEventListener('change', function () {
            const selectedValue = this.value;
            if (!selectedValue) {
                previousValue = this.value;
                return;
            }

            // Faire un appel API pour récupérer les détails du mariage
            console.log('Fetching marriage details for ID:', selectedValue);
            fetch(`/api/mariages/details?id=${selectedValue}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                if (!response.ok) {
                    if (response.status === 401) {
                        throw new Error('Vous devez être connecté pour accéder à cette fonctionnalité.');
                    } else if (response.status === 404) {
                        throw new Error('Mariage non trouvé.');
                    } else {
                        throw new Error('Erreur du serveur: ' + response.status);
                    }
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                if (data.error) {
                    alert('Erreur: ' + data.error);
                    mariageSelect.value = previousValue;
                    return;
                }
                openModal(data);
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des détails du mariage:', error);
                alert('Erreur: ' + error.message);
                mariageSelect.value = previousValue;
            });
        });

        modalClose.addEventListener('click', function () {
            mariageSelect.value = previousValue;
            closeModal();
        });

        modalCancel.addEventListener('click', function () {
            mariageSelect.value = previousValue;
            closeModal();
        });

        modalConfirm.addEventListener('click', function () {
            previousValue = mariageSelect.value;
            closeModal();
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                mariageSelect.value = previousValue;
                closeModal();
            }
        });
    });
</script>

