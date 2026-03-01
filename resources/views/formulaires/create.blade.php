@extends('layouts.agents.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Nouveau Mariage</h6>
                        <a href="{{ route('mariages.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mariages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Progression du formulaire -->
                            <div class="mb-3">
                                <div class="progress" style="height:14px;">
                                    <div id="mariageProgress" class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                                <div class="small text-muted mt-1">Étape <span id="currentStep">1</span> / <span id="totalSteps">6</span></div>
                            </div>

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
                                                        <label for="epoux_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.nom') is-invalid @enderror"
                                                            id="epoux_nom" name="epoux[nom]" value="{{ old('epoux.nom') }}"
                                                            required>
                                                        @error('epoux.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.prenom') is-invalid @enderror"
                                                            id="epoux_prenom" name="epoux[prenom]"
                                                            value="{{ old('epoux.prenom') }}" required>
                                                        @error('epoux.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.postnom') is-invalid @enderror"
                                                            id="epoux_postnom" name="epoux[postnom]"
                                                            value="{{ old('epoux.postnom') }}" required>
                                                        @error('epoux.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.profession') is-invalid @enderror"
                                                            id="epoux_profession" name="epoux[profession]"
                                                            value="{{ old('epoux.profession') }}" required>
                                                        @error('epoux.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.adresse') is-invalid @enderror"
                                                            id="epoux_adresse" name="epoux[adresse]"
                                                            value="{{ old('epoux.adresse') }}" required>
                                                        @error('epoux.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_district">District <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.district') is-invalid @enderror"
                                                            id="epoux_district" name="epoux[district]"
                                                            value="{{ old('epoux.district') }}" required>
                                                        @error('epoux.district')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.province') is-invalid @enderror"
                                                            id="epoux_province" name="epoux[province]"
                                                            value="{{ old('epoux.province') }}" required>
                                                        @error('epoux.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.nationalite') is-invalid @enderror"
                                                            id="epoux_nationalite" name="epoux[nationalite]"
                                                            value="{{ old('epoux.nationalite') }}" required>
                                                        @error('epoux.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_date_naissance">Date de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('epoux.date_naissance') is-invalid @enderror"
                                                            id="epoux_date_naissance" name="epoux[date_naissance]"
                                                            value="{{ old('epoux.date_naissance') }}" required>
                                                        @error('epoux.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_lieu_naissance">Lieu de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.lieu_naissance') is-invalid @enderror"
                                                            id="epoux_lieu_naissance" name="epoux[lieu_naissance]"
                                                            value="{{ old('epoux.lieu_naissance') }}" required>
                                                        @error('epoux.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_secteur">Secteur <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.secteur') is-invalid @enderror"
                                                            id="epoux_secteur" name="epoux[secteur]"
                                                            value="{{ old('epoux.secteur') }}" required>
                                                        @error('epoux.secteur')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_territoire">Territoire <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epoux.territoire') is-invalid @enderror"
                                                            id="epoux_territoire" name="epoux[territoire]"
                                                            value="{{ old('epoux.territoire') }}" required>
                                                        @error('epoux.territoire')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epoux_photo">Photo de l'époux</label>
                                                        <input type="file"
                                                            class="form-control @error('epoux.url_photo') is-invalid @enderror"
                                                            id="epoux_photo" name="epoux[url_photo]">
                                                        @error('epoux.url_photo')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <small class="form-text text-muted">Formats acceptés : JPG, PNG,
                                                            GIF. Taille max : 2MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Boutons de navigation -->
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" disabled>
                                                <i class="fas fa-arrow-left me-2"></i>Précédent
                                            </button>
                                            <button type="button" class="btn btn-primary next-tab"
                                                data-next-tab="epouse-tab">
                                                Suivant <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
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
                                                        <label for="epouse_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.nom') is-invalid @enderror"
                                                            id="epouse_nom" name="epouse[nom]"
                                                            value="{{ old('epouse.nom') }}" required>
                                                        @error('epouse.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.prenom') is-invalid @enderror"
                                                            id="epouse_prenom" name="epouse[prenom]"
                                                            value="{{ old('epouse.prenom') }}" required>
                                                        @error('epouse.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.postnom') is-invalid @enderror"
                                                            id="epouse_postnom" name="epouse[postnom]"
                                                            value="{{ old('epouse.postnom') }}" required>
                                                        @error('epouse.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.profession') is-invalid @enderror"
                                                            id="epouse_profession" name="epouse[profession]"
                                                            value="{{ old('epouse.profession') }}" required>
                                                        @error('epouse.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.adresse') is-invalid @enderror"
                                                            id="epouse_adresse" name="epouse[adresse]"
                                                            value="{{ old('epouse.adresse') }}" required>
                                                        @error('epouse.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_district">District <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.district') is-invalid @enderror"
                                                            id="epouse_district" name="epouse[district]"
                                                            value="{{ old('epouse.district') }}" required>
                                                        @error('epouse.district')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.province') is-invalid @enderror"
                                                            id="epouse_province" name="epouse[province]"
                                                            value="{{ old('epouse.province') }}" required>
                                                        @error('epouse.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.nationalite') is-invalid @enderror"
                                                            id="epouse_nationalite" name="epouse[nationalite]"
                                                            value="{{ old('epouse.nationalite') }}" required>
                                                        @error('epouse.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_date_naissance">Date de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('epouse.date_naissance') is-invalid @enderror"
                                                            id="epouse_date_naissance" name="epouse[date_naissance]"
                                                            value="{{ old('epouse.date_naissance') }}" required>
                                                        @error('epouse.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_lieu_naissance">Lieu de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.lieu_naissance') is-invalid @enderror"
                                                            id="epouse_lieu_naissance" name="epouse[lieu_naissance]"
                                                            value="{{ old('epouse.lieu_naissance') }}" required>
                                                        @error('epouse.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_secteur">Secteur <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.secteur') is-invalid @enderror"
                                                            id="epouse_secteur" name="epouse[secteur]"
                                                            value="{{ old('epouse.secteur') }}" required>
                                                        @error('epouse.secteur')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_territoire">Territoire <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('epouse.territoire') is-invalid @enderror"
                                                            id="epouse_territoire" name="epouse[territoire]"
                                                            value="{{ old('epouse.territoire') }}" required>
                                                        @error('epouse.territoire')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="epouse_url_photo">Photo de l'épouse</label>
                                                        <input type="file"
                                                            class="form-control @error('epouse.url_photo') is-invalid @enderror"
                                                            id="epouse_photo" name="epouse[url_photo]">
                                                        @error('epouse.url_photo')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <small class="form-text text-muted">Formats acceptés : JPG, PNG,
                                                            GIF. Taille max : 2MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Boutons de navigation -->
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab"
                                                data-prev-tab="epoux-tab">
                                                <i class="fas fa-arrow-left me-2"></i>Précédent
                                            </button>
                                            <button type="button" class="btn btn-primary next-tab"
                                                data-next-tab="parents-epoux-tab">
                                                Suivant <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Parents Époux -->
                                <div class="tab-pane fade" id="parents-epoux" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Père de l'époux</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.nom') is-invalid @enderror"
                                                            id="pere_epoux_nom" name="pere_epoux[nom]"
                                                            value="{{ old('pere_epoux.nom') }}" required>
                                                        @error('pere_epoux.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.prenom') is-invalid @enderror"
                                                            id="pere_epoux_prenom" name="pere_epoux[prenom]"
                                                            value="{{ old('pere_epoux.prenom') }}" required>
                                                        @error('pere_epoux.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <input type="text" name="pere_epoux[type]" value="pere"
                                                        hidden />
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.postnom') is-invalid @enderror"
                                                            id="pere_epoux_postnom" name="pere_epoux[postnom]"
                                                            value="{{ old('pere_epoux.postnom') }}" required>
                                                        @error('pere_epoux.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.profession') is-invalid @enderror"
                                                            id="pere_epoux_profession" name="pere_epoux[profession]"
                                                            value="{{ old('pere_epoux.profession') }}" required>
                                                        @error('pere_epoux.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.adresse') is-invalid @enderror"
                                                            id="pere_epoux_adresse" name="pere_epoux[adresse]"
                                                            value="{{ old('pere_epoux.adresse') }}" required>
                                                        @error('pere_epoux.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_enVie">En vie <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('pere_epoux.enVie') is-invalid @enderror"
                                                            id="pere_epoux_enVie" name="pere_epoux[enVie]" required>
                                                            <option value="1"
                                                                {{ old('pere_epoux.enVie') == '1' ? 'selected' : '' }}>Oui
                                                            </option>
                                                            <option value="0"
                                                                {{ old('pere_epoux.enVie') == '0' ? 'selected' : '' }}>Non
                                                            </option>
                                                        </select>
                                                        @error('pere_epoux.enVie')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.province') is-invalid @enderror"
                                                            id="pere_epoux_province" name="pere_epoux[province]"
                                                            value="{{ old('pere_epoux.province') }}" required>
                                                        @error('pere_epoux.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_date_naissance">Date de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('pere_epoux.date_naissance') is-invalid @enderror"
                                                            id="pere_epoux_date_naissance"
                                                            name="pere_epoux[date_naissance]"
                                                            value="{{ old('pere_epoux.date_naissance') }}" required>
                                                        @error('pere_epoux.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_lieu_naissance">Lieu de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.lieu_naissance') is-invalid @enderror"
                                                            id="pere_epoux_lieu_naissance"
                                                            name="pere_epoux[lieu_naissance]"
                                                            value="{{ old('pere_epoux.lieu_naissance') }}" required>
                                                        @error('pere_epoux.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epoux_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epoux.nationalite') is-invalid @enderror"
                                                            id="pere_epoux_nationalite" name="pere_epoux[nationalite]"
                                                            value="{{ old('pere_epoux.nationalite') }}" required>
                                                        @error('pere_epoux.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <h6 class="mb-3 mt-4">Mère de l'époux</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.nom') is-invalid @enderror"
                                                            id="mere_epoux_nom" name="mere_epoux[nom]"
                                                            value="{{ old('mere_epoux.nom') }}" required>
                                                        @error('mere_epoux.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <input type="text" name="mere_epoux[type]" value="mere"
                                                        hidden />
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.prenom') is-invalid @enderror"
                                                            id="mere_epoux_prenom" name="mere_epoux[prenom]"
                                                            value="{{ old('mere_epoux.prenom') }}" required>
                                                        @error('mere_epoux.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.postnom') is-invalid @enderror"
                                                            id="mere_epoux_postnom" name="mere_epoux[postnom]"
                                                            value="{{ old('mere_epoux.postnom') }}" required>
                                                        @error('mere_epoux.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.profession') is-invalid @enderror"
                                                            id="mere_epoux_profession" name="mere_epoux[profession]"
                                                            value="{{ old('mere_epoux.profession') }}" required>
                                                        @error('mere_epoux.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.adresse') is-invalid @enderror"
                                                            id="mere_epoux_adresse" name="mere_epoux[adresse]"
                                                            value="{{ old('mere_epoux.adresse') }}" required>
                                                        @error('mere_epoux.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_enVie">En vie <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('mere_epoux.enVie') is-invalid @enderror"
                                                            id="mere_epoux_enVie" name="mere_epoux[enVie]" required>
                                                            <option value="1"
                                                                {{ old('mere_epoux.enVie') == '1' ? 'selected' : '' }}>Oui
                                                            </option>
                                                            <option value="0"
                                                                {{ old('mere_epoux.enVie') == '0' ? 'selected' : '' }}>Non
                                                            </option>
                                                        </select>
                                                        @error('mere_epoux.enVie')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.province') is-invalid @enderror"
                                                            id="mere_epoux_province" name="mere_epoux[province]"
                                                            value="{{ old('mere_epoux.province') }}" required>
                                                        @error('mere_epoux.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_date_naissance">Date de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('mere_epoux.date_naissance') is-invalid @enderror"
                                                            id="mere_epoux_date_naissance"
                                                            name="mere_epoux[date_naissance]"
                                                            value="{{ old('mere_epoux.date_naissance') }}" required>
                                                        @error('mere_epoux.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_lieu_naissance">Lieu de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.lieu_naissance') is-invalid @enderror"
                                                            id="mere_epoux_lieu_naissance"
                                                            name="mere_epoux[lieu_naissance]"
                                                            value="{{ old('mere_epoux.lieu_naissance') }}" required>
                                                        @error('mere_epoux.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epoux_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epoux.nationalite') is-invalid @enderror"
                                                            id="mere_epoux_nationalite" name="mere_epoux[nationalite]"
                                                            value="{{ old('mere_epoux.nationalite') }}" required>
                                                        @error('mere_epoux.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <!-- Boutons de navigation -->
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab"
                                                data-prev-tab="epouse-tab">
                                                <i class="fas fa-arrow-left me-2"></i>Précédent
                                            </button>
                                            <button type="button" class="btn btn-primary next-tab"
                                                data-next-tab="parents-epouse-tab">
                                                Suivant <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Parents Épouse -->
                                <div class="tab-pane fade" id="parents-epouse" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Père de l'épouse</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.nom') is-invalid @enderror"
                                                            id="pere_epouse_nom" name="pere_epouse[nom]"
                                                            value="{{ old('pere_epouse.nom') }}" required>
                                                        @error('pere_epouse.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="text" name="pere_epouse[type]" value="pere" hidden />
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.prenom') is-invalid @enderror"
                                                            id="pere_epouse_prenom" name="pere_epouse[prenom]"
                                                            value="{{ old('pere_epouse.prenom') }}" required>
                                                        @error('pere_epouse.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.postnom') is-invalid @enderror"
                                                            id="pere_epouse_postnom" name="pere_epouse[postnom]"
                                                            value="{{ old('pere_epouse.postnom') }}" required>
                                                        @error('pere_epouse.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.profession') is-invalid @enderror"
                                                            id="pere_epouse_profession" name="pere_epouse[profession]"
                                                            value="{{ old('pere_epouse.profession') }}" required>
                                                        @error('pere_epouse.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.adresse') is-invalid @enderror"
                                                            id="pere_epouse_adresse" name="pere_epouse[adresse]"
                                                            value="{{ old('pere_epouse.adresse') }}" required>
                                                        @error('pere_epouse.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_enVie">En vie <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('pere_epouse.enVie') is-invalid @enderror"
                                                            id="pere_epouse_enVie" name="pere_epouse[enVie]" required>
                                                            <option value="1"
                                                                {{ old('pere_epouse.enVie') == '1' ? 'selected' : '' }}>
                                                                Oui</option>
                                                            <option value="0"
                                                                {{ old('pere_epouse.enVie') == '0' ? 'selected' : '' }}>
                                                                Non</option>
                                                        </select>
                                                        @error('pere_epouse.enVie')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.province') is-invalid @enderror"
                                                            id="pere_epouse_province" name="pere_epouse[province]"
                                                            value="{{ old('pere_epouse.province') }}" required>
                                                        @error('pere_epouse.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_date_naissance">Date de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('pere_epouse.date_naissance') is-invalid @enderror"
                                                            id="pere_epouse_date_naissance"
                                                            name="pere_epouse[date_naissance]"
                                                            value="{{ old('pere_epouse.date_naissance') }}" required>
                                                        @error('pere_epouse.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_lieu_naissance">Lieu de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.lieu_naissance') is-invalid @enderror"
                                                            id="pere_epouse_lieu_naissance"
                                                            name="pere_epouse[lieu_naissance]"
                                                            value="{{ old('pere_epouse.lieu_naissance') }}" required>
                                                        @error('pere_epouse.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pere_epouse_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('pere_epouse.nationalite') is-invalid @enderror"
                                                            id="pere_epouse_nationalite" name="pere_epouse[nationalite]"
                                                            value="{{ old('pere_epouse.nationalite') }}" required>
                                                        @error('pere_epouse.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <h6 class="mb-3 mt-4">Mère de l'épouse</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.nom') is-invalid @enderror"
                                                            id="mere_epouse_nom" name="mere_epouse[nom]"
                                                            value="{{ old('mere_epouse.nom') }}" required>
                                                        @error('mere_epouse.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="text" name="mere_epouse[type]" value="mere" hidden />
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.prenom') is-invalid @enderror"
                                                            id="mere_epouse_prenom" name="mere_epouse[prenom]"
                                                            value="{{ old('mere_epouse.prenom') }}" required>
                                                        @error('mere_epouse.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.postnom') is-invalid @enderror"
                                                            id="mere_epouse_postnom" name="mere_epouse[postnom]"
                                                            value="{{ old('mere_epouse.postnom') }}" required>
                                                        @error('mere_epouse.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.profession') is-invalid @enderror"
                                                            id="mere_epouse_profession" name="mere_epouse[profession]"
                                                            value="{{ old('mere_epouse.profession') }}" required>
                                                        @error('mere_epouse.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.adresse') is-invalid @enderror"
                                                            id="mere_epouse_adresse" name="mere_epouse[adresse]"
                                                            value="{{ old('mere_epouse.adresse') }}" required>
                                                        @error('mere_epouse.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_enVie">En vie <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('mere_epouse.enVie') is-invalid @enderror"
                                                            id="mere_epouse_enVie" name="mere_epouse[enVie]" required>
                                                            <option value="1"
                                                                {{ old('mere_epouse.enVie') == '1' ? 'selected' : '' }}>
                                                                Oui</option>
                                                            <option value="0"
                                                                {{ old('mere_epouse.enVie') == '0' ? 'selected' : '' }}>
                                                                Non</option>
                                                        </select>
                                                        @error('mere_epouse.enVie')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.province') is-invalid @enderror"
                                                            id="mere_epouse_province" name="mere_epouse[province]"
                                                            value="{{ old('mere_epouse.province') }}" required>
                                                        @error('mere_epouse.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_date_naissance">Date de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('mere_epouse.date_naissance') is-invalid @enderror"
                                                            id="mere_epouse_date_naissance"
                                                            name="mere_epouse[date_naissance]"
                                                            value="{{ old('mere_epouse.date_naissance') }}" required>
                                                        @error('mere_epouse.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_lieu_naissance">Lieu de naissance <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.lieu_naissance') is-invalid @enderror"
                                                            id="mere_epouse_lieu_naissance"
                                                            name="mere_epouse[lieu_naissance]"
                                                            value="{{ old('mere_epouse.lieu_naissance') }}" required>
                                                        @error('mere_epouse.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mere_epouse_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mere_epouse.nationalite') is-invalid @enderror"
                                                            id="mere_epouse_nationalite" name="mere_epouse[nationalite]"
                                                            value="{{ old('mere_epouse.nationalite') }}" required>
                                                        @error('mere_epouse.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <!-- Boutons de navigation -->
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab"
                                                data-prev-tab="parents-epoux-tab">
                                                <i class="fas fa-arrow-left me-2"></i>Précédent
                                            </button>
                                            <button type="button" class="btn btn-primary next-tab"
                                                data-next-tab="temoins-tab">
                                                Suivant <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Témoins -->
                                <div class="tab-pane fade" id="temoins" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Témoin de l'époux</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.nom') is-invalid @enderror"
                                                            id="temoin_epoux_nom" name="temoin_epoux[nom]"
                                                            value="{{ old('temoin_epoux.nom') }}" required>
                                                        @error('temoin_epoux.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.prenom') is-invalid @enderror"
                                                            id="temoin_epoux_prenom" name="temoin_epoux[prenom]"
                                                            value="{{ old('temoin_epoux.prenom') }}" required>
                                                        @error('temoin_epoux.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.profession') is-invalid @enderror"
                                                            id="temoin_epoux_profession" name="temoin_epoux[profession]"
                                                            value="{{ old('temoin_epoux.profession') }}" required>
                                                        @error('temoin_epoux.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.adresse') is-invalid @enderror"
                                                            id="temoin_epoux_adresse" name="temoin_epoux[adresse]"
                                                            value="{{ old('temoin_epoux.adresse') }}" required>
                                                        @error('temoin_epoux.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_date_naissance">Date de naissance
                                                            <span class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('temoin_epoux.date_naissance') is-invalid @enderror"
                                                            id="temoin_epoux_date_naissance"
                                                            name="temoin_epoux[date_naissance]"
                                                            value="{{ old('temoin_epoux.date_naissance') }}" required>
                                                        @error('temoin_epoux.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_lieu_naissance">Lieu de naissance
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.lieu_naissance') is-invalid @enderror"
                                                            id="temoin_epoux_lieu_naissance"
                                                            name="temoin_epoux[lieu_naissance]"
                                                            value="{{ old('temoin_epoux.lieu_naissance') }}" required>
                                                        @error('temoin_epoux.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.province') is-invalid @enderror"
                                                            id="temoin_epoux_province" name="temoin_epoux[province]"
                                                            value="{{ old('temoin_epoux.province') }}" required>
                                                        @error('temoin_epoux.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.nationalite') is-invalid @enderror"
                                                            id="temoin_epoux_nationalite" name="temoin_epoux[nationalite]"
                                                            value="{{ old('temoin_epoux.nationalite') }}" required>
                                                        @error('temoin_epoux.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epoux.postnom') is-invalid @enderror"
                                                            id="temoin_epoux_postnom" name="temoin_epoux[postnom]"
                                                            value="{{ old('temoin_epoux.postnom') }}" required>
                                                        @error('temoin_epoux.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epoux_etat_civil">État civil <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('temoin_epoux.etat_civil') is-invalid @enderror"
                                                            id="temoin_epoux_etat_civil" name="temoin_epoux[etat_civil]"
                                                            required>
                                                            <option value="">Sélectionnez...</option>
                                                            <option value="celibataire"
                                                                {{ old('temoin_epoux.etat_civil') == 'celibataire' ? 'selected' : '' }}>
                                                                Célibataire</option>
                                                            <option value="marie"
                                                                {{ old('temoin_epoux.etat_civil') == 'marie' ? 'selected' : '' }}>
                                                                Marié(e)</option>
                                                            <option value="divorce"
                                                                {{ old('temoin_epoux.etat_civil') == 'divorce' ? 'selected' : '' }}>
                                                                Divorcé(e)</option>
                                                            <option value="veuf"
                                                                {{ old('temoin_epoux.etat_civil') == 'veuf' ? 'selected' : '' }}>
                                                                Veuf(ve)</option>
                                                        </select>
                                                        @error('temoin_epoux.etat_civil')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>



                                            <h6 class="mb-3 mt-4">Témoin de l'épouse</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.nom') is-invalid @enderror"
                                                            id="temoin_epouse_nom" name="temoin_epouse[nom]"
                                                            value="{{ old('temoin_epouse.nom') }}" required>
                                                        @error('temoin_epouse.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.prenom') is-invalid @enderror"
                                                            id="temoin_epouse_prenom" name="temoin_epouse[prenom]"
                                                            value="{{ old('temoin_epouse.prenom') }}" required>
                                                        @error('temoin_epouse.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.profession') is-invalid @enderror"
                                                            id="temoin_epouse_profession" name="temoin_epouse[profession]"
                                                            value="{{ old('temoin_epouse.profession') }}" required>
                                                        @error('temoin_epouse.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.nationalite') is-invalid @enderror"
                                                            id="temoin_epouse_nationalite"
                                                            name="temoin_epouse[nationalite]"
                                                            value="{{ old('temoin_epouse.nationalite') }}" required>
                                                        @error('temoin_epouse.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.adresse') is-invalid @enderror"
                                                            id="temoin_epouse_adresse" name="temoin_epouse[adresse]"
                                                            value="{{ old('temoin_epouse.adresse') }}" required>
                                                        @error('temoin_epouse.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.postnom') is-invalid @enderror"
                                                            id="temoin_epouse_postnom" name="temoin_epouse[postnom]"
                                                            value="{{ old('temoin_epouse.postnom') }}" required>
                                                        @error('temoin_epouse.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.province') is-invalid @enderror"
                                                            id="temoin_epouse_province" name="temoin_epouse[province]"
                                                            value="{{ old('temoin_epouse.province') }}" required>
                                                        @error('temoin_epouse.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_date_naissance">Date de naissance
                                                            <span class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('temoin_epouse.date_naissance') is-invalid @enderror"
                                                            id="temoin_epouse_date_naissance"
                                                            name="temoin_epouse[date_naissance]"
                                                            value="{{ old('temoin_epouse.date_naissance') }}" required>
                                                        @error('temoin_epouse.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_lieu_naissance">Lieu de naissance
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('temoin_epouse.lieu_naissance') is-invalid @enderror"
                                                            id="temoin_epouse_lieu_naissance"
                                                            name="temoin_epouse[lieu_naissance]"
                                                            value="{{ old('temoin_epouse.lieu_naissance') }}" required>
                                                        @error('temoin_epouse.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="temoin_epouse_etat_civil">État civil <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('temoin_epouse.etat_civil') is-invalid @enderror"
                                                            id="temoin_epouse_etat_civil"
                                                            name="temoin_epouse[etat_civil]" required>
                                                            <option value="">Sélectionnez...</option>
                                                            <option value="celibataire"
                                                                {{ old('temoin_epouse.etat_civil') == 'celibataire' ? 'selected' : '' }}>
                                                                Célibataire</option>
                                                            <option value="marie"
                                                                {{ old('temoin_epouse.etat_civil') == 'marie' ? 'selected' : '' }}>
                                                                Marié(e)</option>
                                                            <option value="divorce"
                                                                {{ old('temoin_epouse.etat_civil') == 'divorce' ? 'selected' : '' }}>
                                                                Divorcé(e)</option>
                                                            <option value="veuf"
                                                                {{ old('temoin_epouse.etat_civil') == 'veuf' ? 'selected' : '' }}>
                                                                Veuf(ve)</option>
                                                        </select>
                                                        @error('temoin_epouse.etat_civil')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Boutons de navigation et soumission -->
                                                <div class="row mt-4">
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-secondary prev-tab"
                                                            data-prev-tab="parents-epouse-tab">
                                                            <i class="fas fa-arrow-left me-2"></i>Précédent
                                                        </button>
                                                        <button type="button" class="btn btn-primary next-tab"
                                                            data-next-tab="ayantdroit-tab">
                                                            Suivant <i class="fas fa-arrow-right ms-2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Boutons de navigation -->

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
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_nom">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.nom') is-invalid @enderror"
                                                            id="ayant_droit_nom" name="ayant_droit[nom]"
                                                            value="{{ old('ayant_droit.nom') }}" required>
                                                        @error('ayant_droit.nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_prenom">Prénom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.prenom') is-invalid @enderror"
                                                            id="ayant_droit_prenom" name="ayant_droit[prenom]"
                                                            value="{{ old('ayant_droit.prenom') }}" required>
                                                        @error('ayant_droit.prenom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_profession">Profession <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.profession') is-invalid @enderror"
                                                            id="ayant_droit_profession" name="ayant_droit[profession]"
                                                            value="{{ old('ayant_droit.profession') }}" required>
                                                        @error('ayant_droit.profession')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_adresse">Adresse <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.adresse') is-invalid @enderror"
                                                            id="ayant_droit_adresse" name="ayant_droit[adresse]"
                                                            value="{{ old('ayant_droit.adresse') }}" required>
                                                        @error('ayant_droit.adresse')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_postnom">Postnom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.postnom') is-invalid @enderror"
                                                            id="ayant_droit_postnom" name="ayant_droit[postnom]"
                                                            value="{{ old('ayant_droit.postnom') }}" required>
                                                        @error('ayant_droit.postnom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_date_naissance">Date de naissance
                                                            <span class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('ayant_droit.date_naissance') is-invalid @enderror"
                                                            id="ayant_droit_date_naissance"
                                                            name="ayant_droit[date_naissance]"
                                                            value="{{ old('ayant_droit.date_naissance') }}" required>
                                                        @error('ayant_droit.date_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row mt-3">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_lieu_naissance">Lieu de naissance
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.lieu_naissance') is-invalid @enderror"
                                                            id="ayant_droit_lieu_naissance"
                                                            name="ayant_droit[lieu_naissance]"
                                                            value="{{ old('ayant_droit.lieu_naissance') }}" required>
                                                        @error('ayant_droit.lieu_naissance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_nationalite">Nationalité <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.nationalite') is-invalid @enderror"
                                                            id="ayant_droit_nationalite" name="ayant_droit[nationalite]"
                                                            value="{{ old('ayant_droit.nationalite') }}" required>
                                                        @error('ayant_droit.nationalite')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ayant_droit_province">Province <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ayant_droit.province') is-invalid @enderror"
                                                            id="ayant_droit_province" name="ayant_droit[province]"
                                                            value="{{ old('ayant_droit.province') }}" required>
                                                        @error('ayant_droit.province')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mariage_lieu">Lieu du mariage <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('mariage.lieu_mariage') is-invalid @enderror"
                                                            id="mariage_lieu" name="mariage[lieu_mariage]"
                                                            value="{{ old('mariage.lieu_mariage') }}" required>
                                                        @error('mariage.lieu_mariage')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mariage_date">Date du mariage <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control @error('mariage.date_mariage') is-invalid @enderror"
                                                            id="mariage_date" name="mariage[date_mariage]"
                                                            value="{{ old('mariage.date_mariage') }}" required>
                                                        @error('mariage.date_mariage')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mariage_status">Statut <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('mariage.status_id') is-invalid @enderror"
                                                            id="mariage_status" name="mariage[status_id]" required>
                                                            <option value="">Sélectionnez...</option>
                                                            @foreach ($status as $stat)
                                                                <option value="{{ $stat->id }}"
                                                                    {{ old('mariage.status_id') == $stat->id ? 'selected' : '' }}>
                                                                    {{ $stat->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('mariage.status_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <!-- Lieu du mariage coutumier supprimé (déplacé/retiré) -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="regime_dotation">Dotation coutumière <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control @error('regime.dotation_coutumier') is-invalid @enderror"
                                                            id="regime_dotation" name="regime[dotation_coutumier]"
                                                            value="{{ old('regime.dotation_coutumier') }}" required>
                                                        @error('regime.dotation_coutumier')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="regime_contrat">Type de contrat <span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control @error('regime.contrat_id') is-invalid @enderror"
                                                            id="regime_contrat" name="regime[contrat_id]" required>
                                                            <option value="">Sélectionnez...</option>
                                                            @foreach ($contrats as $contrat)
                                                                <option value="{{ $contrat->id }}"
                                                                    {{ old('regime.contrat_id') == $contrat->id ? 'selected' : '' }}>
                                                                    {{ $contrat->type_contrat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('regime.contrat_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Photo du couple (prévisualisation) -->
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="couple_photo">Photo du couple <span class="text-danger">*</span></label>
                                                <input type="file" id="couple_photo" name="couple_photo" accept="image/*" class="form-control" />
                                                <div id="couple_photo_preview" style="display:none; margin-top:10px;"></div>
                                                <small class="form-text text-muted">Trois photos requises : époux, épouse et couple.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bouton de soumission final -->
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab"
                                                data-prev-tab="temoins-tab">
                                                <i class="fas fa-arrow-left me-2"></i>Précédent
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-2"></i>Enregistrer le mariage
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Multi-step form enhancements: progress, autosave (localStorage), preview, required-photo check
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route('mariages.store') }}"]');
            const navLinks = Array.from(document.querySelectorAll('#mariageTabs .nav-link'));
            const totalSteps = navLinks.length;
            const progressBar = document.getElementById('mariageProgress');
            const currentStepEl = document.getElementById('currentStep');
            const totalStepsEl = document.getElementById('totalSteps');
            totalStepsEl.textContent = totalSteps;

            function updateProgress() {
                const activeIndex = navLinks.findIndex(n => n.classList.contains('active'));
                const index = activeIndex >= 0 ? activeIndex : 0;
                const pct = Math.round(((index + 1) / totalSteps) * 100);
                progressBar.style.width = pct + '%';
                progressBar.textContent = pct + '%';
                currentStepEl.textContent = index + 1;
            }

            // Make nav tabs clickable (allow editing previous steps)
            navLinks.forEach(tab => {
                tab.addEventListener('shown.bs.tab', updateProgress);
            });

            updateProgress();

            // Validation helper for each step (used by next buttons)
            function validatePane(pane) {
                const inputs = pane.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                inputs.forEach(input => {
                    if (!input.value) {
                        input.classList.add('is-invalid');
                        isValid = false;
                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('invalid-feedback')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.textContent = 'Ce champ est obligatoire';
                            input.parentNode.insertBefore(errorDiv, input.nextSibling);
                        }
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                return isValid;
            }

            // Next / Prev buttons behavior (keep existing but add progress + autosave)
            document.querySelectorAll('.next-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const currentTabPane = this.closest('.tab-pane');
                    if (!validatePane(currentTabPane)) {
                        const firstInvalid = currentTabPane.querySelector('.is-invalid');
                        if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }
                    const nextTabId = this.getAttribute('data-next-tab');
                    const nextTab = document.querySelector(`#${nextTabId}`);
                    new bootstrap.Tab(nextTab).show();
                    localStorage.setItem('lastActiveTab', nextTabId);
                    saveDraft();
                });
            });

            document.querySelectorAll('.prev-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const prevTabId = this.getAttribute('data-prev-tab');
                    const prevTab = document.querySelector(`#${prevTabId}`);
                    new bootstrap.Tab(prevTab).show();
                    localStorage.setItem('lastActiveTab', prevTabId);
                    saveDraft();
                });
            });

            // Restore last active tab
            const lastActiveTab = localStorage.getItem('lastActiveTab');
            if (lastActiveTab) {
                const tab = document.querySelector(`#${lastActiveTab}`);
                if (tab) new bootstrap.Tab(tab).show();
            }

            // Image preview helper (also stores preview images into preview element)
            function previewImageFile(file, previewId) {
                return new Promise(resolve => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewElement = document.getElementById(previewId) || (function(){
                            const div = document.createElement('div'); div.id = previewId; div.style.display = 'block'; div.style.marginTop = '10px'; return div;
                        })();
                        previewElement.innerHTML = '';
                        const img = document.createElement('img'); img.src = e.target.result; img.style.maxWidth = '200px'; img.style.maxHeight = '200px';
                        previewElement.appendChild(img);
                        previewElement.style.display = 'block';
                        if (!document.getElementById(previewId)) {
                            // try to append near input
                            const input = document.querySelector(`#${previewId.replace('_preview','')}`);
                            if (input && input.parentNode) input.parentNode.appendChild(previewElement);
                        }
                        resolve(e.target.result);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Attach preview handlers for known photo inputs
            ['epoux_photo','epouse_photo','couple_photo'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('change', function() {
                        if (this.files && this.files[0]) previewImageFile(this.files[0], id + '_preview');
                        saveDraft();
                    });
                }
            });

            // Serialize form to a plain object for localStorage (stores text values and image dataURLs when available)
            async function serializeForm() {
                const data = {};
                const elements = form.querySelectorAll('input, select, textarea');
                for (const el of elements) {
                    const name = el.name;
                    if (!name) continue;
                    if (el.type === 'file') {
                        if (el.files && el.files[0]) {
                            // read file
                            const dataUrl = await new Promise(res => {
                                const r = new FileReader(); r.onload = e => res(e.target.result); r.readAsDataURL(el.files[0]);
                            });
                            data[name] = dataUrl;
                        } else {
                            // try use preview src if available
                            const preview = document.getElementById(el.id + '_preview');
                            if (preview && preview.querySelector('img')) data[name] = preview.querySelector('img').src;
                        }
                    } else if (el.type === 'checkbox') {
                        data[name] = el.checked;
                    } else {
                        data[name] = el.value;
                    }
                }
                return data;
            }

            async function saveDraft() {
                try {
                    const data = await serializeForm();
                    localStorage.setItem('mariageDraft', JSON.stringify(data));
                    // Try to save to server-side draft (if user authenticated)
                    saveDraftToServer(data).catch(err => {
                        // ignore server errors (user might be guest)
                        // console.debug('Server autosave failed', err);
                    });
                } catch (e) {
                    console.error('Erreur sauvegarde auto:', e);
                }
            }

            // Save draft to server. Returns draft id.
            async function saveDraftToServer(data) {
                try {
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (!csrf) return null;
                    const existingId = localStorage.getItem('mariageDraftServerId');
                    const body = { data };
                    if (existingId) body.id = existingId;

                    const res = await fetch('/mariage-drafts', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(body),
                    });

                    if (!res.ok) {
                        // If unauthorized or forbidden, stop trying
                        return null;
                    }

                    const json = await res.json();
                    if (json.id) localStorage.setItem('mariageDraftServerId', json.id);
                    return json.id || null;
                } catch (e) {
                    // swallow errors
                    return null;
                }
            }

            async function restoreDraft() {
                const raw = localStorage.getItem('mariageDraft');
                if (!raw) return;
                const data = JSON.parse(raw);
                for (const key in data) {
                    const value = data[key];
                    // try find element by name
                    const el = form.querySelector(`[name="${key}"]`);
                    if (!el) continue;
                    if (el.type === 'file') {
                        // set preview only (we can't programmatically set File inputs)
                        const previewId = el.id + '_preview';
                        if (value) {
                            const previewEl = document.getElementById(previewId) || (function(){ const d=document.createElement('div'); d.id=previewId; return d; })();
                            previewEl.innerHTML = '';
                            const img = document.createElement('img'); img.src = value; img.style.maxWidth='200px'; img.style.maxHeight='200px'; previewEl.appendChild(img);
                            previewEl.style.display='block';
                            if (!document.getElementById(previewId)) el.parentNode.appendChild(previewEl);
                        }
                    } else if (el.type === 'checkbox') {
                        el.checked = !!value;
                    } else {
                        el.value = value;
                    }
                }
            }

            // Offer restore if draft exists
            if (localStorage.getItem('mariageDraft')) {
                if (confirm('Un brouillon existe. Voulez-vous restaurer les données sauvegardées automatiquement ?')) {
                    restoreDraft().then(() => { updateProgress(); });
                }
            }

            // Periodic autosave
            setInterval(saveDraft, 30000);

            // Inject a preview button next to submit if not present
            (function injectPreviewButton(){
                const submit = form.querySelector('button[type="submit"]');
                if (!submit) return;
                if (!document.getElementById('previewBtn')){
                    const btn = document.createElement('button'); btn.type='button'; btn.id='previewBtn'; btn.className='btn btn-outline-primary me-2'; btn.textContent='Prévisualiser';
                    submit.parentNode.insertBefore(btn, submit);
                    btn.addEventListener('click', async function(){
                        // build preview summary
                        const data = await serializeForm();
                        let html = '<div style="max-height:60vh; overflow:auto;">';
                        for (const k in data){
                            if (!data[k]) continue;
                            if (k.includes('photo') && data[k].startsWith('data:')) {
                                html += `<div class="mb-2"><strong>${k}:</strong><br/><img src="${data[k]}" style="max-width:250px; max-height:200px;"/></div>`;
                            } else {
                                html += `<div class="mb-1"><strong>${k}:</strong> ${String(data[k]).substring(0,200)}</div>`;
                            }
                        }
                        html += '</div>';
                        // show modal
                        const modalId = 'previewModal';
                        let modal = document.getElementById(modalId);
                        if (!modal){
                            modal = document.createElement('div'); modal.id = modalId; modal.className='modal fade'; modal.tabIndex=-1; modal.innerHTML = `\n<div class="modal-dialog modal-lg">\n  <div class="modal-content">\n    <div class="modal-header">\n      <h5 class="modal-title">Prévisualisation du dossier</h5>\n      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n    </div>\n    <div class="modal-body">${html}</div>\n    <div class="modal-footer">\n      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>\n      <button type="button" id="confirmSubmit" class="btn btn-success">Confirmer et soumettre</button>\n    </div>\n  </div>\n</div>`;
                            document.body.appendChild(modal);
                            document.getElementById('confirmSubmit').addEventListener('click', function(){
                                // before submit, ensure required photos exist
                                if (!checkPhotosBeforeSubmit()) { alert('Les trois photos (époux, épouse, couple) sont requises.'); return; }
                                // clear draft and submit
                                localStorage.removeItem('mariageDraft');
                                form.submit();
                            });
                        } else {
                            // update body
                            modal.querySelector('.modal-body').innerHTML = html;
                        }
                        const bsModal = new bootstrap.Modal(modal); bsModal.show();
                    });
                }
            })();

            // Validate presence of three photos before submit
            function checkPhotosBeforeSubmit(){
                const epoux = document.getElementById('epoux_photo');
                const epouse = document.getElementById('epouse_photo');
                const couple = document.getElementById('couple_photo');
                const hasEpoux = (epoux && (epoux.files && epoux.files.length > 0)) || (document.getElementById('epoux_photo_preview')?.querySelector('img'));
                const hasEpouse = (epouse && (epouse.files && epouse.files.length > 0)) || (document.getElementById('epouse_photo_preview')?.querySelector('img'));
                const hasCouple = (couple && (couple.files && couple.files.length > 0)) || (document.getElementById('couple_photo_preview')?.querySelector('img'));
                return !!(hasEpoux && hasEpouse && hasCouple);
            }

            // Intercept final submit to enforce photo check and save draft
            form.addEventListener('submit', function(e){
                if (!checkPhotosBeforeSubmit()){
                    e.preventDefault();
                    alert('Veuillez fournir les trois photos requises : époux, épouse et couple.');
                    return false;
                }
                // clear draft on successful submit
                localStorage.removeItem('mariageDraft');
            });

        });
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
                alert('Veuillez saisir au moins le nom et le prénom du père de l\'épouse.');
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

            alert('Données du père de l\'épouse chargées avec succès dans Ayant Droit.');
            document.getElementById('load_pere_epouse').value = '';
        }

        document.getElementById('btn_load_pere')?.addEventListener('click', function() {
            loadPereEpouseData();
        });

        // Convert certain text inputs into select dropdowns with default values
        (function() {
            const provinces = @json($provinces ?? []);
            const defaultOptions = {
                nationalite: ['Non renseigné', 'Congolaise',  'Burundaise', 'Autre'],
                profession: ['Non renseigné', 'Agriculteur', 'Commerçant', 'Fonctionnaire', 'Étudiant', 'Autre'],
                district: ['Non renseigné'],
                secteur: ['Non renseigné'],
                territoire: ['Non renseigné'],
                lieu_naissance: ['Non renseigné']
            };

            function createSelect(name, id, classes, required, options, currentValue) {
                const select = document.createElement('select');
                if (id) select.id = id;
                if (name) select.name = name;
                select.className = classes || 'form-control';
                if (required) select.required = true;

                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = 'Sélectionnez...';
                select.appendChild(placeholder);

                options.forEach(opt => {
                    const o = document.createElement('option');
                    o.value = opt;
                    o.textContent = opt;
                    if (currentValue && currentValue === opt) o.selected = true;
                    select.appendChild(o);
                });

                // If no current value, select a sensible default if provided (first option after placeholder)
                if (!currentValue && options.length > 0) {
                    const first = options[0];
                    const optIndex = Array.from(select.options).findIndex(x => x.value === first);
                    if (optIndex > -1) select.selectedIndex = optIndex + 1; // +1 because placeholder
                }

                return select;
            }

            function replaceInputWithSelect(id, opts) {
                const el = document.getElementById(id);
                if (!el) return;
                if (el.tagName.toLowerCase() === 'select') return; // already a select

                const name = el.getAttribute('name') || '';
                const classes = el.className || 'form-control';
                const required = el.required;
                const currentValue = el.value || '';

                const select = createSelect(name, id, classes, required, opts, currentValue);
                el.parentNode.replaceChild(select, el);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const prefixes = ['epoux','epouse','pere_epoux','mere_epoux','pere_epouse','mere_epouse','temoin_epoux','temoin_epouse','ayant_droit'];
                const fields = ['district','province','nationalite','profession','lieu_naissance','secteur','territoire'];

                prefixes.forEach(p => {
                    fields.forEach(f => {
                        const id = `${p}_${f}`;
                        let opts = defaultOptions[f] || ['Non renseigné'];
                        if (f === 'province' && Array.isArray(provinces) && provinces.length) {
                            opts = provinces;
                        }
                        replaceInputWithSelect(id, opts);
                    });
                });
            });
        })();
    </script>
@endsection
