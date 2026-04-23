<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Nationalité - RDC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 0.4in;
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

        .attestation {
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
            padding: 20px 30px 25px 30px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .attestation::before {
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
            margin-bottom: 15px;
        }

        .flag {
            display: flex;
            width: 100%;
            height: 15px;
            margin-bottom: 10px;
            border-radius: 2px;
            overflow: hidden;
        }
        .flag .blue { background: #0073ce; flex: 1; }
        .flag .yellow { background: #f7d417; flex: 1; }
        .flag .red { background: #ce1126; flex: 1; }

        .republic {
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #1e3a8a;
            font-weight: 700;
            margin: 5px 0 2px;
        }

        .ministere {
            font-size: 11px;
            color: #5a4a2e;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .title {
            font-size: 24px;
            font-weight: 800;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 10px 0 5px;
            text-decoration: underline;
            text-underline-offset: 6px;
            text-decoration-color: #d4af37;
            text-decoration-thickness: 1.5px;
        }

        .numero {
            font-size: 13px;
            background: #f1efe7;
            display: inline-block;
            padding: 4px 20px;
            border-radius: 30px;
            color: #3e3a2e;
            font-weight: 600;
            border: 1px dashed #c9b27e;
            margin-top: 8px;
        }

        /* Corps - COMPACT */
        .content {
            margin: 15px 0;
            font-size: 13px;
            line-height: 1.5;
        }

        .intro {
            margin-bottom: 12px;
            font-style: italic;
        }

        .identity-block {
            background: #f9f6ee;
            padding: 12px 18px;
            border-radius: 8px;
            border-left: 4px solid #1e3a8a;
            margin: 12px 0;
        }

        .identity-row {
            display: flex;
            margin-bottom: 6px;
        }

        .label {
            font-weight: 700;
            min-width: 140px;
            color: #5f4e2e;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.3px;
        }

        .value {
            font-weight: 600;
            color: #1f2a36;
            font-size: 13px;
        }

        .origin-block {
            margin: 12px 0;
            padding: 10px 0;
            border-top: 1px solid #ddd2bd;
            border-bottom: 1px solid #ddd2bd;
        }

        .origin-block p {
            font-size: 12px;
            line-height: 1.5;
        }

        .declaration {
            margin: 15px 0 10px;
            text-align: justify;
            font-size: 12px;
            padding: 8px 12px;
            background: #f4f0e7;
            border-radius: 6px;
        }

        /* Signature - COMPACT */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .date-place {
            font-size: 12px;
        }

        .signature {
            text-align: right;
        }

        .signature-line {
            border-top: 1.5px solid #1e2a36;
            width: 220px;
            margin-top: 25px;
            margin-bottom: 5px;
        }

        .officier {
            font-weight: 700;
            font-size: 13px;
            color: #2e3b4e;
            text-transform: uppercase;
        }

        .seal {
            margin-top: 5px;
            font-size: 10px;
            color: #6f6a5e;
        }

        /* QR Code - COMPACT */
        .qr-section {
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px dashed #cbb586;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .qr-code {
            background: white;
            padding: 5px;
            border-radius: 6px;
            border: 1px solid #e2d3bb;
        }

        .qr-text {
            font-size: 10px;
            color: #6f6a5e;
            line-height: 1.3;
        }

        .legal-footer {
            margin-top: 12px;
            font-size: 9px;
            color: #8a846c;
            text-align: center;
        }

        .watermark {
            position: absolute;
            bottom: 80px;
            left: 60px;
            opacity: 0.03;
            font-size: 80px;
            font-weight: bold;
            color: #1e3a8a;
            transform: rotate(-20deg);
            pointer-events: none;
            white-space: nowrap;
        }

        /* Bouton impression */
        .print-btn {
            position: fixed;
            top: 16px;
            right: 16px;
            background: #1e3a8a;
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
            background: #112b66;
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
            .attestation {
                box-shadow: none;
                border: 2px solid #b89b5b;
                background: white;
                padding: 0.15in 0.25in;
                max-width: 100%;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
            .attestation::before {
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

        /* Ajustements écran */
        @media screen and (max-width: 700px) {
            body { padding: 8px; }
            .attestation { padding: 15px 18px; }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">
        <span>🖨️</span> Imprimer (1 page)
    </button>

    <div class="attestation">
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
            <div class="title">ATTESTATION DE NATIONALITÉ</div>
            <div class="numero">
                N° {{ $nationalite->numero_officiel ?? 'NAT-' . date('Y') . '-' . str_pad($nationalite->id, 5, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <!-- Corps -->
        <div class="content">
            <div class="intro">
                Le soussigné, Officier de l'État Civil, certifie et atteste que :
            </div>

            <!-- Identité -->
            <div class="identity-block">
                <div class="identity-row">
                    <span class="label">Nom et Prénom :</span>
                    <span class="value">
                        {{ $nationalite->personne->nom }} {{ $nationalite->personne->prenom }}
                        @if($nationalite->personne->postnom)
                            {{ $nationalite->personne->postnom }}
                        @endif
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Sexe :</span>
                    <span class="value">{{ $nationalite->personne->sexe == 'M' ? 'Masculin' : 'Féminin' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Date de naissance :</span>
                    <span class="value">
                        {{ $nationalite->personne->date_naissance ? \Carbon\Carbon::parse($nationalite->personne->date_naissance)->translatedFormat('d F Y') : 'Non renseignée' }}
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Lieu de naissance :</span>
                    <span class="value">{{ $nationalite->personne->lieu_naissance ?? 'Non renseigné' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Filiation :</span>
                    <span class="value">
                        {{ $nationalite->personne->sexe == 'M' ? 'Fils' : 'Fille' }} de 
                        {{ $nationalite->personne->pere ?? '________' }}  de nationalité {{ $nationalite->nationalite_pere ?? '________' }} et de 
                        {{ $nationalite->personne->mere ?? '________' }} de nationalité {{ $nationalite->nationalite_mere ?? '________' }}
                    </span>
                </div>
            </div>

            <!-- Origine géographique -->
          

            <div class="origin-block">
                <p style="margin-bottom: 5px; font-weight: 600; font-size: 12px;">Est originaire de :</p>
                <p style="margin-left: 15px; font-size: 12px;">
                    Localité de <strong>{{ $nationalite->personne->localite->nom ?? '______________' }}</strong>, 
                    Secteur de <strong>{{ $nationalite->personne->secteur->nom ?? '______________' }}</strong>, 
                    Territoire de <strong>{{ $nationalite->personne->territoire->nom ?? '______________' }}</strong>, 
                    District de <strong>{{ $nationalite->personne->district->nom ?? '______________' }}</strong>, 
                    Province de <strong>{{ $nationalite->personne->province->nom ?? '______________' }}</strong> 
                    en RDC.
                </p>
            </div>

            <div style="margin: 10px 0;">
                <p style="font-weight: 600; font-size: 12px;">Résidant à :</p>
                <p style="margin-left: 15px; font-size: 12px;">
                    <strong>{{ $nationalite->personne->adresse ?? $nationalite->residence ?? '______________' }}</strong>
                </p>
            </div>

            <!-- Déclaration -->
            <div class="declaration">
                <p>
                    <strong>EST DE NATIONALITÉ CONGOLAISE D'ORIGINE</strong>, 
                    conformément à la Loi n° 04/024 du 12 novembre 2004 relative 
                    à la nationalité congolaise.
                </p>
            </div>

            <p style="margin: 10px 0; font-size: 12px;">
                En foi de quoi, la présente attestation lui est délivrée pour servir 
                et valoir ce que de droit.
            </p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="date-place">
                <p>Fait à {{ $nationalite->entite->nom ?? 'Kinshasa' }},</p>
                <p>Le {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="officier">L'Officier de l'État Civil</div>
                <div style="margin-top: 3px; font-size: 11px;">
                    {{ $nationalite->user->name ?? '_______________' }}
                </div>
                <div class="seal">
                    (Signature et Sceau)
                </div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
            <div class="qr-code">
                <img width="70" height="70" 
                     src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ urlencode(route('nationalites.verify', $nationalite)) }}&bgcolor=fffdf8&color=1e3a8a" 
                     alt="QR">
            </div>
            <div class="qr-text">
                <p><strong>Vérification d'authenticité</strong></p>
                <p>Scannez ce code pour vérifier la validité.</p>
                <p style="margin-top: 4px; font-size: 8px;">
                    Réf : {{ $nationalite->numero_officiel ?? 'NAT-' . $nationalite->id }}
                </p>
            </div>
        </div>

        <!-- Mentions légales -->
        <div class="legal-footer">
            RDC — Acte authentique délivré conformément à la Loi sur la nationalité.<br>
            Toute falsification expose aux poursuites pénales.
        </div>

        <!-- Filigrane -->
        <div class="watermark">RDC</div>
    </div>
</body>
</html>