@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Rapport Mensuel des Mariages</h6>
                            </div>
                            <div class="col-6 text-end">
                                <form action="{{ route('rapports.mensuel') }}" method="GET"
                                    class="d-flex justify-content-end gap-2">
                                    <select name="mois" class="form-select" style="width: auto;">
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ $m == $moisActuel ? 'selected' : '' }}>
                                                {{ Carbon\Carbon::create()->month($m)->locale('fr')->isoFormat('MMMM') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="annee" class="form-select" style="width: auto;">
                                        @foreach(range(date('Y') - 2, date('Y')) as $a)
                                            <option value="{{ $a }}" {{ $a == $anneeActuelle ? 'selected' : '' }}>
                                                {{ $a }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                    <a href="{{ route('rapports.mensuel.print', ['mois' => $moisActuel, 'annee' => $anneeActuelle]) }}"
                                        class="btn btn-success" target="_blank">
                                        <i class="fas fa-print"></i> Imprimer
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Statistiques générales -->
                        <div class="row mb-4">
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Mariages
                                                    </p>
                                                    <h5 class="font-weight-bolder">{{ $statistiques['total'] }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mariages par province -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Mariages par Province</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Province</th>
                                                        <th>Nombre de mariages</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($statistiques['parProvince'] as $province => $total)
                                                        <tr>
                                                            <td>{{ $province }}</td>
                                                            <td>{{ $total }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mariages par statut -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Mariages par Statut</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Statut</th>
                                                        <th>Nombre de mariages</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($statistiques['parStatut'] as $statut => $total)
                                                        <tr>
                                                            <td>{{ $statut }}</td>
                                                            <td>{{ $total }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Liste des mariages -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Liste des Mariages</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Époux</th>
                                                        <th>Épouse</th>
                                                        <th>Province</th>
                                                        <th>Statut</th>
                                                        <th>Régime</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mariages as $mariage)
                                                        <tr>
                                                            <td>{{ $mariage->date_mariage->format('d/m/Y') }}</td>
                                                            <td>{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}</td>
                                                            <td>{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}</td>
                                                            <td>{{ $mariage->epoux->province }}</td>
                                                            <td>{{ $mariage->status->nom }}</td>
                                                            <td>{{ $mariage->regimeMatrimonial->contrat->type_contrat }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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