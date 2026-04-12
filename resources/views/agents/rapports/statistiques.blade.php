@extends('layouts.agents.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 font-weight-bolder text-dark">
                        <i class="fas fa-chart-bar text-primary me-2"></i>Statistiques Géographiques
                    </h1>
                    <p class="text-muted mt-1">Analyse des mariages par localité</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('agent.rapports.statistiques.export', request()->query()) }}"
                       class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Exporter PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Filtres -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h6 class="mb-3 font-weight-bold">
                                        <i class="fas fa-filter text-primary me-2"></i>Filtres
                                    </h6>
                                    <form method="GET" class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Type de Groupement</label>
                                            <select name="type" class="form-select" onchange="this.form.submit()">
                                                <option value="province" {{ request('type') == 'province' ? 'selected' : '' }}>
                                                    <i class="fas fa-city"></i> Par Province
                                                </option>
                                                <option value="district" {{ request('type') == 'district' ? 'selected' : '' }}>
                                                    <i class="fas fa-map"></i> Par District
                                                </option>
                                                <option value="commune" {{ request('type') == 'commune' ? 'selected' : '' }}>
                                                    <i class="fas fa-map-pin"></i> Par Commune
                                                </option>
                                                <option value="secteur" {{ request('type') == 'secteur' ? 'selected' : '' }}>
                                                    <i class="fas fa-map-marker"></i> Par Secteur
                                                </option>
                                                <option value="territoire" {{ request('type') == 'territoire' ? 'selected' : '' }}>
                                                    <i class="fas fa-flag"></i> Par Territoire
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Année</label>
                                            <select name="annee" class="form-select" onchange="this.form.submit()">
                                                @for($i = date('Y'); $i >= date('Y') - 10; $i--)
                                                    <option value="{{ $i }}" {{ request('annee', date('Y')) == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Mois (Optionnel)</label>
                                            <select name="mois" class="form-select" onchange="this.form.submit()">
                                                <option value="">-- Tous les mois --</option>
                                                @for($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{ request('mois') == $i ? 'selected' : '' }}>
                                                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques générales -->
                    <div class="row mb-4 mt-4">
                        <div class="col-md-4">
                            <div class="card border-0 bg-gradient-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-ring fa-3x mb-3 opacity-7"></i>
                                    <h3 class="mb-1">{{ $totalMariages }}</h3>
                                    <p class="mb-0 small">Mariages Enregistrés</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-gradient-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-tasks fa-3x mb-3 opacity-7"></i>
                                    <h3 class="mb-1">{{ $parStatus->count() }}</h3>
                                    <p class="mb-0 small">Différents Statuts</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-gradient-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marked-alt fa-3x mb-3 opacity-7"></i>
                                    <h3 class="mb-1">{{ $statistiques->count() }}</h3>
                                    <p class="mb-0 small">{{ ucfirst(request('type', 'Province')) }}s Couvertes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques par localisation -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4">
                            <h6 class="mb-0 font-weight-bold">
                                <i class="fas fa-table text-primary me-2"></i>Répartition par {{ ucfirst(request('type', 'province')) }}
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>{{ ucfirst(request('type', 'Province')) }}</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Époux</th>
                                        <th class="text-center">Épouses</th>
                                        @if(request('type') == 'province')
                                            <th class="text-center">Âge Moyen<br><small>(Époux/Épouse)</small></th>
                                        @endif
                                        <th>Statuts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($statistiques as $stat)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-gradient-primary text-white me-2">
                                                        <i class="fas fa-{{ request('type') == 'province' ? 'city' : 'map-pin' }}"></i>
                                                    </div>
                                                    <span class="font-weight-bold">{{ $stat['localisation'] }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-primary">{{ $stat['total'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info-light text-info">{{ $stat['hommes'] ?? '-' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-light text-danger">{{ $stat['femmes'] ?? '-' }}</span>
                                            </td>
                                            @if(request('type') == 'province')
                                                <td class="text-center">
                                                    <small class="text-muted">
                                                        {{ number_format($stat['moyenne_age_epoux'] ?? 0, 1) }} / {{ number_format($stat['moyenne_age_epouse'] ?? 0, 1) }} ans
                                                    </small>
                                                </td>
                                            @endif
                                            <td>
                                                @if(isset($stat['par_status']))
                                                    <div class="d-flex gap-1 flex-wrap">
                                                        @foreach($stat['par_status'] as $status => $count)
                                                            <span class="badge bg-light text-dark" title="{{ $status }}">
                                                                {{ substr($status, 0, 3) }}: <strong>{{ $count }}</strong>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Statistiques démographiques -->
                    @if(request('type') == 'province')
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom p-4">
                                    <h6 class="mb-0 font-weight-bold">
                                        <i class="fas fa-passport text-info me-2"></i>Nationalités des Époux
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        @foreach($statsDemographiques['par_nationalite_epoux'] as $nationalite => $count)
                                            <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0 border-bottom">
                                                <span class="text-sm">{{ $nationalite ?? 'Non spécifié' }}</span>
                                                <span class="badge bg-info-light text-info">{{ $count }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom p-4">
                                    <h6 class="mb-0 font-weight-bold">
                                        <i class="fas fa-passport text-danger me-2"></i>Nationalités des Épouses
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        @foreach($statsDemographiques['par_nationalite_epouse'] as $nationalite => $count)
                                            <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0 border-bottom">
                                                <span class="text-sm">{{ $nationalite ?? 'Non spécifié' }}</span>
                                                <span class="badge bg-danger-light text-danger">{{ $count }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection