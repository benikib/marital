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
            font-size: 11px;
            line-height: 1.5;
            color: #1a1a2e;
            background: white;
            padding: 20px;
        }
        
        /* En-tête principal */
        .main-header {
            text-align: center;
            margin-bottom: 25px;
            position: relative;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #4f46e5;
            letter-spacing: 2px;
        }
        
        .logo span {
            color: #1e293b;
        }
        
        .title {
            font-size: 22px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 10px;
        }
        
        .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-top: 5px;
        }
        
        .divider {
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #818cf8, #4f46e5);
            margin: 15px 0;
        }
        
        /* Informations entité */
        .info-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }
        
        .info-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .info-item {
            flex: 1;
            padding: 5px 10px;
        }
        
        .info-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 3px;
        }
        
        /* Cartes statistiques */
        .stats-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 15px 0;
            padding-left: 10px;
            border-left: 4px solid #4f46e5;
        }
        
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -5px 20px -5px;
        }
        
        .stat-card {
            flex: 0 0 calc(25% - 10px);
            margin: 5px;
            padding: 15px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .stat-icon {
            font-size: 24px;
        }
        
        .stat-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin-top: 8px;
        }
        
        .stat-total {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
        }
        
        .stat-total .stat-label,
        .stat-total .stat-number {
            color: white;
        }
        
        /* Tableaux */
        .table-container {
            margin-bottom: 25px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 10px 0;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 8px;
            display: inline-block;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        
        th {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 10px 8px;
            text-align: left;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 2px solid #cbd5e1;
        }
        
        td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }
        
        tr:hover {
            background: #f8fafc;
        }
        
        /* Récapitulatif rapide */
        .summary-bar {
            background: #f1f5f9;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 20px 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        
        .summary-item {
            text-align: center;
            padding: 0 15px;
        }
        
        .summary-number {
            font-size: 20px;
            font-weight: 800;
            color: #4f46e5;
        }
        
        .summary-label {
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
            margin-top: 3px;
        }
        
        /* Pied de page */
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }
        
        .signature {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            padding: 0 50px;
        }
        
        .sign-line {
            text-align: center;
        }
        
        .sign-line .line {
            width: 200px;
            border-top: 1px solid #94a3b8;
            margin-top: 30px;
            padding-top: 5px;
        }
        
        /* Badges */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
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
        
        /* Print optimization */
        @media print {
            body {
                padding: 0;
            }
            .stat-card {
                break-inside: avoid;
            }
            .table-container {
                break-inside: avoid;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .stat-card {
                flex: 0 0 calc(50% - 10px);
            }
            .info-grid {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="main-header">
        <div class="logo">MARITAL<span> SYSTEM</span></div>
        <div class="title">{{ $title }}</div>
        <div class="subtitle">Document officiel d'état civil</div>
        <div class="divider"></div>
    </div>

    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">🏢 ENTITÉ</div>
                <div class="info-value">{{ strtoupper($entite->nom ?? 'N/A') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">👤 AGENT</div>
                <div class="info-value">{{ strtoupper($agent->name ?? 'N/A') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">📅 PÉRIODE</div>
                <div class="info-value">Du {{ $dateDebut->format('d/m/Y') }} au {{ $dateFin->format('d/m/Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">🕐 ÉDITION</div>
                <div class="info-value">{{ now()->format('d/m/Y à H:i:s') }}</div>
            </div>
        </div>
    </div>

    <!-- Barre de récapitulatif rapide -->
    <div class="summary-bar">
        <div class="summary-item">
            <div class="summary-number">{{ $stats['total_general'] }}</div>
            <div class="summary-label">Total actes</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $stats['total_mariages'] }}</div>
            <div class="summary-label">💍 Mariages</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $stats['total_naissances'] }}</div>
            <div class="summary-label">👶 Naissances</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $stats['total_deces'] }}</div>
            <div class="summary-label">⚰️ Décès</div>
        </div>
    </div>

    <!-- Cartes statistiques détaillées -->
    <div class="stats-title">📊 STATISTIQUES DÉTAILLÉES</div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💍</span>
                <span class="stat-label">Mariages</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_mariages']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">👶</span>
                <span class="stat-label">Naissances</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_naissances']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">⚰️</span>
                <span class="stat-label">Décès</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_deces']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💑</span>
                <span class="stat-label">Célibats</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_celibats']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🪦</span>
                <span class="stat-label">Inhumations</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_inhumations']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🏠</span>
                <span class="stat-label">Résidences</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_residences']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💔</span>
                <span class="stat-label">Veuvages</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_veuvages']) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🌍</span>
                <span class="stat-label">Nationalités</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_nationalites']) }}</div>
        </div>
        <div class="stat-card stat-total">
            <div class="stat-header">
                <span class="stat-icon">📊</span>
                <span class="stat-label">TOTAL GÉNÉRAL</span>
            </div>
            <div class="stat-number">{{ number_format($stats['total_general']) }}</div>
        </div>
    </div>

    @if(request('include_details'))
        <!-- Détail des mariages -->
        @if(isset($rapportData['mariages']) && $rapportData['mariages']->count() > 0)
            <div class="section-title">💍 DÉTAIL DES MARIAGES ({{ $rapportData['mariages']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Époux</th>
                            <th width="30%">Épouse</th>
                            <th width="20%">Date mariage</th>
                            <th width="15%">Officiant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['mariages'] as $index => $mariage)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $mariage->epoux->nom ?? 'N/A' }}</strong> {{ $mariage->epoux->prenom ?? '' }}</td>
                                <td><strong>{{ $mariage->epouse->nom ?? 'N/A' }}</strong> {{ $mariage->epouse->prenom ?? '' }}</td>
                                <td>{{ $mariage->date_mariage ? $mariage->date_mariage->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $mariage->officiant ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Détail des naissances -->
        @if(isset($rapportData['naissances']) && $rapportData['naissances']->count() > 0)
            <div class="section-title">👶 DÉTAIL DES NAISSANCES ({{ $rapportData['naissances']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Nom</th>
                            <th width="20%">Prénom</th>
                            <th width="15%">Date naissance</th>
                            <th width="8%">Sexe</th>
                            <th width="16%">Père</th>
                            <th width="16%">Mère</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['naissances'] as $index => $naissance)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $naissance->nom }}</strong></td>
                                <td>{{ $naissance->prenom }}</td>
                                <td>{{ $naissance->date_naissance ? $naissance->date_naissance->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $naissance->sexe == 'M' ? 'badge-m' : 'badge-f' }}">
                                        {{ $naissance->sexe }}
                                    </span>
                                </td>
                                <td>{{ $naissance->pere ?? 'N/A' }}</td>
                                <td>{{ $naissance->mere ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Détail des décès -->
        @if(isset($rapportData['deces']) && $rapportData['deces']->count() > 0)
            <div class="section-title">⚰️ DÉTAIL DES DÉCÈS ({{ $rapportData['deces']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Défunt</th>
                            <th width="20%">Date décès</th>
                            <th width="20%">Lieu</th>
                            <th width="20%">Cause</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['deces'] as $index => $deces)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $deces->nom }}</strong> {{ $deces->prenom }}</td>
                                <td>{{ $deces->date_deces ? $deces->date_deces->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $deces->lieu ?? 'N/A' }}</td>
                                <td>{{ $deces->cause ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Détail des célibats -->
        @if(isset($rapportData['celibats']) && $rapportData['celibats']->count() > 0)
            <div class="section-title">💑 DÉTAIL DES CÉLIBATS ({{ $rapportData['celibats']->count() }})</div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Nom complet</th>
                            <th width="20%">Date naissance</th>
                            <th width="20%">Nationalité</th>
                            <th width="20%">Date délivrance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapportData['celibats'] as $index => $celibat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $celibat->nom }}</strong> {{ $celibat->prenom }}</td>
                                <td>{{ $celibat->date_naissance ? $celibat->date_naissance->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $celibat->nationalite ?? 'N/A' }}</td>
                                <td>{{ $celibat->created_at ? $celibat->created_at->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif

    <!-- Pied de page avec signature -->
    <div class="footer">
        <p>Ce rapport a été généré automatiquement par le système MARITAL - Service d'État Civil</p>
        <p>Document officiel - Toute reproduction est soumise à autorisation</p>
        
        <div class="signature">
            <div class="sign-line">
                <div class="line"></div>
                <div>Signature de l'agent</div>
            </div>
            <div class="sign-line">
                <div class="line"></div>
                <div>Cachet de l'entité</div>
            </div>
        </div>
        
        <p style="margin-top: 15px; font-size: 8px;">
            Code: {{ \Illuminate\Support\Str::uuid() }} | Page 1/1
        </p>
    </div>
</body>
</html>