@props(['mariage' => null, 'epoux', 'epouses', 'status', 'regimes', 'ayantsDroit'])

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="epoux_id">Époux <span class="text-danger">*</span></label>
            <select name="epoux_id" id="epoux_id" class="form-control @error('epoux_id') is-invalid @enderror" required>
                <option value="">Sélectionnez l'époux</option>
                @foreach($epoux as $ep)
                    <option value="{{ $ep->id }}" {{ (old('epoux_id', $mariage?->epoux_id) == $ep->id) ? 'selected' : '' }}>
                        {{ $ep->nom }} {{ $ep->prenom }} {{ $ep->postnom }} - {{ $ep->province }}
                    </option>
                @endforeach
            </select>
            @error('epoux_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="epouse_id">Épouse <span class="text-danger">*</span></label>
            <select name="epouse_id" id="epouse_id" class="form-control @error('epouse_id') is-invalid @enderror"
                required>
                <option value="">Sélectionnez l'épouse</option>
                @foreach($epouses as $ep)
                    <option value="{{ $ep->id }}" {{ (old('epouse_id', $mariage?->epouse_id) == $ep->id) ? 'selected' : '' }}>
                        {{ $ep->nom }} {{ $ep->prenom }} {{ $ep->postnom }} - {{ $ep->province }}
                    </option>
                @endforeach
            </select>
            @error('epouse_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_mariage">Date du mariage <span class="text-danger">*</span></label>
            <input type="date" name="date_mariage" id="date_mariage"
                class="form-control @error('date_mariage') is-invalid @enderror"
                value="{{ old('date_mariage', $mariage?->date_mariage?->format('Y-m-d')) }}" required>
            @error('date_mariage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_mariage">Lieu du mariage <span class="text-danger">*</span></label>
            <input type="text" name="lieu_mariage" id="lieu_mariage"
                class="form-control @error('lieu_mariage') is-invalid @enderror"
                value="{{ old('lieu_mariage', $mariage?->lieu_mariage) }}" required>
            @error('lieu_mariage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status_id">Statut <span class="text-danger">*</span></label>
            <select name="status_id" id="status_id" class="form-control @error('status_id') is-invalid @enderror"
                required>
                <option value="">Sélectionnez le statut</option>
                @foreach($status as $s)
                    <option value="{{ $s->id }}" {{ (old('status_id', $mariage?->status_id) == $s->id) ? 'selected' : '' }}>
                        {{ $s->libelle }}
                    </option>
                @endforeach
            </select>
            @error('status_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="regime_matrimonial_id">Régime matrimonial <span class="text-danger">*</span></label>
            <select name="regime_matrimonial_id" id="regime_matrimonial_id"
                class="form-control @error('regime_matrimonial_id') is-invalid @enderror" required>
                <option value="">Sélectionnez le régime</option>
                @foreach($regimes as $regime)
                    <option value="{{ $regime->id }}" {{ (old('regime_matrimonial_id', $mariage?->regime_matrimonial_id) == $regime->id) ? 'selected' : '' }}>
                        {{ $regime->libelle }} ({{ $regime->contrat->libelle }})
                    </option>
                @endforeach
            </select>
            @error('regime_matrimonial_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="form-group">
            <label for="ayant_droit_coutinier_id">Ayant droit coutumier <span class="text-danger">*</span></label>
            <select name="ayant_droit_coutinier_id" id="ayant_droit_coutinier_id"
                class="form-control @error('ayant_droit_coutinier_id') is-invalid @enderror" required>
                <option value="">Sélectionnez l'ayant droit</option>
                @foreach($ayantsDroit as $ayant)
                    <option value="{{ $ayant->id }}" {{ (old('ayant_droit_coutinier_id', $mariage?->ayant_droit_coutinier_id) == $ayant->id) ? 'selected' : '' }}>
                        {{ $ayant->nom }} {{ $ayant->prenom }} {{ $ayant->postnom }} - {{ $ayant->profession }}
                    </option>
                @endforeach
            </select>
            @error('ayant_droit_coutinier_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            // Initialisation des select2 pour une meilleure expérience utilisateur
            $('#epoux_id, #epouse_id, #status_id, #regime_matrimonial_id, #ayant_droit_coutinier_id').select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        });
    </script>
@endpush
