@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Gestion des Communes</h6>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCommuneModal">
                            <i class="fa fa-plus"></i> Nouvelle Commune
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Formulaire de filtrage -->
                        <div class="px-4 pt-3">
                            <form method="GET" action="{{ route('communes.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="province" class="form-label">Filtrer par province</label>
                                        <select name="province" id="province" class="form-select" onchange="this.form.submit()">
                                            <option value="">Toutes les provinces</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}"
                                                    {{ request('province') == $province->id ? 'selected' : '' }}>
                                                    {{ $province->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                                        <a href="{{ route('communes.index') }}" class="btn btn-secondary btn-sm">Réinitialiser</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Province</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($communes as $commune)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $commune->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $commune->nom }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $commune->province->nom }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('communes.show', $commune) }}" class="text-info font-weight-bold text-xs me-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="javascript:;" class="text-warning font-weight-bold text-xs me-2"
                                                    data-bs-toggle="modal" data-bs-target="#editCommuneModal"
                                                    data-id="{{ $commune->id }}"
                                                    data-nom="{{ $commune->nom }}"
                                                    data-province="{{ $commune->province_id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="text-danger font-weight-bold text-xs"
                                                    onclick="confirmCommuneDelete({{ $commune->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Aucune commune trouvée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-3">
                            {{ $communes->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Commune Modal -->
    <div class="modal fade" id="createCommuneModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une nouvelle commune</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('communes.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la commune</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="province_id" class="form-label">Province</label>
                            <select class="form-select" id="province_id" name="province_id" required>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Commune Modal -->
    <div class="modal fade" id="editCommuneModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la commune</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCommuneForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nom" class="form-label">Nom de la commune</label>
                            <input type="text" class="form-control" id="edit_nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_province_id" class="form-label">Province</label>
                            <select class="form-select" id="edit_province_id" name="province_id" required>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Function to handle edit modal
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('[data-bs-target="#editCommuneModal"]');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const communeId = this.getAttribute('data-id');
                    const communeNom = this.getAttribute('data-nom');
                    const communeProvince = this.getAttribute('data-province');

                    const form = document.getElementById('editCommuneForm');
                    form.action = `/communes/${communeId}`;

                    document.getElementById('edit_nom').value = communeNom;
                    document.getElementById('edit_province_id').value = communeProvince;
                });
            });
        });

        // Function to confirm commune deletion
        function confirmCommuneDelete(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette commune ?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/communes/${id}`;

                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endpush
