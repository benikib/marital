@extends('layouts.agents.app')

@section('title', 'Mon Profil')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Modifier mon profil</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('agent.profile.update') }}" class="form-horizontal">
                            @csrf
                            @method('patch')

                            <!-- Informations personnelles -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Nom complet</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone" class="form-control-label">Téléphone</label>
                                        <input type="tel" class="form-control @error('telephone') is-invalid @enderror"
                                            id="telephone" name="telephone"
                                            value="{{ old('telephone', $user->telephone) }}">
                                        @error('telephone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commune_id" class="form-control-label">Commune</label>
                                        <input type="text" class="form-control"
                                            value="{{ $user->commune->nom ?? 'Non assigné' }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark mt-4">

                            <!-- Changement de mot de passe -->
                            <h6 class="mb-3">Changer le mot de passe</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current_password" class="form-control-label">Mot de passe actuel</label>
                                        <input type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            id="current_password" name="current_password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-control-label">Confirmer le mot de
                                            passe</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="row mt-4">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </div>
                            </div>
                        </form>

                        <!-- Suppression du compte -->
                        <hr class="horizontal dark mt-4">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="mb-3 text-danger">Zone dangereuse</h6>
                                <form method="POST" action="{{ route('agent.profile.destroy') }}" class="d-inline"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Validation du formulaire
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            form.addEventListener('submit', function (e) {
                if (password.value || passwordConfirmation.value) {
                    if (password.value !== passwordConfirmation.value) {
                        e.preventDefault();
                        alert('Les mots de passe ne correspondent pas.');
                    }
                    if (password.value && password.value.length < 8) {
                        e.preventDefault();
                        alert('Le mot de passe doit contenir au moins 8 caractères.');
                    }
                }
            });
        });
    </script>
@endpush
