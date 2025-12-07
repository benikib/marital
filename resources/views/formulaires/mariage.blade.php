@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Formulaire de Mariage</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mariages.store') }}" method="POST" id="mariageForm">
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
                            </ul>

                            <!-- Contenu des onglets -->
                            <div class="tab-content p-3 border border-top-0 rounded-bottom" id="mariageTabsContent">
                                <!-- Onglet Époux -->
                                <div class="tab-pane fade show active" id="epoux" role="tabpanel">
                                    <h6 class="mb-3">Informations de l'Époux</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="epoux_nom" name="epoux[nom]"
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="epoux_prenom" name="epoux[prenom]"
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_postnom" class="form-label">Postnom</label>
                                            <input type="text" class="form-control" id="epoux_postnom" name="epoux[postnom]"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_profession" class="form-label">Profession</label>
                                            <input type="text" class="form-control" id="epoux_profession"
                                                name="epoux[profession]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_adresse" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="epoux_adresse" name="epoux[adresse]"
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_district" class="form-label">District</label>
                                            <input type="text" class="form-control" id="epoux_district"
                                                name="epoux[district]" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_province" class="form-label">Province</label>
                                            <select class="form-select" id="epoux_province" name="epoux[province]" required>
                                                <option value="">Sélectionner une province</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->nom }}">{{ $province->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_nationalite" class="form-label">Nationalité</label>
                                            <input type="text" class="form-control" id="epoux_nationalite"
                                                name="epoux[nationalite]" value="Congolaise" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_date_naissance" class="form-label">Date de naissance</label>
                                            <input type="date" class="form-control" id="epoux_date_naissance"
                                                name="epoux[date_naissance]" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_lieu_naissance" class="form-label">Lieu de naissance</label>
                                            <input type="text" class="form-control" id="epoux_lieu_naissance"
                                                name="epoux[lieu_naissance]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_secteur" class="form-label">Secteur</label>
                                            <input type="text" class="form-control" id="epoux_secteur" name="epoux[secteur]"
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epoux_territoire" class="form-label">Territoire</label>
                                            <input type="text" class="form-control" id="epoux_territoire"
                                                name="epoux[territoire]" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Épouse -->
                                <div class="tab-pane fade" id="epouse" role="tabpanel">
                                    <h6 class="mb-3">Informations de l'Épouse</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="epouse_nom" name="epouse[nom]"
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="epouse_prenom" name="epouse[prenom]"
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_postnom" class="form-label">Postnom</label>
                                            <input type="text" class="form-control" id="epouse_postnom"
                                                name="epouse[postnom]" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_profession" class="form-label">Profession</label>
                                            <input type="text" class="form-control" id="epouse_profession"
                                                name="epouse[profession]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_adresse" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="epouse_adresse"
                                                name="epouse[adresse]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_district" class="form-label">District</label>
                                            <input type="text" class="form-control" id="epouse_district"
                                                name="epouse[district]" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_province" class="form-label">Province</label>
                                            <select class="form-select" id="epouse_province" name="epouse[province]"
                                                required>
                                                <option value="">Sélectionner une province</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->nom }}">{{ $province->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_nationalite" class="form-label">Nationalité</label>
                                            <input type="text" class="form-control" id="epouse_nationalite"
                                                name="epouse[nationalite]" value="Congolaise" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_date_naissance" class="form-label">Date de
                                                naissance</label>
                                            <input type="date" class="form-control" id="epouse_date_naissance"
                                                name="epouse[date_naissance]" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_lieu_naissance" class="form-label">Lieu de
                                                naissance</label>
                                            <input type="text" class="form-control" id="epouse_lieu_naissance"
                                                name="epouse[lieu_naissance]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_secteur" class="form-label">Secteur</label>
                                            <input type="text" class="form-control" id="epouse_secteur"
                                                name="epouse[secteur]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="epouse_territoire" class="form-label">Territoire</label>
                                            <input type="text" class="form-control" id="epouse_territoire"
                                                name="epouse[territoire]" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Parents Époux -->
                                <div class="tab-pane fade" id="parents-epoux" role="tabpanel">
                                    <h6 class="mb-3">Parents de l'Époux</h6>

                                    <!-- Père -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0">Père</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="pere_epoux_nom"
                                                        name="parents_epoux[pere][nom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="pere_epoux_prenom"
                                                        name="parents_epoux[pere][prenom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_postnom" class="form-label">Postnom</label>
                                                    <input type="text" class="form-control" id="pere_epoux_postnom"
                                                        name="parents_epoux[pere][postnom]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_profession" class="form-label">Profession</label>
                                                    <input type="text" class="form-control" id="pere_epoux_profession"
                                                        name="parents_epoux[pere][profession]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="pere_epoux_adresse"
                                                        name="parents_epoux[pere][adresse]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_enVie" class="form-label">En vie</label>
                                                    <select class="form-select" id="pere_epoux_enVie"
                                                        name="parents_epoux[pere][enVie]" required>
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_province" class="form-label">Province</label>
                                                    <select class="form-select" id="pere_epoux_province"
                                                        name="parents_epoux[pere][province]" required>
                                                        <option value="">Sélectionner une province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->nom }}">{{ $province->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_date_naissance" class="form-label">Date de
                                                        naissance</label>
                                                    <input type="date" class="form-control" id="pere_epoux_date_naissance"
                                                        name="parents_epoux[pere][date_naissance]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_lieu_naissance" class="form-label">Lieu de
                                                        naissance</label>
                                                    <input type="text" class="form-control" id="pere_epoux_lieu_naissance"
                                                        name="parents_epoux[pere][lieu_naissance]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epoux_nationalite"
                                                        class="form-label">Nationalité</label>
                                                    <input type="text" class="form-control" id="pere_epoux_nationalite"
                                                        name="parents_epoux[pere][nationalite]" value="Congolaise" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mère -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Mère</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="mere_epoux_nom"
                                                        name="parents_epoux[mere][nom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="mere_epoux_prenom"
                                                        name="parents_epoux[mere][prenom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_postnom" class="form-label">Postnom</label>
                                                    <input type="text" class="form-control" id="mere_epoux_postnom"
                                                        name="parents_epoux[mere][postnom]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_profession" class="form-label">Profession</label>
                                                    <input type="text" class="form-control" id="mere_epoux_profession"
                                                        name="parents_epoux[mere][profession]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="mere_epoux_adresse"
                                                        name="parents_epoux[mere][adresse]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_enVie" class="form-label">En vie</label>
                                                    <select class="form-select" id="mere_epoux_enVie"
                                                        name="parents_epoux[mere][enVie]" required>
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_province" class="form-label">Province</label>
                                                    <select class="form-select" id="mere_epoux_province"
                                                        name="parents_epoux[mere][province]" required>
                                                        <option value="">Sélectionner une province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->nom }}">{{ $province->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_date_naissance" class="form-label">Date de
                                                        naissance</label>
                                                    <input type="date" class="form-control" id="mere_epoux_date_naissance"
                                                        name="parents_epoux[mere][date_naissance]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_lieu_naissance" class="form-label">Lieu de
                                                        naissance</label>
                                                    <input type="text" class="form-control" id="mere_epoux_lieu_naissance"
                                                        name="parents_epoux[mere][lieu_naissance]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epoux_nationalite"
                                                        class="form-label">Nationalité</label>
                                                    <input type="text" class="form-control" id="mere_epoux_nationalite"
                                                        name="parents_epoux[mere][nationalite]" value="Congolaise" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Parents Épouse -->
                                <div class="tab-pane fade" id="parents-epouse" role="tabpanel">
                                    <h6 class="mb-3">Parents de l'Épouse</h6>

                                    <!-- Père -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0">Père</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="pere_epouse_nom"
                                                        name="parents_epouse[pere][nom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="pere_epouse_prenom"
                                                        name="parents_epouse[pere][prenom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_postnom" class="form-label">Postnom</label>
                                                    <input type="text" class="form-control" id="pere_epouse_postnom"
                                                        name="parents_epouse[pere][postnom]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_profession"
                                                        class="form-label">Profession</label>
                                                    <input type="text" class="form-control" id="pere_epouse_profession"
                                                        name="parents_epouse[pere][profession]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="pere_epouse_adresse"
                                                        name="parents_epouse[pere][adresse]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_enVie" class="form-label">En vie</label>
                                                    <select class="form-select" id="pere_epouse_enVie"
                                                        name="parents_epouse[pere][enVie]" required>
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_province" class="form-label">Province</label>
                                                    <select class="form-select" id="pere_epouse_province"
                                                        name="parents_epouse[pere][province]" required>
                                                        <option value="">Sélectionner une province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->nom }}">{{ $province->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_date_naissance" class="form-label">Date de
                                                        naissance</label>
                                                    <input type="date" class="form-control" id="pere_epouse_date_naissance"
                                                        name="parents_epouse[pere][date_naissance]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_lieu_naissance" class="form-label">Lieu de
                                                        naissance</label>
                                                    <input type="text" class="form-control" id="pere_epouse_lieu_naissance"
                                                        name="parents_epouse[pere][lieu_naissance]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pere_epouse_nationalite"
                                                        class="form-label">Nationalité</label>
                                                    <input type="text" class="form-control" id="pere_epouse_nationalite"
                                                        name="parents_epouse[pere][nationalite]" value="Congolaise"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mère -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Mère</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="mere_epouse_nom"
                                                        name="parents_epouse[mere][nom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="mere_epouse_prenom"
                                                        name="parents_epouse[mere][prenom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_postnom" class="form-label">Postnom</label>
                                                    <input type="text" class="form-control" id="mere_epouse_postnom"
                                                        name="parents_epouse[mere][postnom]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_profession"
                                                        class="form-label">Profession</label>
                                                    <input type="text" class="form-control" id="mere_epouse_profession"
                                                        name="parents_epouse[mere][profession]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="mere_epouse_adresse"
                                                        name="parents_epouse[mere][adresse]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_enVie" class="form-label">En vie</label>
                                                    <select class="form-select" id="mere_epouse_enVie"
                                                        name="parents_epouse[mere][enVie]" required>
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_province" class="form-label">Province</label>
                                                    <select class="form-select" id="mere_epouse_province"
                                                        name="parents_epouse[mere][province]" required>
                                                        <option value="">Sélectionner une province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->nom }}">{{ $province->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_date_naissance" class="form-label">Date de
                                                        naissance</label>
                                                    <input type="date" class="form-control" id="mere_epouse_date_naissance"
                                                        name="parents_epouse[mere][date_naissance]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_lieu_naissance" class="form-label">Lieu de
                                                        naissance</label>
                                                    <input type="text" class="form-control" id="mere_epouse_lieu_naissance"
                                                        name="parents_epouse[mere][lieu_naissance]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="mere_epouse_nationalite"
                                                        class="form-label">Nationalité</label>
                                                    <input type="text" class="form-control" id="mere_epouse_nationalite"
                                                        name="parents_epouse[mere][nationalite]" value="Congolaise"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onglet Témoins -->
                                <div class="tab-pane fade" id="temoins" role="tabpanel">
                                    <h6 class="mb-3">Témoins</h6>

                                    <!-- Témoin Époux -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0">Témoin de l'Époux</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_nom"
                                                        name="temoins[epoux][nom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_prenom"
                                                        name="temoins[epoux][prenom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_postnom" class="form-label">Postnom</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_postnom"
                                                        name="temoins[epoux][postnom]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_profession"
                                                        class="form-label">Profession</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_profession"
                                                        name="temoins[epoux][profession]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_adresse"
                                                        name="temoins[epoux][adresse]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_etat_civil" class="form-label">État
                                                        civil</label>
                                                    <select class="form-select" id="temoin_epoux_etat_civil"
                                                        name="temoins[epoux][etat_civil]" required>
                                                        <option value="Célibataire">Célibataire</option>
                                                        <option value="Marié(e)">Marié(e)</option>
                                                        <option value="Divorcé(e)">Divorcé(e)</option>
                                                        <option value="Veuf(ve)">Veuf(ve)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_province" class="form-label">Province</label>
                                                    <select class="form-select" id="temoin_epoux_province"
                                                        name="temoins[epoux][province]" required>
                                                        <option value="">Sélectionner une province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->nom }}">{{ $province->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_date_naissance" class="form-label">Date de
                                                        naissance</label>
                                                    <input type="date" class="form-control" id="temoin_epoux_date_naissance"
                                                        name="temoins[epoux][date_naissance]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_lieu_naissance" class="form-label">Lieu de
                                                        naissance</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_lieu_naissance"
                                                        name="temoins[epoux][lieu_naissance]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epoux_nationalite"
                                                        class="form-label">Nationalité</label>
                                                    <input type="text" class="form-control" id="temoin_epoux_nationalite"
                                                        name="temoins[epoux][nationalite]" value="Congolaise" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Témoin Épouse -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Témoin de l'Épouse</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="temoin_epouse_nom"
                                                        name="temoins[epouse][nom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="temoin_epouse_prenom"
                                                        name="temoins[epouse][prenom]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_postnom" class="form-label">Postnom</label>
                                                    <input type="text" class="form-control" id="temoin_epouse_postnom"
                                                        name="temoins[epouse][postnom]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_profession"
                                                        class="form-label">Profession</label>
                                                    <input type="text" class="form-control" id="temoin_epouse_profession"
                                                        name="temoins[epouse][profession]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="temoin_epouse_adresse"
                                                        name="temoins[epouse][adresse]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_etat_civil" class="form-label">État
                                                        civil</label>
                                                    <select class="form-select" id="temoin_epouse_etat_civil"
                                                        name="temoins[epouse][etat_civil]" required>
                                                        <option value="Célibataire">Célibataire</option>
                                                        <option value="Marié(e)">Marié(e)</option>
                                                        <option value="Divorcé(e)">Divorcé(e)</option>
                                                        <option value="Veuf(ve)">Veuf(ve)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_province" class="form-label">Province</label>
                                                    <select class="form-select" id="temoin_epouse_province"
                                                        name="temoins[epouse][province]" required>
                                                        <option value="">Sélectionner une province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->nom }}">{{ $province->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_date_naissance" class="form-label">Date de
                                                        naissance</label>
                                                    <input type="date" class="form-control"
                                                        id="temoin_epouse_date_naissance"
                                                        name="temoins[epouse][date_naissance]" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_lieu_naissance" class="form-label">Lieu de
                                                        naissance</label>
                                                    <input type="text" class="form-control"
                                                        id="temoin_epouse_lieu_naissance"
                                                        name="temoins[epouse][lieu_naissance]" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="temoin_epouse_nationalite"
                                                        class="form-label">Nationalité</label>
                                                    <input type="text" class="form-control" id="temoin_epouse_nationalite"
                                                        name="temoins[epouse][nationalite]" value="Congolaise" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons de soumission -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-secondary me-2"
                                    onclick="resetForm()">Réinitialiser</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour réinitialiser le formulaire
        function resetForm() {
            if (confirm('Êtes-vous sûr de vouloir réinitialiser le formulaire ?')) {
                document.getElementById('mariageForm').reset();
            }
        }

        // Validation des dates de naissance
        document.addEventListener('DOMContentLoaded', function () {
            const dateInputs = document.querySelectorAll('input[type="date"]');
            const today = new Date();
            const minAge = 18;
            const maxAge = 100;

            dateInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const selectedDate = new Date(this.value);
                    const age = today.getFullYear() - selectedDate.getFullYear();

                    if (age < minAge || age > maxAge) {
                        alert(`L'âge doit être compris entre ${minAge} et ${maxAge} ans.`);
                        this.value = '';
                    }
                });
            });
        });
    </script>
@endsection