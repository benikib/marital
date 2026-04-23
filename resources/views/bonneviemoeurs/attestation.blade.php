<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Bonne Vie et Mœurs - RDC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 0.35in;
        }

        body {
            background: #e9e7e0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Times New Roman', Times, serif;
            padding: 12px;
        }

        .certificat {
            max-width: 850px;
            width: 100%;
            margin: 0 auto;
            background: #fffdf8;
            background-image: 
                linear-gradient(rgba(215, 190, 140, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(215, 190, 140, 0.03) 1px, transparent 1px);
            background-size: 25px 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid #b89b5b;
            border-radius: 6px;
            position: relative;
            padding: 18px 28px 22px 28px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .certificat::before {
            content: "";
            position: absolute;
            top: 8px; left: 8px; right: 8px; bottom: 8px;
            border: 1.5px double #d4af37;
            border-radius: 3px;
            pointer-events: none;
            opacity: 0.5;
        }

        /* En-tête - COMPACT */
        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .flag {
            display: flex;
            width: 100%;
            height: 14px;
            margin-bottom: 8px;
            border-radius: 2px;
            overflow: hidden;
        }
        .flag .blue { background: #0073ce; flex: 1; }
        .flag .yellow { background: #f7d417; flex: 1; }
        .flag .red { background: #ce1126; flex: 1; }

        .republic {
            font-size: 13px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #1e3a8a;
            font-weight: 700;
            margin: 3px 0;
        }

        .ministere {
            font-size: 10px;
            color: #5a4a2e;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .title {
            font-size: 22px;
            font-weight: 800;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 8px 0 5px;
            text-decoration: underline;
            text-underline-offset: 5px;
            text-decoration-color: #d4af37;
            text-decoration-thickness: 1.5px;
        }

        .numero {
            font-size: 12px;
            background: #f1efe7;
            display: inline-block;
            padding: 3px 18px;
            border-radius: 30px;
            color: #3e3a2e;
            font-weight: 600;
            border: 1px dashed #c9b27e;
            margin-top: 5px;
        }

        /* Corps - COMPACT */
        .content {
            margin: 12px 0;
            font-size: 12px;
            line-height: 1.45;
        }

        .intro {
            margin-bottom: 10px;
            font-style: italic;
        }

        .identity-block {
            background: #f9f6ee;
            padding: 10px 16px;
            border-radius: 8px;
            border-left: 4px solid #0d9488;
            margin: 10px 0;
        }

        .identity-row {
            display: flex;
            margin-bottom: 5px;
        }

        .label {
            font-weight: 700;
            min-width: 130px;
            color: #5f4e2e;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.3px;
        }

        .value {
            font-weight: 600;
            color: #1f2a36;
            font-size: 12px;
        }

        .origin-block {
            margin: 10px 0;
            padding: 8px 0;
            border-top: 1px solid #ddd2bd;
            border-bottom: 1px solid #ddd2bd;
        }

        .declaration {
            margin: 12px 0 8px;
            padding: 10px 12px;
            background: #f0fdf4;
            border-radius: 6px;
            border: 1px solid #bbf7d0;
            text-align: center;
        }

        .declaration-text {
            font-size: 13px;
            font-weight: 700;
            color: #166534;
            text-transform: uppercase;
        }

        .attestation-text {
            margin: 10px 0;
            text-align: justify;
            font-size: 11px;
            line-height: 1.5;
        }

        .validity-info {
            display: flex;
            justify-content: space-around;
            margin: 12px 0;
            padding: 8px;
            background: #f8fafc;
            border-radius: 6px;
        }

        .validity-item {
            text-align: center;
        }

        .validity-label {
            font-size: 9px;
            text-transform: uppercase;
            color: #64748b;
        }

        .validity-value {
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
        }

        /* Signature - COMPACT */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 18px;
        }

        .date-place {
            font-size: 11px;
        }

        .signature {
            text-align: right;
        }

        .signature-line {
            border-top: 1.5px solid #1e2a36;
            width: 200px;
            margin-top: 20px;
            margin-bottom: 4px;
        }

        .officier {
            font-weight: 700;
            font-size: 12px;
            color: #2e3b4e;
            text-transform: uppercase;
        }

        .seal {
            margin-top: 3px;
            font-size: 9px;
            color: #6f6a5e;
        }

        /* QR Code - COMPACT */
        .qr-section {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px dashed #cbb586;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qr-code {
            background: white;
            padding: 4px;
            border-radius: 6px;
            border: 1px solid #e2d3bb;
        }

        .qr-text {
            font-size: 9px;
            color: #6f6a5e;
            line-height: 1.3;
        }

        .legal-footer {
            margin-top: 10px;
            font-size: 8px;
            color: #8a846c;
            text-align: center;
        }

        .watermark {
            position: absolute;
            bottom: 80px;
            left: 50px;
            opacity: 0.03;
            font-size: 70px;
            font-weight: bold;
            color: #0d9488;
            transform: rotate(-20deg);
            pointer-events: none;
            white-space: nowrap;
        }

        /* Bouton impression */
        .print-btn {
            position: fixed;
            top: 16px;
            right: 16px;
            background: #0d9488;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 999;
            font-family: Arial, sans-serif;
            border: 1px solid #f1e3c0;
        }

        .print-btn:hover {
            background: #0f766e;
        }

        .mention-speciale {
            margin-top: 8px;
            padding: 6px 10px;
            background: #fef3c7;
            border-radius: 4px;
            font-size: 10px;
            color: #92400e;
            text-align: center;
            border-left: 3px solid #f59e0b;
        }

        /* RÈGLES D'IMPRESSION STRICTES */
        @media print {
            html, body {
                height: 100%;
                margin: 0 !important;
                padding: 0 !important;
                background: white;
            }
            body {
                display: block;
                padding: 0;
            }
            .certificat {
                box-shadow: none;
                border: 2px solid #b89b5b;
                background: white;
                padding: 0.15in 0.25in;
                max-width: 100%;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
            .certificat::before {
                border: 1.5px double #b4945c;
            }
            .print-btn {
                display: none;
            }
            .watermark {
                opacity: 0.04;
            }
            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">
        <span>🖨️</span> Imprimer (1 page)
    </button>

    <div class="certificat">
        <!-- Drapeau RDC -->
        <div class="flag">
            <div class="blue"></div>
            <div class="yellow"></div>
            <div class="blue"></div>
            <div class="yellow"></div>
            <div class="red"></div>
        </div>

        <!-- En-tête officiel -->
        <div class="header">
            <div class="republic">RÉPUBLIQUE DÉMOCRATIQUE DU CONGO</div>
            <div class="ministere">MINISTÈRE DE LA JUSTICE ET GARDE DES SCEAUX</div>
            <div class="title">CERTIFICAT DE BONNE VIE ET MŒURS</div>
            <div class="numero">
                N° {{ $bonneviemoeur->numero_officiel ?? 'BVM-' . date('Y') . '-' . str_pad($bonneviemoeur->id, 5, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <!-- Corps -->
        <div class="content">
            <div class="intro">
                Le soussigné, Officier de l'État Civil, certifie que :
            </div>

            <!-- Identité -->
            <div class="identity-block">
                <div class="identity-row">
                    <span class="label">Nom et Prénom :</span>
                    <span class="value">
                        {{ $bonneviemoeur->personne->nom }} {{ $bonneviemoeur->personne->prenom }}
                        @if($bonneviemoeur->personne->postnom)
                            {{ $bonneviemoeur->personne->postnom }}
                        @endif
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Sexe :</span>
                    <span class="value">{{ $bonneviemoeur->personne->sexe == 'M' ? 'Masculin' : 'Féminin' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Date de naissance :</span>
                    <span class="value">
                        {{ $bonneviemoeur->personne->date_naissance ? \Carbon\Carbon::parse($bonneviemoeur->personne->date_naissance)->translatedFormat('d F Y') : 'Non renseignée' }}
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Lieu de naissance :</span>
                    <span class="value">{{ $bonneviemoeur->personne->lieu_naissance ?? 'Non renseigné' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Filiation :</span>
                    <span class="value">
                        {{ $bonneviemoeur->personne->sexe == 'M' ? 'Fils' : 'Fille' }} de 
                        {{ $bonneviemoeur->personne->pere ?? '________' }} et de 
                        {{ $bonneviemoeur->personne->mere ?? '________' }}
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Profession :</span>
                    <span class="value">{{ $bonneviemoeur->personne->profession ?? 'Non renseignée' }}</span>
                </div>
            </div>

            <!-- Origine et résidence -->
            <div class="origin-block">
                <p style="margin-bottom: 4px; font-size: 11px;">
                    <strong>Originaire de :</strong> 
                    {{ $bonneviemoeur->personne->localite->nom ?? $bonneviemoeur->personne->lieu_naissance ?? '________' }},
                    @if(isset($bonneviemoeur->personne->territoire))
                        Territoire de {{ $bonneviemoeur->personne->territoire->nom }},
                    @endif
                    @if(isset($bonneviemoeur->personne->province))
                        Province de {{ $bonneviemoeur->personne->province->nom }}
                    @endif
                </p>
                <p style="font-size: 11px;">
                    <strong>Résidant à :</strong> 
                    {{ $bonneviemoeur->personne->adresse ?? $bonneviemoeur->residence ?? '_________________' }}
                </p>
            </div>

            <!-- Déclaration principale -->
            <div class="declaration">
                <div class="declaration-text">
                    ⚖️ N'A JAMAIS FAIT L'OBJET DE CONDAMNATION PÉNALE
                </div>
            </div>

            <div class="attestation-text">
                <p>
                    Après vérification du casier judiciaire et des archives de l'État Civil, 
                    il résulte que l'intéressé(e) jouit d'une bonne moralité et n'a jamais 
                    été condamné(e) pour des faits contraires à l'honneur, à la probité ou 
                    aux bonnes mœurs.
                </p>
            </div>

            <!-- Informations de validité -->
            <div class="validity-info">
                <div class="validity-item">
                    <div class="validity-label">Délivré le</div>
                    <div class="validity-value">
                        {{ $bonneviemoeur->date_delivrance ? \Carbon\Carbon::parse($bonneviemoeur->date_delivrance)->format('d/m/Y') : $bonneviemoeur->created_at->format('d/m/Y') }}
                    </div>
                </div>
                <div class="validity-item">
                    <div class="validity-label">Valable jusqu'au</div>
                    <div class="validity-value">
                        @php
                            $dateDelivrance = $bonneviemoeur->date_delivrance 
                                ? \Carbon\Carbon::parse($bonneviemoeur->date_delivrance) 
                                : $bonneviemoeur->created_at;
                            $dateExpiration = $dateDelivrance->copy()->addMonths(3);
                        @endphp
                        {{ $dateExpiration->format('d/m/Y') }}
                    </div>
                </div>
                <div class="validity-item">
                    <div class="validity-label">Motif</div>
                    <div class="validity-value">{{ $bonneviemoeur->motif ?? 'Toutes fins utiles' }}</div>
                </div>
            </div>

            <!-- Mention spéciale si présente -->
            @if($bonneviemoeur->mention_speciale)
            <div class="mention-speciale">
                📌 {{ $bonneviemoeur->mention_speciale }}
            </div>
            @endif

            <p style="margin: 8px 0; font-size: 11px; font-style: italic;">
                En foi de quoi, le présent certificat est délivré pour servir et valoir ce que de droit.
            </p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="date-place">
                <p>Fait à {{ $bonneviemoeur->entite->nom ?? 'Kinshasa' }},</p>
                <p>Le {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="officier">L'Officier de l'État Civil</div>
                <div style="margin-top: 2px; font-size: 10px;">
                    {{ $bonneviemoeur->user->name ?? $bonneviemoeur->autorite ?? '_______________' }}
                </div>
                <div class="seal">
                    (Signature et Sceau)
                </div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
            <div class="qr-code">
                <img width="65" height="65" 
                     src="https://api.qrserver.com/v1/create-qr-code/?size=75x75&data={{ urlencode(route('bonneviemoeurs.verify', $bonneviemoeur)) }}&bgcolor=fffdf8&color=0d9488" 
                     alt="QR">
            </div>
            <div class="qr-text">
                <p><strong>Vérification d'authenticité</strong></p>
                <p>Scannez ce code pour vérifier la validité du certificat.</p>
                <p style="margin-top: 3px; font-size: 7px;">
                    Réf : {{ $bonneviemoeur->numero_officiel ?? 'BVM-' . $bonneviemoeur->id }} | 
                    Valable 3 mois à compter de la délivrance
                </p>
            </div>
        </div>

        <!-- Mentions légales -->
        <div class="legal-footer">
            RDC — Certificat délivré conformément à la législation en vigueur.<br>
            Document officiel • Toute falsification expose aux poursuites pénales.
        </div>

        <!-- Filigrane -->
        <div class="watermark">BVM</div>
    </div>
</body>
</html>