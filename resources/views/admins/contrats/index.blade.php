@extends('layouts.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Gestion des Contrats</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createContratModal">
                            <i class="fa fa-plus"></i> Ajouter un contrat
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type de contrat</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date de création</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contrats as $contrat)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $contrat->id }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">{{ $contrat->type_contrat }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">{{ $contrat->created_at->format('d/m/Y H:i') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-link text-warning px-3 mb-0"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editContratModal"
                                                        data-contrat-id="{{ $contrat->id }}"
                                                        data-contrat-type="{{ $contrat->type_contrat }}">
                                                    <i class="fas fa-pencil-alt text-warning me-2"></i>Modifier
                                                </button>
                                                <form action="{{ route('contrats.destroy', $contrat) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger px-3 mb-0" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">
                                                        <i class="far fa-trash-alt me-2"></i>Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Aucun contrat trouvé</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $contrats->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de création -->
    <div class="modal fade" id="createContratModal" tabindex="-1" aria-labelledby="createContratModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createContratModalLabel">Créer un nouveau contrat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('contrats.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="type_contrat" class="form-control-label">Type de contrat</label>
                            <input type="text" class="form-control @error('type_contrat') is-invalid @enderror"
                                   id="type_contrat" name="type_contrat" value="{{ old('type_contrat') }}" required>
                            @error('type_contrat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal d'édition -->
    <div class="modal fade" id="editContratModal" tabindex="-1" aria-labelledby="editContratModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContratModalLabel">Modifier le contrat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editContratForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="edit_type_contrat" class="form-control-label">Type de contrat</label>
                            <input type="text" class="form-control @error('type_contrat') is-invalid @enderror"
                                   id="edit_type_contrat" name="type_contrat" required>
                            @error('type_contrat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du modal d'édition
            const editContratModal = document.getElementById('editContratModal');
            if (editContratModal) {
                editContratModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const contratId = button.getAttribute('data-contrat-id');
                    const contratType = button.getAttribute('data-contrat-type');

                    const form = this.querySelector('#editContratForm');
                    const typeInput = this.querySelector('#edit_type_contrat');

                    form.action = `/admin/contrats/${contratId}`;
                    typeInput.value = contratType;
                });
            }

            // Réinitialisation des formulaires à la fermeture des modals
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    const form = this.querySelector('form');
                    if (form) {
                        form.reset();
                        const errorAlerts = form.querySelectorAll('.alert-danger');
                        errorAlerts.forEach(alert => alert.remove());
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
