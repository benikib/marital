<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut du Mariage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Statut du Mariage</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">
                            Ce code QR permet d'accéder directement au statut du mariage enregistré.
                        </p>
                        <dl class="row mb-3">
                            <dt class="col-sm-4">Numéro d'enregistrement</dt>
                            <dd class="col-sm-8">MC-{{ date('Y-m', strtotime($mariage->date_mariage)) }}-{{ $mariage->id }}</dd>

                            <dt class="col-sm-4">Époux</dt>
                            <dd class="col-sm-8">{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }} {{ $mariage->epoux->postnom }}</dd>

                            <dt class="col-sm-4">Épouse</dt>
                            <dd class="col-sm-8">{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }} {{ $mariage->epouse->postnom }}</dd>

                            <dt class="col-sm-4">Date du mariage</dt>
                            <dd class="col-sm-8">{{ date('d/m/Y', strtotime($mariage->date_mariage)) }}</dd>

                            <dt class="col-sm-4">Lieu</dt>
                            <dd class="col-sm-8">{{ $mariage->lieu_mariage }}</dd>

                            <dt class="col-sm-4">Statut actuel</dt>
                            <dd class="col-sm-8 text-uppercase fw-bold">{{ $mariage->status->nom ?? 'Non renseigné' }}</dd>
                        </dl>

                        <p class="text-muted small">
                            Ce lien affiche l'état du mariage enregistré. Si vous souhaitez consulter le certificat, cliquez ci-dessous.
                        </p>
                        <a href="{{ route('certification', $mariage) }}" class="btn btn-outline-primary">Voir le certificat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
