<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Mensuel des Mariages - {{ $moisNom }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .stat-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .stat-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 16px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Rapport Mensuel des Mariages</h1>
        <p>Période : {{ $moisNom }}</p>
        <p>Date d'édition : {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Statistiques Générales</div>
        <div class="stat-card">
            <div class="stat-title">Total des Mariages</div>
            <div class="stat-value">{{ $statistiques['total'] }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Mariages par Province</div>
        <table>
            <thead>
                <tr>
                    <th>Province</th>
                    <th>Nombre de mariages</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statistiques['parProvince'] as $province => $total)
                    <tr>
                        <td>{{ $province }}</td>
                        <td>{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Mariages par Statut</div>
        <table>
            <thead>
                <tr>
                    <th>Statut</th>
                    <th>Nombre de mariages</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statistiques['parStatut'] as $statut => $total)
                    <tr>
                        <td>{{ $statut }}</td>
                        <td>{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Liste des Mariages</div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Époux</th>
                    <th>Épouse</th>
                    <th>Province</th>
                    <th>Statut</th>
                    <th>Régime</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mariages as $mariage)
                    <tr>
                        <td>{{ $mariage->date_mariage->format('d/m/Y') }}</td>
                        <td>{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}</td>
                        <td>{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}</td>
                        <td>{{ $mariage->epoux->province }}</td>
                        <td>{{ $mariage->status->nom }}</td>
                        <td>{{ $mariage->regimeMatrimonial->contrat->type_contrat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Imprimer</button>
    </div>
</body>

</html>
