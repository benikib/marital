@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <!-- Header avec statistiques -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header min-height-150 border-radius-xl"
                    style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                        <div class="row gx-4">
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <span class="avatar-initial bg-gradient-primary rounded-circle">
                                        <i class="fas fa-chart-bar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">Vue d'ensemble du Système</h5>
                                    <p class="mb-0 text-sm">Statistiques et gestion des mariages et données associées</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartes de statistiques rapides -->
        <div class="row">
            <!-- Mariages -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card hover-scale">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Mariages</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $totalMariages }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fas fa-heart text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('mariages.index') }}" class="btn btn-sm bg-gradient-primary mb-0">
                                <i class="fas fa-list me-1"></i> Voir tous
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card hover-scale">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Utilisateurs</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $totalUsers }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-users text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-sm bg-gradient-success mb-0">
                                <i class="fas fa-list me-1"></i> Voir tous
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrats -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card hover-scale">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Contrats</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $totalContrats }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="fas fa-file-contract text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('contrats.index') }}" class="btn btn-sm bg-gradient-info mb-0">
                                <i class="fas fa-list me-1"></i> Voir tous
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Régimes -->
            <div class="col-xl-3 col-sm-6">
                <div class="card hover-scale">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Provinces</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $regimesActifs }}/{{ $totalRegimes }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fas fa-balance-scale text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">

                            <i class="fas fa-list me-1"></i> Voir tous

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques détaillées -->
        <div class="row mt-4">
            <!-- Utilisateurs par rôle -->
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Utilisateurs par Rôle</h6>
                            <a href="{{ route('type-roles.index') }}" class="btn btn-sm btn-outline-primary mb-0">
                                <i class="fas fa-cog me-1"></i> Gérer
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group">
                            @foreach ($usersParRole as $role)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $role->nom }}</h6>
                                        <small class="text-muted">{{ $role->users_count }} utilisateurs</small>
                                    </div>
                                    <span class="badge bg-gradient-primary rounded-pill">{{ $role->users_count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrats par type -->
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Contrats par Type</h6>
                            <a href="{{ route('contrats.index') }}" class="btn btn-sm btn-outline-primary mb-0">
                                <i class="fas fa-cog me-1"></i> Gérer
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group">
                            @foreach ($contratsParType as $contrat)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $contrat->type_contrat }}</h6>
                                        <small class="text-muted">{{ $contrat->total }} contrats</small>
                                    </div>
                                    <span class="badge bg-gradient-info rounded-pill">{{ $contrat->total }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mariages par statut -->
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Mariages par Statut</h6>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-0" data-bs-toggle="modal"
                                data-bs-target="#statusModal">
                                <i class="fas fa-cog me-1"></i> Gérer
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group">
                            @foreach ($mariagesParStatus as $status)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $status->nom }}</h6>
                                        <small class="text-muted">{{ $status->total }} mariages</small>
                                    </div>
                                    <span class="badge bg-gradient-success rounded-pill">{{ $status->total }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques géographiques -->
        <div class="row mt-4">
            <!-- Mariages par province -->
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Mariages par Province</h6>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-0" data-bs-toggle="modal"
                                data-bs-target="#provinceModal">
                                <i class="fas fa-cog me-1"></i> Gérer
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Province</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($mariagesParProvince as $province)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $province->province }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-gradient-primary rounded-pill">{{ $province->total }}</span>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mariages par commune -->
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Top 5 Communes</h6>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-0" data-bs-toggle="modal"
                                data-bs-target="#communeModal">
                                <i class="fas fa-cog me-1"></i> Gérer
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Commune</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($mariagesParCommune as $commune)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $commune->commune }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-gradient-success rounded-pill">{{ $commune->total }}</span>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Actions Rapides</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('mariages.create') }}" class="btn btn-lg btn-outline-primary w-100">
                                    <i class="fas fa-plus-circle me-2"></i> Nouveau Mariage
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-lg btn-outline-success w-100"
                                    data-bs-toggle="modal" data-bs-target="#userModal">
                                    <i class="fas fa-user-plus me-2"></i> Nouvel Utilisateur
                                </button>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-lg btn-outline-info w-100" data-bs-toggle="modal"
                                    data-bs-target="#contratModal">
                                    <i class="fas fa-file-signature me-2"></i> Nouveau Contrat
                                </button>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-lg btn-outline-warning w-100"
                                    data-bs-toggle="modal" data-bs-target="#regimeModal">
                                    <i class="fas fa-balance-scale me-2"></i> Nouveau Régime
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-scale {
            transition: all 0.2s ease;
        }

        .hover-scale:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            background-size: cover;
            background-position: center center;
        }

        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .border-radius-lg {
            border-radius: 0.75rem;
        }

        .list-group-item {
            border: none;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .btn-lg {
            padding: 1rem;
            font-size: 1rem;
        }
    </style>
@endsection
