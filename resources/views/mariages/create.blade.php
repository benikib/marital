@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nouveau Mariage</h3>
                    <div class="card-tools">
                        <a href="{{ route('mariages.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <!-- Cette vue n'est plus utilisée pour l'enregistrement ;
                     le formulaire complet se trouve dans resources/views/formulaires/create.blade.php
                     qui est rendu par le contrôleur MariageController::create().
                     Si vous souhaitez modifier l'interface de création ou ajouter le
                     chargement du père de l'épouse, éditez ce fichier plutôt. -->
                <div class="card-body">
                    <div class="alert alert-info">
                        Le formulaire de création détaillé a été déplacé dans
                        <code>formulaires/create.blade.php</code>.
                        <br />Ouvrez ce fichier pour apporter vos modifications (par exemple
                        l'ajout d'une liste déroulante pour charger les données du père de
                        l'épouse). Cette page reste ici uniquement pour compatibilité.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
