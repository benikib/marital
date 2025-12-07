@extends('layouts.agents.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Détails du Mariage #{{ $mariage->id }}</h6>
                        <div>
                            <a href="{{ route('certification', $mariage) }}" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-show"></i> Voir
                            </a>
                            <a href="{{ route('mariages.edit', $mariage) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>


                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Onglets -->
                        <ul class="nav nav-tabs" id="mariageTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="epoux-tab" data-bs-toggle="tab" data-bs-target="#epoux"
                                    type="button" role="tab">
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
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->nom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->prenom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->postnom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->profession }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->adresse }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>District :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->district }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->province }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->nationalite }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->date_naissance }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->lieu_naissance }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Secteur :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->secteur }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Territoire :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->territoire }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">Photo de l'époux</h6>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        @if ($mariage->epoux->url_photo)
                                                            <img src="{{ $mariage->epoux->url_photo }}"
                                                                alt="Photo de {{ $mariage->epoux->prenom }} {{ $mariage->epoux->nom }}"
                                                                class="img-fluid rounded" style="max-height: 200px;">
                                                        @else
                                                            <div class="text-muted">
                                                                <i class="fas fa-user fa-3x mb-2"></i>
                                                                <p>Aucune photo disponible</p>
                                                            </div>
                                                        @endif
                                                    </div>
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
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->nom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->prenom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->postnom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->profession }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->adresse }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>District :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->district }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->province }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->nationalite }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->date_naissance }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->lieu_naissance }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Secteur :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->secteur }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Territoire :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->territoire }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">Photo de l'épouse</h6>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        @if ($mariage->epouse->url_photo)
                                                            <img src="{{ $mariage->epouse->url_photo }}"
                                                                alt="Photo de {{ $mariage->epouse->prenom }} {{ $mariage->epouse->nom }}"
                                                                class="img-fluid rounded" style="max-height: 200px;">
                                                        @else
                                                            <div class="text-muted">
                                                                <i class="fas fa-user fa-3x mb-2"></i>
                                                                <p>Aucune photo disponible</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet Parents Époux -->
                            <div class="tab-pane fade" id="parents-epoux" role="tabpanel">
                                <!-- Père -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Père</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->nom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->prenom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->postnom }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->profession }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->adresse }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>État :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->enVie ? 'En vie' : 'Décédé' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->province }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->date_naissance }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->lieu_naissance }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->nationalite }}
                                                </p>
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
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->nom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->prenom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->postnom }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->profession }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->adresse }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>État :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->enVie ? 'En vie' : 'Décédé' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->province }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->date_naissance }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->lieu_naissance }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->nationalite }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet Parents Épouse -->
                            <div class="tab-pane fade" id="parents-epouse" role="tabpanel">
                                <!-- Père -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Père</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->nom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->prenom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->postnom }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->profession }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->adresse }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>État :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->enVie ? 'En vie' : 'Décédé' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->province }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->date_naissance }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->lieu_naissance }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->nationalite }}
                                                </p>
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
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->nom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->prenom }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->postnom }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->profession }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->adresse }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>État :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->enVie ? 'En vie' : 'Décédé' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->province }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->date_naissance }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->lieu_naissance }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">
                                                    {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->nationalite }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet Témoins -->
                            <div class="tab-pane fade" id="temoins" role="tabpanel">
                                <!-- Témoin Époux -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Témoin de l'Époux</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->nom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->prenom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->postnom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->profession }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->adresse }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>État civil :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->etat_civil }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->province }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->date_naissance }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->lieu_naissance }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">{{ $mariage->epoux->temoins->first()->nationalite }}</p>
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
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->nom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Prénom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->prenom }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Postnom :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->postnom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Profession :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->profession }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Adresse :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->adresse }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>État civil :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->etat_civil }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Province :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->province }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Date de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->date_naissance }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Lieu de naissance :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->lieu_naissance }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Nationalité :</strong></p>
                                                <p class="mb-3">{{ $mariage->epouse->temoins->first()->nationalite }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
