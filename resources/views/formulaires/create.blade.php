@extends('layouts.main')

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
                                                            id="url_photo" name="epoux[url_photo]">
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
                                                            id="epouse_url_photo" name="epouse[url_photo]">
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
                                            <h6 class="mb-3">Ayant Droit Coutinier</h6>
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="regime_lieu_coutumier">Lieu du mariage coutumier
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('regime.lieu_mariage_cutinier') is-invalid @enderror"
                                                            id="regime_lieu_coutumier"
                                                            name="regime[lieu_mariage_cutinier]"
                                                            value="{{ old('regime.lieu_mariage_cutinier') }}" required>
                                                        @error('regime.lieu_mariage_cutinier')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="regime_dotation">Dotation coutumière <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control @error('regime.dotation_cutinier') is-invalid @enderror"
                                                            id="regime_dotation" name="regime[dotation_cutinier]"
                                                            value="{{ old('regime.dotation_cutinier') }}" required>
                                                        @error('regime.dotation_cutinier')
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
        // Gestion de la navigation entre les onglets
        document.addEventListener('DOMContentLoaded', function() {
            // Bouton Suivant
            document.querySelectorAll('.next-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const currentTabPane = this.closest('.tab-pane');
                    const inputs = currentTabPane.querySelectorAll(
                        'input[required], select[required], textarea[required]');
                    let isValid = true;

                    // Validation des champs requis
                    inputs.forEach(input => {
                        if (!input.value) {
                            input.classList.add('is-invalid');
                            isValid = false;

                            // Ajouter un message d'erreur si non présent
                            if (!input.nextElementSibling || !input.nextElementSibling
                                .classList.contains('invalid-feedback')) {
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'invalid-feedback';
                                errorDiv.textContent = 'Ce champ est obligatoire';
                                input.parentNode.insertBefore(errorDiv, input.nextSibling);
                            }
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });

                    if (!isValid) {
                        // Faire défiler jusqu'au premier champ invalide
                        const firstInvalid = currentTabPane.querySelector('.is-invalid');
                        if (firstInvalid) {
                            firstInvalid.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                        return;
                    }

                    // Si validation OK, passer à l'onglet suivant
                    const nextTabId = this.getAttribute('data-next-tab');
                    const nextTab = document.querySelector(`#${nextTabId}`);
                    const tabInstance = new bootstrap.Tab(nextTab);
                    tabInstance.show();

                    // Sauvegarder l'onglet actif
                    localStorage.setItem('lastActiveTab', nextTabId);

                    // Faire défiler vers le haut de l'onglet
                    nextTab.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Bouton Précédent
            document.querySelectorAll('.prev-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const prevTabId = this.getAttribute('data-prev-tab');
                    const prevTab = document.querySelector(`#${prevTabId}`);
                    const tabInstance = new bootstrap.Tab(prevTab);
                    tabInstance.show();

                    // Sauvegarder l'onglet actif
                    localStorage.setItem('lastActiveTab', prevTabId);

                    // Faire défiler vers le haut de l'onglet
                    prevTab.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Restaurer l'onglet actif au rechargement
            const lastActiveTab = localStorage.getItem('lastActiveTab');
            if (lastActiveTab) {
                const tab = document.querySelector(`#${lastActiveTab}`);
                if (tab) {
                    const tabInstance = new bootstrap.Tab(tab);
                    tabInstance.show();
                }
            }

            // Gestion des messages d'erreur existants
            document.querySelectorAll('.is-invalid').forEach(input => {
                if (!input.nextElementSibling || !input.nextElementSibling.classList.contains(
                        'invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = input.validationMessage || 'Ce champ est obligatoire';
                    input.parentNode.insertBefore(errorDiv, input.nextSibling);
                }
            });

            // Prévisualisation des images
            function previewImage(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        const previewElement = document.getElementById(previewId);
                        if (!previewElement) {
                            // Créer l'élément de prévisualisation s'il n'existe pas
                            const previewDiv = document.createElement('div');
                            previewDiv.id = previewId;
                            previewDiv.style.display = 'block';
                            previewDiv.style.marginTop = '10px';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '200px';
                            img.style.maxHeight = '200px';

                            previewDiv.appendChild(img);
                            input.parentNode.appendChild(previewDiv);
                        } else {
                            previewElement.querySelector('img').src = e.target.result;
                            previewElement.style.display = 'block';
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.getElementById('epoux_photo')?.addEventListener('change', function() {
                previewImage(this, 'epoux_photo_preview');
            });

            document.getElementById('epouse_photo')?.addEventListener('change', function() {
                previewImage(this, 'epouse_photo_preview');
            });
        });
    </script>
@endsection
