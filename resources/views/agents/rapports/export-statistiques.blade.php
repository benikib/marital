<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques Géographiques - {{ ucfirst($type) }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            margin: 20px;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .stats-summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .stat-box {
            text-align: center;
        }

        .stat-box h3 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }

        .stat-box p {
            margin: 5px 0 0 0;
            font-size: 11px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            background: #007bff;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 20px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .demographics {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .demographics > div {
            flex: 1;
        }

        .demographics h4 {
            font-size: 12px;
            margin-bottom: 10px;
            color: #333;
        }

        .demographics-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RÉPUBLIQUE DÉMOCRATIQUE DU CONGO</h1>
        <h1>Statistiques Géographiques des Mariages</h1>
        <p><strong>Période:</strong> {{ $mois ? 'Mois de ' . \Carbon\Carbon::create()->month($mois)->format('F') . ' ' : '' }}{{ $annee }}</p>
        <p><strong>Type d'analyse:</strong> Par {{ ucfirst($type) }}</p>
        @if($entite)
            <p><strong>Entité:</strong> {{ $entite->nom }}</p>
        @endif
    </div>

    <div class="stats-summary">
        <div class="stat-box">
            <h3>{{ $totalMariages }}</h3>
            <p>Total Mariages</p>
        </div>
        <div class="stat-box">
            <h3>{{ $parStatus->count() }}</h3>
            <p>Statuts Différents</p>
        </div>
        <div class="stat-box">
            <h3>{{ $statistiques->count() }}</h3>
            <p>{{ ucfirst($type) }}s Couvertes</p>
        </div>
    </div>

    <h2 class="section-title">Répartition par Statut</h2>
    <table>
        <thead>
            <tr>
                <th>Statut</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Pourcentage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parStatus as $status => $count)
                <tr>
                    <td>{{ $status ?? 'Non défini' }}</td>
                    <td class="text-center">{{ $count }}</td>
                    <td class="text-center">{{ $totalMariages > 0 ? round(($count / $totalMariages) * 100, 1) : 0 }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="section-title">Statistiques par {{ ucfirst($type) }}</h2>
    <table>
        <thead>
            <tr>
                <th>{{ ucfirst($type) }}</th>
                <th class="text-center">Total Mariages</th>
                <th class="text-center">Époux</th>
                <th class="text-center">Épouses</th>
                @if($type == 'province')
                    <th class="text-center">Âge Moyen Époux</th>
                    <th class="text-center">Âge Moyen Épouse</th>
                @endif
                <th>Répartition par Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistiques as $stat)
                <tr>
                    <td><strong>{{ $stat['localisation'] }}</strong></td>
                    <td class="text-center">
                        <span class="badge">{{ $stat['total'] }}</span>
                    </td>
                    <td class="text-center">{{ $stat['hommes'] ?? '-' }}</td>
                    <td class="text-center">{{ $stat['femmes'] ?? '-' }}</td>
                    @if($type == 'province')
                        <td class="text-center">{{ number_format($stat['moyenne_age_epoux'] ?? 0, 1) }} ans</td>
                        <td class="text-center">{{ number_format($stat['moyenne_age_epouse'] ?? 0, 1) }} ans</td>
                    @endif
                    <td>
                        @if(isset($stat['par_status']))
                            @foreach($stat['par_status'] as $status => $count)
                                {{ $status }}: {{ $count }}
                                @if(!$loop->last), @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($type == 'province')
    <div class="demographics">
        <div>
            <h4>Nationalités des Époux</h4>
            @foreach($statsDemographiques['par_nationalite_epoux'] as $nationalite => $count)
                <div class="demographics-item">
                    <span>{{ $nationalite ?? 'Non spécifié' }}</span>
                    <strong>{{ $count }}</strong>
                </div>
            @endforeach
        </div>
        <div>
            <h4>Nationalités des Épouses</h4>
            @foreach($statsDemographiques['par_nationalite_epouse'] as $nationalite => $count)
                <div class="demographics-item">
                    <span>{{ $nationalite ?? 'Non spécifié' }}</span>
                    <strong>{{ $count }}</strong>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="footer">
        <p>Rapport généré le {{ now()->format('d/m/Y à H:i') }}</p>
        <p>Système d'État Civil - République Démocratique du Congo</p>
    </div>
</body>
</html>