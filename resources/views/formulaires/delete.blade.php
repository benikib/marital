@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Confirmer la suppression</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Attention !</h5>
                            <p>Vous êtes sur le point de supprimer le mariage #{{ $mariage->id }}.</p>
                            <p>Cette action est irréversible et supprimera également toutes les données associées :</p>
                            <ul>
                                <li>Informations de l'époux</li>
                                <li>Informations de l'épouse</li>
                                <li>Informations des parents</li>
                                <li>Informations des témoins</li>
                            </ul>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h6>Détails du mariage :</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="width: 200px;">Époux</th>
                                                <td>{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}
                                                    {{ $mariage->epoux->postnom }}</td>
                                            </tr>
                                            <tr>
                                                <th>Épouse</th>
                                                <td>{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}
                                                    {{ $mariage->epouse->postnom }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date du mariage</th>
                                                <td>{{ $mariage->date_mariage }}</td>
                                            </tr>
                                            <tr>
                                                <th>Province</th>
                                                <td>{{ $mariage->province->nom }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('mariage.destroy', $mariage) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')

                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{ route('mariage.show', $mariage) }}" class="btn btn-secondary me-2">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce mariage ? Cette action est irréversible.')">
                                        <i class="fas fa-trash me-2"></i>Confirmer la suppression
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
