@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Gestion des Utilisateurs</h6>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            <i class="fa fa-plus"></i> Nouvel Utilisateur
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Formulaire de filtrage -->
                        <div class="px-4 pt-3">
                            <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="type_role" class="form-label">Filtrer par rôle</label>
                                        <select name="type_role" id="type_role" class="form-select"
                                            onchange="this.form.submit()">
                                            <option value="">Tous les rôles</option>
                                            @foreach ($typeRoles as $typeRole)
                                                <option value="{{ $typeRole->id }}"
                                                    {{ request('type_role') == $typeRole->id ? 'selected' : '' }}>
                                                    {{ $typeRole->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="commune" class="form-label">Filtrer par commune</label>
                                        <select name="commune" id="commune" class="form-select" onchange="this.form.submit()">
                                            <option value="">Toutes les communes</option>
                                            @foreach ($communes as $commune)
                                                <option value="{{ $commune->id }}"
                                                    {{ request('commune') == $commune->id ? 'selected' : '' }}>
                                                    {{ $commune->nom }} ({{ $commune->province->nom }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                                        <a href="{{ route('users.index') }}"
                                            class="btn btn-secondary btn-sm">Réinitialiser</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rôle
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commune
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date
                                            de création</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->typeRole->nom ?? 'Non défini' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $user->commune ? $user->commune->nom . ' (' . $user->commune->province->nom . ')' : 'Non assignée' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $user->created_at->format('d/m/Y H:i') }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('users.show', $user) }}"
                                                    class="text-info font-weight-bold text-xs me-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="javascript:;" class="text-warning font-weight-bold text-xs me-2"
                                                    data-bs-toggle="modal" data-bs-target="#editUserModal"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-role="{{ $user->type_role_id }}"
                                                    data-commune="{{ $user->commune_id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="text-danger font-weight-bold text-xs"
                                                    onclick="confirmUserDelete({{ $user->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucun utilisateur trouvé</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 pt-3">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un nouvel utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_role_id" class="form-label">Rôle</label>
                            <select class="form-select" id="type_role_id" name="type_role_id" required>
                                @foreach ($typeRoles as $typeRole)
                                    <option value="{{ $typeRole->id }}">{{ $typeRole->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="commune_id" class="form-label">Commune</label>
                            <select class="form-select" id="commune_id" name="commune_id">
                                <option value="">Sélectionner une commune</option>
                                @foreach ($communes as $commune)
                                    <option value="{{ $commune->id }}">
                                        {{ $commune->nom }} ({{ $commune->province->nom }})
                                    </option>
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

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_type_role_id" class="form-label">Rôle</label>
                            <select class="form-select" id="edit_type_role_id" name="type_role_id" required>
                                @foreach ($typeRoles as $typeRole)
                                    <option value="{{ $typeRole->id }}">{{ $typeRole->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_commune_id" class="form-label">Commune</label>
                            <select class="form-select" id="edit_commune_id" name="commune_id">
                                <option value="">Sélectionner une commune</option>
                                @foreach ($communes as $commune)
                                    <option value="{{ $commune->id }}">
                                        {{ $commune->nom }} ({{ $commune->province->nom }})
                                    </option>
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
            const editButtons = document.querySelectorAll('[data-bs-target="#editUserModal"]');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');
                    const userEmail = this.getAttribute('data-email');
                    const userRole = this.getAttribute('data-role');
                    const userCommune = this.getAttribute('data-commune');

                    const form = document.getElementById('editUserForm');
                    form.action = `/users/${userId}`;

                    document.getElementById('edit_name').value = userName;
                    document.getElementById('edit_email').value = userEmail;
                    document.getElementById('edit_type_role_id').value = userRole;
                    document.getElementById('edit_commune_id').value = userCommune || '';
                });
            });
        });

        // Function to confirm user deletion
        function confirmUserDelete(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/users/${id}`;

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
