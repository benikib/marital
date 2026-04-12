@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 font-weight-bolder text-dark">Tableau de Bord</h1>
                        <p class="text-muted mt-1">Bienvenue dans le système de gestion des mariages</p>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-2"></i>Exporter
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-refresh me-2"></i>Actualiser
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-3">
            <!-- Total des mariages -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 transition-all" style="border-left: 4px solid #3A416F;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-sm mb-1 font-weight-bold">
                                    <i class="fas fa-ring me-2 text-primary"></i>Total Mariages
                                </p>
                                <h2 class="h2 font-weight-bolder text-dark mb-2">{{ $totalMariages }}</h2>
                                <p class="text-sm mb-0">
                                    <span class="badge bg-success-light text-success">
                                        <i class="fas fa-arrow-up me-1"></i>
                                        +{{ $mariagesParMois->last()->total ?? 0 }} ce mois
                                    </span>
                                </p>
                            </div>
                            <div class="icon icon-shape bg-gradient-primary text-white rounded-lg p-3">
                                <i class="fas fa-heart text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total des utilisateurs -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 transition-all" style="border-left: 4px solid #E74C3C;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-sm mb-1 font-weight-bold">
                                    <i class="fas fa-users me-2 text-danger"></i>Utilisateurs Actifs
                                </p>
                                <h2 class="h2 font-weight-bolder text-dark mb-2">{{ $totalUsers }}</h2>
                                <p class="text-sm mb-0">
                                    <span class="badge bg-info-light text-info">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Tous actifs
                                    </span>
                                </p>
                            </div>
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-lg p-3">
                                <i class="fas fa-user-check text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total des provinces -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 transition-all" style="border-left: 4px solid #27AE60;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-sm mb-1 font-weight-bold">
                                    <i class="fas fa-map-marker-alt me-2 text-success"></i>Provinces
                                </p>
                                <h2 class="h2 font-weight-bolder text-dark mb-2">{{ $totalProvinces }}</h2>
                                <p class="text-sm mb-0">
                                    <span class="badge bg-success-light text-success">
                                        <i class="fas fa-globe me-1"></i>
                                        Couvertes
                                    </span>
                                </p>
                            </div>
                            <div class="icon icon-shape bg-gradient-success text-white rounded-lg p-3">
                                <i class="fas fa-map text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mariages par statut -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 transition-all" style="border-left: 4px solid #F39C12;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-sm mb-1 font-weight-bold">
                                    <i class="fas fa-hourglass-half me-2 text-warning"></i>En Cours
                                </p>
                                <h2 class="h2 font-weight-bolder text-dark mb-2">
                                    {{ $mariagesParStatut->where('nom', 'En cours de traitement')->first()->total ?? 0 }}
                                </h2>
                                <p class="text-sm mb-0">
                                    <span class="badge bg-warning-light text-warning">
                                        <i class="fas fa-spinner me-1"></i>
                                        En traitement
                                    </span>
                                </p>
                            </div>
                            <div class="icon icon-shape bg-gradient-warning text-white rounded-lg p-3">
                                <i class="fas fa-tasks text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-3 mt-2">
            <!-- Evolution des mariages Chart -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 font-weight-bold text-dark">
                                    <i class="fas fa-chart-line text-primary me-2"></i>Évolution des Mariages
                                </h6>
                                <p class="text-muted text-sm mb-0">Tendance des 6 derniers mois</p>
                            </div>
                            <div class="badge bg-light text-primary">
                                <i class="fas fa-arrow-up me-1"></i>+15% ce mois
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 5 Provinces -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom p-3">
                        <h6 class="mb-0 font-weight-bold text-dark">
                            <i class="fas fa-crown text-warning me-2"></i>Top 5 Provinces
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group list-group-flush">
                            @foreach ($mariagesParProvince as $index => $province)
                                <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-0 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-gradient-primary rounded-circle p-3 me-3">
                                            <span class="text-white font-weight-bold">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 text-dark">{{ $province->province }}</h6>
                                            <p class="text-muted text-sm mb-0">{{ $province->total }} mariages</p>
                                        </div>
                                    </div>
                                    <div class="badge bg-light-primary text-primary">
                                        {{ round(($province->total / $totalMariages) * 100, 1) }}%
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Marriages Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 font-weight-bold text-dark">
                                    <i class="fas fa-history text-info me-2"></i>Derniers Mariages Enregistrés
                                </h6>
                                <p class="text-muted text-sm mb-0">10 dernier enregistrements</p>
                            </div>
                            <a href="{{ route('mariages.index') }}" class="btn btn-sm btn-outline-primary">
                                Voir tout <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-muted text-xxs font-weight-bold">Date</th>
                                    <th class="text-uppercase text-muted text-xxs font-weight-bold">Époux</th>
                                    <th class="text-uppercase text-muted text-xxs font-weight-bold">Épouse</th>
                                    <th class="text-uppercase text-muted text-xxs font-weight-bold">Province</th>
                                    <th class="text-uppercase text-muted text-xxs font-weight-bold">Statut</th>
                                    <th class="text-uppercase text-muted text-xxs font-weight-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($derniersMariages as $mariage)
                                    <tr class="border-bottom hover-bg-light">
                                        <td class="align-middle">
                                            <span class="badge bg-light text-dark">
                                                {{ $mariage->date_mariage->format('d/m/Y') }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2 bg-gradient-primary text-white rounded">
                                                    {{ substr($mariage->epoux->prenom, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2 bg-gradient-danger text-white rounded">
                                                    {{ substr($mariage->epouse->prenom, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-sm text-muted">{{ $mariage->epoux->province }}</span>
                                        </td>
                                        <td class="align-middle">
                                            @php
                                                $badgeClass = match($mariage->status->nom) {
                                                    'Validé' => 'bg-success-light text-success',
                                                    'En cours de traitement' => 'bg-warning-light text-warning',
                                                    default => 'bg-danger-light text-danger'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ $mariage->status->nom }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('mariages.show', $mariage) }}" class="btn btn-outline-primary btn-sm" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('mariages.edit', $mariage) }}" class="btn btn-outline-secondary btn-sm" title="Éditer">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Données pour le graphique
                const mariagesData = @json($mariagesParMois);
                const labels = mariagesData.map(item => {
                    const [year, month] = item.mois.split('-');
                    return new Date(year, month - 1).toLocaleDateString('fr-FR', {
                        month: 'long',
                        year: 'numeric'
                    });
                });
                const data = mariagesData.map(item => item.total);

                // Configuration du graphique
                const ctx = document.getElementById('chart-line').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Nombre de mariages',
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: '#3A416F',
                            borderWidth: 3,
                            backgroundColor: 'rgba(58, 65, 111, 0.2)',
                            fill: true,
                            data: data,
                            maxBarThickness: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#b2b9bf',
                                    font: {
                                        size: 11,
                                        family: 'Open Sans',
                                        style: 'normal',
                                        lineHeight: 2
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#b2b9bf',
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        family: 'Open Sans',
                                        style: 'normal',
                                        lineHeight: 2
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection