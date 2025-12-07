@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Mariages</h3>
                        <div class="card-tools">
                            <a href="{{ route('mariages.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nouveau Mariage
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filtres -->
                        <form action="{{ route('mariages.index') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <select name="province" id="province" class="form-control">
                                            <option value="">Toutes les provinces</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>
                                                    {{ $province }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date_debut">Date début</label>
                                        <input type="date" name="date_debut" id="date_debut" class="form-control"
                                            value="{{ request('date_debut') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date_fin">Date fin</label>
                                        <input type="date" name="date_fin" id="date_fin" class="form-control"
                                            value="{{ request('date_fin') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-search"></i> Filtrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Tableau des mariages -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Lieu</th>
                                        <th>Époux</th>
                                        <th>Épouse</th>
                                        <th>Province</th>
                                        <th>Statut</th>
                                        <th>Régime</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mariages as $mariage)
                                        <tr>
                                            <td>{{ $mariage->date_mariage->format('d/m/Y') }}</td>
                                            <td>{{ $mariage->lieu_mariage }}</td>
                                            <td>
                                                {{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}
                                                <br>
                                                <small class="text-muted">{{ $mariage->epoux->province }}</small>
                                            </td>
                                            <td>
                                                {{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}
                                                <br>
                                                <small class="text-muted">{{ $mariage->epouse->province }}</small>
                                            </td>
                                            <td>{{ $mariage->epoux->province }}</td>
                                            <td>
                                                <span class="badge badge-{{ $mariage->status->couleur }}">
                                                    {{ $mariage->status->libelle }}
                                                </span>
                                            </td>
                                            <td>{{ $mariage->regimeMatrimonial->libelle }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('mariages.show', $mariage) }}" class="btn btn-info btn-sm"
                                                        title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('mariages.edit', $mariage) }}"
                                                        class="btn btn-warning btn-sm" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('mariages.destroy', $mariage) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce mariage ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Aucun mariage trouvé</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $mariages->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.8em;
        }

        .btn-group .btn {
            margin: 0 2px;
        }
    </style>
@endsection
