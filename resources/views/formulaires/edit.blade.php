@extends('layouts.agents.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Modifier le Mariage #{{ $mariage->id }}</h6>
                        <a href="{{ route('mariages.show', $mariage) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mariages.update', $mariage) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Onglets -->
                            <ul class="nav nav-tabs" id="mariageTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="epoux-tab" data-bs-toggle="tab"
                                        data-bs-target="#epoux" type="button" role="tab">
                                        <i class="fas fa-male me-2"></i>Époux
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="epouse-tab" data-bs-toggle="tab" data-bs-target="#epouse"
                                        type="button" role="tab">
                                        <i class="fas fa-female me-2"></i>Épouse
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="parents-epoux-tab" data-bs-toggle="tab"
                                        data-bs-target="#parents-epoux" type="button" role="tab">
                                        <i class="fas fa-users me-2"></i>Parents Époux
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="parents-epouse-tab" data-bs-toggle="tab"
                                        data-bs-target="#parents-epouse" type="button" role="tab">
                                        <i class="fas fa-users me-2"></i>Parents Épouse
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="temoins-tab" data-bs-toggle="tab" data-bs-target="#temoins"
                                        type="button" role="tab">
                                        <i class="fas fa-user-friends me-2"></i>Témoins
                                    </button>
                                </li>
                            </ul>

                            <!-- Contenu des onglets -->
                            <div class="tab-content p-3 border border-top-0 rounded-bottom" id="mariageTabsContent">
                                <!-- Onglet Époux -->
                                <div class="tab-pane fade show active" id="epoux" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_nom">Nom</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.nom') is-invalid @enderror"
                                                            id="epoux_nom" name="epoux[nom]"
                                                            value="{{ old('epoux.nom', $mariage->epoux->nom) }}">
                                                        @error('epoux.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_prenom">Prénom</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.prenom') is-invalid @enderror"
                                                            id="epoux_prenom" name="epoux[prenom]"
                                                            value="{{ old('epoux.prenom', $mariage->epoux->prenom) }}">
                                                        @error('epoux.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_postnom">Postnom</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.postnom') is-invalid @enderror"
                                                            id="epoux_postnom" name="epoux[postnom]"
                                                            value="{{ old('epoux.postnom', $mariage->epoux->postnom) }}">
                                                        @error('epoux.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_profession">Profession</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.profession') is-invalid @enderror"
                                                            id="epoux_profession" name="epoux[profession]"
                                                            value="{{ old('epoux.profession', $mariage->epoux->profession) }}">
                                                        @error('epoux.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_adresse">Adresse</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.adresse') is-invalid @enderror"
                                                            id="epoux_adresse" name="epoux[adresse]"
                                                            value="{{ old('epoux.adresse', $mariage->epoux->adresse) }}">
                                                        @error('epoux.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_district">District</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.district') is-invalid @enderror"
                                                            id="epoux_district" name="epoux[district]"
                                                            value="{{ old('epoux.district', $mariage->epoux->district) }}">
                                                        @error('epoux.district')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_province">Province</label>
                                                        {{-- <select
                                                            class="form-control @error('epoux.province') is-invalid @enderror"
                                                            id="epoux_province" name="epoux[province]">
                                                            <option value="">Sélectionnez une province</option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}"
                                                                    {{ old('epoux.province', $mariage->epoux->province_id) == $province->id ? 'selected' : '' }}>
                                                                    {{ $province->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}
                                                        @error('epoux.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_nationalite">Nationalité</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.nationalite') is-invalid @enderror"
                                                            id="epoux_nationalite" name="epoux[nationalite]"
                                                            value="{{ old('epoux.nationalite', $mariage->epoux->nationalite) }}">
                                                        @error('epoux.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_date_naissance">Date de naissance</label>
                                                        <input type="date"
                                                            class="form-control @error('epoux.date_naissance') is-invalid @enderror"
                                                            id="epoux_date_naissance" name="epoux[date_naissance]"
                                                            value="{{ old('epoux.date_naissance', $mariage->epoux->date_naissance) }}">
                                                        @error('epoux.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_lieu_naissance">Lieu de naissance</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.lieu_naissance') is-invalid @enderror"
                                                            id="epoux_lieu_naissance" name="epoux[lieu_naissance]"
                                                            value="{{ old('epoux.lieu_naissance', $mariage->epoux->lieu_naissance) }}">
                                                        @error('epoux.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_secteur">Secteur</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.secteur') is-invalid @enderror"
                                                            id="epoux_secteur" name="epoux[secteur]"
                                                            value="{{ old('epoux.secteur', $mariage->epoux->secteur) }}">
                                                        @error('epoux.secteur')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_territoire">Territoire</label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.territoire') is-invalid @enderror"
                                                            id="epoux_territoire" name="epoux[territoire]"
                                                            value="{{ old('epoux.territoire', $mariage->epoux->territoire) }}">
                                                        @error('epoux.territoire')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Épouse -->
                                <div class="tab-pane fade" id="epouse" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_nom">Nom</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.nom') is-invalid @enderror"
                                                            id="epouse_nom" name="epouse[nom]"
                                                            value="{{ old('epouse.nom', $mariage->epouse->nom) }}">
                                                        @error('epouse.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_prenom">Prénom</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.prenom') is-invalid @enderror"
                                                            id="epouse_prenom" name="epouse[prenom]"
                                                            value="{{ old('epouse.prenom', $mariage->epouse->prenom) }}">
                                                        @error('epouse.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_postnom">Postnom</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.postnom') is-invalid @enderror"
                                                            id="epouse_postnom" name="epouse[postnom]"
                                                            value="{{ old('epouse.postnom', $mariage->epouse->postnom) }}">
                                                        @error('epouse.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_profession">Profession</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.profession') is-invalid @enderror"
                                                            id="epouse_profession" name="epouse[profession]"
                                                            value="{{ old('epouse.profession', $mariage->epouse->profession) }}">
                                                        @error('epouse.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_adresse">Adresse</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.adresse') is-invalid @enderror"
                                                            id="epouse_adresse" name="epouse[adresse]"
                                                            value="{{ old('epouse.adresse', $mariage->epouse->adresse) }}">
                                                        @error('epouse.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_district">District</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.district') is-invalid @enderror"
                                                            id="epouse_district" name="epouse[district]"
                                                            value="{{ old('epouse.district', $mariage->epouse->district) }}">
                                                        @error('epouse.district')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_province">Province</label>
                                                        {{-- <select
                                                            class="form-control @error('epouse.province') is-invalid @enderror"
                                                            id="epouse_province" name="epouse[province]">
                                                            <option value="">Sélectionnez une province</option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}"
                                                                    {{ old('epouse.province', $mariage->epouse->province_id) == $province->id ? 'selected' : '' }}>
                                                                    {{ $province->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}
                                                        @error('epouse.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_nationalite">Nationalité</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.nationalite') is-invalid @enderror"
                                                            id="epouse_nationalite" name="epouse[nationalite]"
                                                            value="{{ old('epouse.nationalite', $mariage->epouse->nationalite) }}">
                                                        @error('epouse.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_date_naissance">Date de naissance</label>
                                                        <input type="date"
                                                            class="form-control @error('epouse.date_naissance') is-invalid @enderror"
                                                            id="epouse_date_naissance" name="epouse[date_naissance]"
                                                            value="{{ old('epouse.date_naissance', $mariage->epouse->date_naissance) }}">
                                                        @error('epouse.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_lieu_naissance">Lieu de naissance</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.lieu_naissance') is-invalid @enderror"
                                                            id="epouse_lieu_naissance" name="epouse[lieu_naissance]"
                                                            value="{{ old('epouse.lieu_naissance', $mariage->epouse->lieu_naissance) }}">
                                                        @error('epouse.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_secteur">Secteur</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.secteur') is-invalid @enderror"
                                                            id="epouse_secteur" name="epouse[secteur]"
                                                            value="{{ old('epouse.secteur', $mariage->epouse->secteur) }}">
                                                        @error('epouse.secteur')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_territoire">Territoire</label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.territoire') is-invalid @enderror"
                                                            id="epouse_territoire" name="epouse[territoire]"
                                                            value="{{ old('epouse.territoire', $mariage->epouse->territoire) }}">
                                                        @error('epouse.territoire')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Boutons de soumission -->
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialisation des tooltips Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Gestion des onglets
        document.addEventListener('DOMContentLoaded', function() {
            // Sauvegarder l'onglet actif dans le localStorage
            var triggerTabList = [].slice.call(document.querySelectorAll('#mariageTabs button'))
            triggerTabList.forEach(function(triggerEl) {
                triggerEl.addEventListener('shown.bs.tab', function(event) {
                    localStorage.setItem('lastActiveTab', event.target.id)
                })
            })

            // Restaurer l'onglet actif
            var lastActiveTab = localStorage.getItem('lastActiveTab')
            if (lastActiveTab) {
                var triggerEl = document.querySelector('#' + lastActiveTab)
                if (triggerEl) {
                    var tab = new bootstrap.Tab(triggerEl)
                    tab.show()
                }
            }
        })
    </script>
@endpush
