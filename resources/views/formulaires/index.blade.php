@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Liste des Mariages</h6>
                        <a href="{{ route('mariages.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nouveau Mariage
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Filtres -->
                        <div class="px-4 pt-3">
                            <form method="GET" action="{{ route('mariages.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="province" class="form-label">Filtrer par province</label>
                                        <select name="province" id="province" class="form-select"
                                            onchange="this.form.submit()">
                                            <option value="">Toutes les provinces</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province }}"
                                                    {{ request('province') == $province ? 'selected' : '' }}>
                                                    {{ $province }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="date_debut" class="form-label">Date début</label>
                                        <input type="date" class="form-control" id="date_debut" name="date_debut"
                                            value="{{ request('date_debut') }}" onchange="this.form.submit()">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="date_fin" class="form-label">Date fin</label>
                                        <input type="date" class="form-control" id="date_fin" name="date_fin"
                                            value="{{ request('date_fin') }}" onchange="this.form.submit()">
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                                        <a href="{{ route('mariages.index') }}"
                                            class="btn btn-secondary btn-sm">Réinitialiser</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Tableau des mariages -->
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Époux</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Épouse</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Province</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mariages as $mariage)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $mariage->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}
                                                            {{ $mariage->epoux->postnom }}
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $mariage->epoux->profession }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}
                                                            {{ $mariage->epouse->postnom }}
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $mariage->epouse->profession }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $mariage->epoux->province }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $mariage->created_at->format('d/m/Y') }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('mariages.show', $mariage) }}"
                                                    class="text-info font-weight-bold text-xs me-2" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Voir les détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('mariages.edit', $mariage) }}"
                                                    class="text-warning font-weight-bold text-xs me-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="text-danger font-weight-bold text-xs"
                                                    onclick="confirmDelete({{ $mariage->id }})" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun mariage trouvé</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-4 pt-3">
                            {{-- {{ $mariages->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce mariage ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Initialisation des tooltips Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Fonction de confirmation de suppression
        function confirmDelete(id) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            form.action = `/mariage/${id}`;
            modal.show();
        }
    </script>
@endsection
