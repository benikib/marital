@extends('layouts.app')

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
                        <form action="{{ route('mariages.update', $mariage) }}" method="POST" enctype="multipart/form-data">
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
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ayantdroit-tab" data-bs-toggle="tab"
                                        data-bs-target="#ayantdroit" type="button" role="tab">
                                        <i class="fas fa-user-friends me-2"></i>Ayant Droit
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="regime-tab" data-bs-toggle="tab" data-bs-target="#regime" type="button" role="tab">
                                        <i class="fas fa-handshake me-2"></i>Régime matrimonial
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
                                                        <input type="text"
                                                            class="form-control @error('epoux.province') is-invalid @enderror"
                                                            id="epoux_province" name="epoux[province]"
                                                            value="{{ old('epoux.province', $mariage->epoux->province) }}">
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
                                                        <input type="text"
                                                            class="form-control @error('epouse.province') is-invalid @enderror"
                                                            id="epouse_province" name="epouse[province]"
                                                            value="{{ old('epouse.province', $mariage->epouse->province) }}">
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

                                <!-- Onglet Parents Époux -->
                                <div class="tab-pane fade" id="parents-epoux" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Père de l'époux</h6>
                                            @if($mariage->parentEpouxPere)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="pere_epoux[nom]" value="{{ old('pere_epoux.nom', $mariage->parentEpouxPere->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="pere_epoux[prenom]" value="{{ old('pere_epoux.prenom', $mariage->parentEpouxPere->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="pere_epoux[postnom]" value="{{ old('pere_epoux.postnom', $mariage->parentEpouxPere->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="pere_epoux[profession]" value="{{ old('pere_epoux.profession', $mariage->parentEpouxPere->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="pere_epoux[adresse]" value="{{ old('pere_epoux.adresse', $mariage->parentEpouxPere->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="pere_epoux[province]" value="{{ old('pere_epoux.province', $mariage->parentEpouxPere->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="pere_epoux[date_naissance]" value="{{ old('pere_epoux.date_naissance', $mariage->parentEpouxPere->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="pere_epoux[lieu_naissance]" value="{{ old('pere_epoux.lieu_naissance', $mariage->parentEpouxPere->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="pere_epoux[nationalite]" value="{{ old('pere_epoux.nationalite', $mariage->parentEpouxPere->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <h6 class="mb-3 mt-4">Mère de l'époux</h6>
                                            @if($mariage->parentEpouxMere)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="mere_epoux[nom]" value="{{ old('mere_epoux.nom', $mariage->parentEpouxMere->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="mere_epoux[prenom]" value="{{ old('mere_epoux.prenom', $mariage->parentEpouxMere->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="mere_epoux[postnom]" value="{{ old('mere_epoux.postnom', $mariage->parentEpouxMere->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="mere_epoux[profession]" value="{{ old('mere_epoux.profession', $mariage->parentEpouxMere->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="mere_epoux[adresse]" value="{{ old('mere_epoux.adresse', $mariage->parentEpouxMere->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="mere_epoux[province]" value="{{ old('mere_epoux.province', $mariage->parentEpouxMere->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="mere_epoux[date_naissance]" value="{{ old('mere_epoux.date_naissance', $mariage->parentEpouxMere->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="mere_epoux[lieu_naissance]" value="{{ old('mere_epoux.lieu_naissance', $mariage->parentEpouxMere->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="mere_epoux[nationalite]" value="{{ old('mere_epoux.nationalite', $mariage->parentEpouxMere->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Parents Épouse -->
                                <div class="tab-pane fade" id="parents-epouse" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Père de l'épouse</h6>
                                            @if($mariage->parentEpousePere)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="pere_epouse[nom]" value="{{ old('pere_epouse.nom', $mariage->parentEpousePere->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="pere_epouse[prenom]" value="{{ old('pere_epouse.prenom', $mariage->parentEpousePere->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="pere_epouse[postnom]" value="{{ old('pere_epouse.postnom', $mariage->parentEpousePere->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="pere_epouse[profession]" value="{{ old('pere_epouse.profession', $mariage->parentEpousePere->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="pere_epouse[adresse]" value="{{ old('pere_epouse.adresse', $mariage->parentEpousePere->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="pere_epouse[province]" value="{{ old('pere_epouse.province', $mariage->parentEpousePere->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="pere_epouse[date_naissance]" value="{{ old('pere_epouse.date_naissance', $mariage->parentEpousePere->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="pere_epouse[lieu_naissance]" value="{{ old('pere_epouse.lieu_naissance', $mariage->parentEpousePere->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="pere_epouse[nationalite]" value="{{ old('pere_epouse.nationalite', $mariage->parentEpousePere->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <h6 class="mb-3 mt-4">Mère de l'épouse</h6>
                                            @if($mariage->parentEpouseMere)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="mere_epouse[nom]" value="{{ old('mere_epouse.nom', $mariage->parentEpouseMere->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="mere_epouse[prenom]" value="{{ old('mere_epouse.prenom', $mariage->parentEpouseMere->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="mere_epouse[postnom]" value="{{ old('mere_epouse.postnom', $mariage->parentEpouseMere->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="mere_epouse[profession]" value="{{ old('mere_epouse.profession', $mariage->parentEpouseMere->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="mere_epouse[adresse]" value="{{ old('mere_epouse.adresse', $mariage->parentEpouseMere->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="mere_epouse[province]" value="{{ old('mere_epouse.province', $mariage->parentEpouseMere->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="mere_epouse[date_naissance]" value="{{ old('mere_epouse.date_naissance', $mariage->parentEpouseMere->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="mere_epouse[lieu_naissance]" value="{{ old('mere_epouse.lieu_naissance', $mariage->parentEpouseMere->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="mere_epouse[nationalite]" value="{{ old('mere_epouse.nationalite', $mariage->parentEpouseMere->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Témoins -->
                                <div class="tab-pane fade" id="temoins" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Témoin de l'époux</h6>
                                            @if($mariage->temoinEpoux)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[nom]" value="{{ old('temoin_epoux.nom', $mariage->temoinEpoux->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[prenom]" value="{{ old('temoin_epoux.prenom', $mariage->temoinEpoux->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[postnom]" value="{{ old('temoin_epoux.postnom', $mariage->temoinEpoux->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[profession]" value="{{ old('temoin_epoux.profession', $mariage->temoinEpoux->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[adresse]" value="{{ old('temoin_epoux.adresse', $mariage->temoinEpoux->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="temoin_epoux[date_naissance]" value="{{ old('temoin_epoux.date_naissance', $mariage->temoinEpoux->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[lieu_naissance]" value="{{ old('temoin_epoux.lieu_naissance', $mariage->temoinEpoux->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[province]" value="{{ old('temoin_epoux.province', $mariage->temoinEpoux->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="temoin_epoux[nationalite]" value="{{ old('temoin_epoux.nationalite', $mariage->temoinEpoux->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <h6 class="mb-3 mt-4">Témoin de l'épouse</h6>
                                            @if($mariage->temoinEpouse)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[nom]" value="{{ old('temoin_epouse.nom', $mariage->temoinEpouse->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[prenom]" value="{{ old('temoin_epouse.prenom', $mariage->temoinEpouse->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[postnom]" value="{{ old('temoin_epouse.postnom', $mariage->temoinEpouse->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[profession]" value="{{ old('temoin_epouse.profession', $mariage->temoinEpouse->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[adresse]" value="{{ old('temoin_epouse.adresse', $mariage->temoinEpouse->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="temoin_epouse[date_naissance]" value="{{ old('temoin_epouse.date_naissance', $mariage->temoinEpouse->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[lieu_naissance]" value="{{ old('temoin_epouse.lieu_naissance', $mariage->temoinEpouse->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[province]" value="{{ old('temoin_epouse.province', $mariage->temoinEpouse->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="temoin_epouse[nationalite]" value="{{ old('temoin_epouse.nationalite', $mariage->temoinEpouse->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Ayant Droit -->
                                <div class="tab-pane fade" id="ayantdroit" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Ayant Droit Coutumier</h6>

                                            <!-- Option pour charger les données du père de l'épouse -->
                                            <div class="row mb-4 p-3 bg-light rounded">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="load_pere_epouse">Charger les données du père de l'épouse <span class="text-muted">(optionnel)</span></label>
                                                        <div class="input-group">
                                                            <select class="form-control" id="load_pere_epouse">
                                                                <option value="">-- Sélectionnez le père de la mariée --</option>
                                                                <option value="auto">Père (données du formulaire)</option>
                                                            </select>
                                                            <button type="button" class="btn btn-outline-primary" id="btn_load_pere">
                                                                <i class="fas fa-download me-1"></i>Charger
                                                            </button>
                                                        </div>
                                                        <small class="form-text text-muted">Cliquez sur "Charger" pour remplir automatiquement les champs avec les données du père</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($mariage->ayantDroitCoutumier)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" name="ayant_droit[nom]" value="{{ old('ayant_droit.nom', $mariage->ayantDroitCoutumier->nom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Prénom</label>
                                                            <input type="text" class="form-control" name="ayant_droit[prenom]" value="{{ old('ayant_droit.prenom', $mariage->ayantDroitCoutumier->prenom ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Postnom</label>
                                                            <input type="text" class="form-control" name="ayant_droit[postnom]" value="{{ old('ayant_droit.postnom', $mariage->ayantDroitCoutumier->postnom ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Profession</label>
                                                            <input type="text" class="form-control" name="ayant_droit[profession]" value="{{ old('ayant_droit.profession', $mariage->ayantDroitCoutumier->profession ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <input type="text" class="form-control" name="ayant_droit[adresse]" value="{{ old('ayant_droit.adresse', $mariage->ayantDroitCoutumier->adresse ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date de naissance</label>
                                                            <input type="date" class="form-control" name="ayant_droit[date_naissance]" value="{{ old('ayant_droit.date_naissance', $mariage->ayantDroitCoutumier->date_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu de naissance</label>
                                                            <input type="text" class="form-control" name="ayant_droit[lieu_naissance]" value="{{ old('ayant_droit.lieu_naissance', $mariage->ayantDroitCoutumier->lieu_naissance ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <input type="text" class="form-control" name="ayant_droit[nationalite]" value="{{ old('ayant_droit.nationalite', $mariage->ayantDroitCoutumier->nationalite ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Province</label>
                                                            <input type="text" class="form-control" name="ayant_droit[province]" value="{{ old('ayant_droit.province', $mariage->ayantDroitCoutumier->province ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Lieu du mariage</label>
                                                            <input type="text" class="form-control" name="mariage[lieu_mariage]" value="{{ old('mariage.lieu_mariage', $mariage->lieu_mariage ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date du mariage</label>
                                                            <input type="date" class="form-control" name="mariage[date_mariage]" value="{{ old('mariage.date_mariage', $mariage->date_mariage ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Statut</label>
                                                            <select class="form-control" name="mariage[status_id]">
                                                                <option value="">Sélectionnez...</option>
                                                                @if($status)
                                                                    @foreach ($status as $stat)
                                                                        <option value="{{ $stat->id }}" {{ old('mariage.status_id', $mariage->status_id ?? '') == $stat->id ? 'selected' : '' }}>
                                                                            {{ $stat->libelle ?? $stat->nom }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Régime matrimonial -->
                                <div class="tab-pane fade" id="regime" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="regime_dotation">Dotation coutumière</label>
                                                        <input type="number" class="form-control" id="regime_dotation" name="regime[dotation_coutumier]" value="{{ old('regime.dotation_coutumier', $mariage->regimeMatrimonial->dotation_coutumier ?? '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="regime_contrat">Type de contrat</label>
                                                        <select class="form-control" id="regime_contrat" name="regime[contrat_id]">
                                                            <option value="">Sélectionnez...</option>
                                                            @if($mariage->regimeMatrimonial && isset($contrats))
                                                                @foreach ($contrats as $contrat)
                                                                    <option value="{{ $contrat->id }}" {{ old('regime.contrat_id', $mariage->regimeMatrimonial->contrat_id ?? '') == $contrat->id ? 'selected' : '' }}>
                                                                        {{ $contrat->type_contrat }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"
        rel="stylesheet">
@endpush

@push('scripts')
    <script>
        // Fonction pour charger les données du père de l'épouse dans Ayant Droit
        function loadPereEpouseData() {
            const nom = document.getElementById('pere_epouse_nom')?.value;
            const prenom = document.getElementById('pere_epouse_prenom')?.value;
            const postnom = document.getElementById('pere_epouse_postnom')?.value;
            const profession = document.getElementById('pere_epouse_profession')?.value;
            const adresse = document.getElementById('pere_epouse_adresse')?.value;
            const dateNaissance = document.getElementById('pere_epouse_date_naissance')?.value;
            const lieuNaissance = document.getElementById('pere_epouse_lieu_naissance')?.value;
            const nationalite = document.getElementById('pere_epouse_nationalite')?.value;
            const province = document.getElementById('pere_epouse_province')?.value;

            if (!nom || !prenom) {
                alert('Veuillez d\'abord remplir au moins le nom et le prénom du père de l\'épouse.');
                return;
            }

            document.getElementById('ayant_droit_nom').value = nom;
            document.getElementById('ayant_droit_prenom').value = prenom;
            document.getElementById('ayant_droit_postnom').value = postnom;
            document.getElementById('ayant_droit_profession').value = profession;
            document.getElementById('ayant_droit_adresse').value = adresse;
            document.getElementById('ayant_droit_date_naissance').value = dateNaissance;
            document.getElementById('ayant_droit_lieu_naissance').value = lieuNaissance;
            document.getElementById('ayant_droit_nationalite').value = nationalite;
            document.getElementById('ayant_droit_province').value = province;

            alert('Données du père de l\'épouse chargées avec succès!');
            document.getElementById('load_pere_epouse').value = '';
        }

        document.getElementById('btn_load_pere')?.addEventListener('click', function() {
            loadPereEpouseData();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var triggerTabList = [].slice.call(document.querySelectorAll('#mariageTabs button'))
            triggerTabList.forEach(function(triggerEl) {
                triggerEl.addEventListener('shown.bs.tab', function(event) {
                    localStorage.setItem('lastActiveTab', event.target.id)
                })
            })

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
