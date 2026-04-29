<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
            font-size: 9px;
            line-height: 1.3;
            color: #1a1a2e;
            background: white;
            padding: 15px;
        }
        
        /* En-tête compact */
        .main-header {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .logo {
            font-size: 18px;
            font-weight: bold;
            color: #4f46e5;
            letter-spacing: 1px;
        }
        
        .title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 3px;
        }
        
        .subtitle {
            font-size: 8px;
            color: #64748b;
        }
        
        .divider {
            height: 2px;
            background: #4f46e5;
            margin: 8px 0;
        }
        
        /* Informations en ligne */
        .info-section {
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
        }
        
        .info-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .info-item {
            flex: 1;
            text-align: center;
            border-right: 1px solid #e2e8f0;
        }
        
        .info-item:last-child {
            border-right: none;
        }
        
        .info-label {
            font-size: 7px;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
        }
        
        .info-value {
            font-size: 9px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 2px;
        }
        
        /* Cartes statistiques très compactes */
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 12px;
            gap: 6px;
        }
        
        .stat-card {
            flex: 1;
            min-width: 60px;
            padding: 6px 4px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .stat-card.stat-total {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin-bottom: 4px;
        }
        
        .stat-icon {
            font-size: 12px;
        }
        
        .stat-label {
            font-size: 7px;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
        }
        
        .stat-total .stat-label {
            color: white;
        }
        
        .stat-number {
            font-size: 14px;
            font-weight: 800;
            color: #1e293b;
        }
        
        .stat-total .stat-number {
            color: white;
        }
        
        /* Récapitulatif rapide - une ligne */
        .summary-bar {
            background: #f1f5f9;
            padding: 6px 12px;
            border-radius: 6px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-around;
        }
        
        .summary-item {
            text-align: center;
        }
        
        .summary-number {
            font-size: 14px;
            font-weight: 800;
            color: #4f46e5;
        }
        
        .summary-label {
            font-size: 7px;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
        }
        
        /* Tableaux très compacts */
        .table-container {
            margin-bottom: 10px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        
        .section-title {
            font-size: 10px;
            font-weight: 700;
            color: #1e293b;
            margin: 8px 0 4px 0;
            padding: 3px 6px;
            background: #f1f5f9;
            border-radius: 4px;
            display: inline-block;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7px;
        }
        
        th {
            background: #f1f5f9;
            padding: 5px 4px;
            text-align: left;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 1px solid #cbd5e1;
        }
        
        td {
            padding: 4px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        .badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 6px;
            font-weight: 600;
        }
        
        .badge-m {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-f {
            background: #fce7f3;
            color: #9d174d;
        }
        
        /* Pied de page compact */
        .footer {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 7px;
            color: #94a3b8;
        }
        
        .signature {
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            padding: 0 80px;
        }
        
        .sign-line {
            text-align: center;
        }
        
        .sign-line .line {
            width: 150px;
            border-top: 0.5px solid #94a3b8;
            margin-top: 15px;
            padding-top: 3px;
        }
        
        /* Éviter les coupures */
        .stat-card, .table-container, .summary-bar {
            break-inside: avoid;
            page-break-inside: avoid;
        }
        
        @media print {
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="main-header">
        <div class="logo">MARITAL SYSTEM</div>
        <div class="title">{{ $title }}</div>
        <div class="subtitle">Document officiel d'état civil</div>
        <div class="divider"></div>
    </div>

    <!-- Informations -->
    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">ENTITÉ</div>
                <div class="info-value">{{ strtoupper($entite->nom ?? 'N/A') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">AGENT</div>
                <div class="info-value">{{ strtoupper($agent->name ?? 'N/A') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">PÉRIODE</div>
                <div class="info-value">{{ $dateDebut->format('d/m/Y') }} → {{ $dateFin->format('d/m/Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">ÉDITION</div>
                <div class="info-value">{{ now()->format('d/m/Y H:i') }}</div>
            </div>
        </div>
    </div>

    <!-- Récapitulatif rapide -->
    <div class="summary-bar">
        <div class="summary-item">
            <div class="summary-number">{{ number_format($stats['total_general']) }}</div>
            <div class="summary-label">TOTAL ACTES</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ number_format($stats['total_mariages']) }}</div>
            <div class="summary-label">💍 MARIAGES</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ number_format($stats['total_naissances']) }}</div>
            <div class="summary-label">👶 NAISSANCES</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ number_format($stats['total_deces']) }}</div>
            <div class="summary-label">⚰️ DÉCÈS</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ number_format($stats['total_celibats']) }}</div>
            <div class="summary-label">💑 CÉLIBATS</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ number_format($stats['total_inhumations']) }}</div>
            <div class="summary-label">🪦 INHUM.</div>
        </div>
    </div>

    <!-- Cartes statistiques détaillées -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💍</span>
                <span class="stat-label">MARIAGES</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_mariages']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">👶</span>
                <span class="stat-label">NAISSANCES</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_naissances']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">⚰️</span>
                <span class="stat-label">DÉCÈS</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_deces']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💑</span>
                <span class="stat-label">CÉLIBATS</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_celibats']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🪦</span>
                <span class="stat-label">INHUMATIONS</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_inhumations']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🏠</span>
                <span class="stat-label">RÉSIDENCES</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_residences']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💔</span>
                <span class="stat-label">VEUVAGES</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_veuvages']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🌍</span>
                <span class="stat-label">NATIONALITÉS</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_nationalites']) }}</div>
        </div>
        <div class="stat-card stat-total">
            <div class="stat-header">
                <span class="stat-icon">📊</span>
                <span class="stat-label">TOTAL</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_general']) }}</div>
        </div>
    </div>

    <!-- Détails des actes (uniquement si demandé et assez de place) -->
    @if(request('include_details'))
        <!-- Mariages -->
        @if(isset($rapportData['mariages']) && $rapportData['mariages']->count() > 0 && $rapportData['mariages']->count() <= 10)
            <div class="section-title">💍 MARIAGES ({{ $rapportData['mariages']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>#</th><th>Époux</th><th>Épouse</th><th>Date</th><th>Officiant</th></tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['mariages'] as $index => $mariage)
                            <tr>
                                <td style="width:5%">{{ $index + 1 }}</td>
                                <td style="width:30%"><strong>{{ $mariage->epoux->nom ?? 'N/A' }}</strong> {{ $mariage->epoux->prenom ?? '' }}</td>
                                <td style="width:30%"><strong>{{ $mariage->epouse->nom ?? 'N/A' }}</strong> {{ $mariage->epouse->prenom ?? '' }}</td>
                                <td style="width:20%">{{ $mariage->date_mariage ? $mariage->date_mariage->format('d/m/Y') : 'N/A' }}</td>
                                <td style="width:15%">{{ $mariage->officiant ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Naissances -->
        @if(isset($rapportData['naissances']) && $rapportData['naissances']->count() > 0 && $rapportData['naissances']->count() <= 10)
            <div class="section-title">👶 NAISSANCES ({{ $rapportData['naissances']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>#</th><th>Nom</th><th>Prénom</th><th>Date naiss.</th><th>Sexe</th></tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['naissances'] as $index => $naissance)
                            <tr>
                                <td style="width:5%">{{ $index + 1 }}</td>
                                <td style="width:25%"><strong>{{ $naissance->nom }}</strong></td>
                                <td style="width:25%">{{ $naissance->prenom }}</td>
                                <td style="width:20%">{{ $naissance->date_naissance ? $naissance->date_naissance->format('d/m/Y') : 'N/A' }}</td>
                                <td style="width:10%"><span class="badge {{ $naissance->sexe == 'M' ? 'badge-m' : 'badge-f' }}">{{ $naissance->sexe }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Décès -->
        @if(isset($rapportData['deces']) && $rapportData['deces']->count() > 0 && $rapportData['deces']->count() <= 10)
            <div class="section-title">⚰️ DÉCÈS ({{ $rapportData['deces']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>#</th><th>Défunt</th><th>Date décès</th><th>Lieu</th></tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['deces'] as $index => $deces)
                            <tr>
                                <td style="width:5%">{{ $index + 1 }}</td>
                                <td style="width:40%"><strong>{{ $deces->nom }}</strong> {{ $deces->prenom }}</td>
                                <td style="width:25%">{{ $deces->date_deces ? $deces->date_deces->format('d/m/Y') : 'N/A' }}</td>
                                <td style="width:30%">{{ $deces->lieu ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Message si trop de données -->
        @if((isset($rapportData['mariages']) && $rapportData['mariages']->count() > 10) ||
            (isset($rapportData['naissances']) && $rapportData['naissances']->count() > 10) ||
            (isset($rapportData['deces']) && $rapportData['deces']->count() > 10))
            <div style="background:#fef3c7; padding:6px; border-radius:4px; margin:8px 0; text-align:center; font-size:7px; color:#92400e;">
                ⚠️ Les détails complets ne sont pas affichés pour rester sur une seule page. 
                Utilisez l'export Excel pour voir tous les détails.
            </div>
        @endif
    @endif

    <!-- Pied de page -->
    <div class="footer">
        <p>Rapport généré par MARITAL - Service d'État Civil</p>
        <div class="signature">
            <div class="sign-line">
                <div class="line"></div>
                <div>Signature agent</div>
            </div>
            <div class="sign-line">
                <div class="line"></div>
                <div>Cachet entité</div>
            </div>
        </div>
        <p style="margin-top:5px">Code: {{ substr(\Illuminate\Support\Str::uuid(), 0, 8) }} | {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>