@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Détails du Mariage</h3>
                        <div class="card-tools">
                            <a href="{{ route('mariages.index') }}" class="btn btn-default">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <a href="{{ route('mariages.edit', $mariage) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Informations générales -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="card-title text-white">Informations Générales</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 200px">Date du mariage</th>
                                                <td>{{ $mariage->date_mariage->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Lieu du mariage</th>
                                                <td>{{ $mariage->lieu_mariage }}</td>
                                            </tr>
                                            <tr>
                                                <th>Statut</th>
                                                <td>
                                                    <span class="badge badge-{{ $mariage->status->couleur }}">
                                                        {{ $mariage->status->libelle }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Régime matrimonial</th>
                                                <td>
                                                    {{ $mariage->regimeMatrimonial->libelle }}
                                                    <br>
                                                    <small class="text-muted">
                                                        Contrat : {{ $mariage->regimeMatrimonial->contrat->libelle }}
                                                    </small>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations sur l'ayant droit coutumier -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h4 class="card-title text-white">Ayant Droit Coutumier</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 200px">Nom complet</th>
                                                <td>
                                                    {{ $mariage->ayantDroitCoutinier->nom }}
                                                    {{ $mariage->ayantDroitCoutinier->prenom }}
                                                    {{ $mariage->ayantDroitCoutinier->postnom }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Profession</th>
                                                <td>{{ $mariage->ayantDroitCoutinier->profession }}</td>
                                            </tr>
                                            <tr>
                                                <th>Adresse</th>
                                                <td>{{ $mariage->ayantDroitCoutinier->adresse }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nationalité</th>
                                                <td>{{ $mariage->ayantDroitCoutinier->nationalite }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations sur l'époux -->
                            <div class="col-md-6 mt-4">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h4 class="card-title text-white">Informations sur l'Époux</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center mb-3">
                                                @if($mariage->epoux->url_photo)
                                                    <img src="{{ asset('storage/' . $mariage->epoux->url_photo) }}"
                                                        alt="Photo de {{ $mariage->epoux->nom }}" class="img-fluid rounded">
                                                @else
                                                    <div class="bg-light p-3 rounded">
                                                        <i class="fas fa-user fa-3x text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 150px">Nom complet</th>
                                                        <td>
                                                            {{ $mariage->epoux->nom }}
                                                            {{ $mariage->epoux->prenom }}
                                                            {{ $mariage->epoux->postnom }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Profession</th>
                                                        <td>{{ $mariage->epoux->profession }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Adresse</th>
                                                        <td>{{ $mariage->epoux->adresse }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Province</th>
                                                        <td>{{ $mariage->epoux->province }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nationalité</th>
                                                        <td>{{ $mariage->epoux->nationalite }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations sur l'épouse -->
                            <div class="col-md-6 mt-4">
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white">Informations sur l'Épouse</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center mb-3">
                                                @if($mariage->epouse->url_photo)
                                                    <img src="{{ asset('storage/' . $mariage->epouse->url_photo) }}"
                                                        alt="Photo de {{ $mariage->epouse->nom }}" class="img-fluid rounded">
                                                @else
                                                    <div class="bg-light p-3 rounded">
                                                        <i class="fas fa-user fa-3x text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 150px">Nom complet</th>
                                                        <td>
                                                            {{ $mariage->epouse->nom }}
                                                            {{ $mariage->epouse->prenom }}
                                                            {{ $mariage->epouse->postnom }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Profession</th>
                                                        <td>{{ $mariage->epouse->profession }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Adresse</th>
                                                        <td>{{ $mariage->epouse->adresse }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Province</th>
                                                        <td>{{ $mariage->epouse->province }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nationalité</th>
                                                        <td>{{ $mariage->epouse->nationalite }}</td>
                                                    </tr>
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
    </div>
@endsection

@push('styles')
    <style>
        .card-header {
            padding: 0.75rem 1.25rem;
        }

        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.8em;
        }

        .img-fluid {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
@endpush
