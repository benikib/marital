<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Divorce - RDC</title>
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
                linear-gradient(rgba(180, 130, 100, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(180, 130, 100, 0.03) 1px, transparent 1px);
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

        /* En-tête */
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
            color: #7c3aed;
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

        /* Corps */
        .content {
            margin: 12px 0;
            font-size: 12px;
            line-height: 1.45;
        }

        .intro {
            margin-bottom: 10px;
            font-style: italic;
            text-align: center;
        }

        .reference-block {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin: 10px 0;
        }

        .ref-item {
            flex: 1;
            background: #f8f6f0;
            padding: 8px 12px;
            border-radius: 6px;
            text-align: center;
            border: 1px solid #e2d3bb;
        }

        .ref-label {
            font-size: 9px;
            text-transform: uppercase;
            color: #7b6e54;
            letter-spacing: 0.5px;
        }

        .ref-value {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 2px;
        }

        .couple-section {
            margin: 12px 0;
        }

        .section-title {
            font-weight: 700;
            font-size: 13px;
            color: #5f4e2e;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #d4af37;
            letter-spacing: 2px;
        }

        .couple-grid {
            display: flex;
            gap: 15px;
        }

        .person-card {
            flex: 1;
            background: #fcfaf5;
            border: 1px solid #e3d6bf;
            border-radius: 8px;
            padding: 10px 14px;
        }
        .person-card.epoux {
            border-top: 3px solid #2563eb;
        }
        .person-card.epouse {
            border-top: 3px solid #db2777;
        }

        .person-header {
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }
        .person-card.epoux .person-header {
            color: #2563eb;
        }
        .person-card.epouse .person-header {
            color: #db2777;
        }

        .person-row {
            display: flex;
            margin-bottom: 4px;
            font-size: 11px;
        }

        .person-label {
            font-weight: 600;
            min-width: 90px;
            color: #6b5e3e;
            font-size: 10px;
            text-transform: uppercase;
        }

        .person-value {
            color: #1f2a36;
        }

        .divorce-info {
            background: #f5f0ff;
            padding: 10px 16px;
            border-radius: 8px;
            border-left: 4px solid #7c3aed;
            margin: 12px 0;
        }

        .divorce-row {
            display: flex;
            margin-bottom: 4px;
            font-size: 11px;
        }

        .divorce-label {
            font-weight: 600;
            min-width: 140px;
            color: #5b4a6e;
            font-size: 10px;
            text-transform: uppercase;
        }

        .divorce-value {
            color: #1f2a36;
            font-weight: 600;
        }

        .mention-box {
            margin: 10px 0;
            padding: 8px 12px;
            background: #fef3c7;
            border-radius: 4px;
            font-size: 10px;
            color: #92400e;
            border-left: 3px solid #f59e0b;
        }

        .attestation-text {
            margin: 10px 0;
            text-align: justify;
            font-size: 10px;
            line-height: 1.5;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 6px;
            font-style: italic;
        }

        /* Signature */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
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

        /* QR Code */
        .qr-section {
            margin-top: 10px;
            padding-top: 8px;
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
            bottom: 120px;
            left: 40px;
            opacity: 0.03;
            font-size: 60px;
            font-weight: bold;
            color: #7c3aed;
            transform: rotate(-20deg);
            pointer-events: none;
            white-space: nowrap;
        }

        /* Bouton */
        .print-btn {
            position: fixed;
            top: 16px;
            right: 16px;
            background: #7c3aed;
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
        }

        .print-btn:hover {
            background: #6d28d9;
        }

        /* Impression */
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
        <!-- Drapeau -->
        <div class="flag">
            <div class="blue"></div>
            <div class="yellow"></div>
            <div class="blue"></div>
            <div class="yellow"></div>
            <div class="red"></div>
        </div>

        <!-- En-tête -->
        <div class="header">
            <div class="republic">RÉPUBLIQUE DÉMOCRATIQUE DU CONGO</div>
            <div class="ministere">MINISTÈRE DE LA JUSTICE ET GARDE DES SCEAUX</div>
            <div class="title">ATTESTATION DE DIVORCE</div>
            <div class="numero">
                N° {{ $divorce->num_acte }}
            </div>
        </div>

        <!-- Corps -->
        <div class="content">
            <div class="intro">
                Le soussigné, Officier de l'État Civil, certifie que le divorce a été prononcé entre :
            </div>

            <!-- Références rapides -->
            <div class="reference-block">
                <div class="ref-item">
                    <div class="ref-label">Acte de mariage</div>
                    <div class="ref-value">{{ $divorce->mariage->num_acte ?? 'N/A' }}</div>
                </div>
                <div class="ref-item">
                    <div class="ref-label">Date du divorce</div>
                    <div class="ref-value">{{ optional($divorce->date_divorce)->format('d/m/Y') ?? 'N/A' }}</div>
                </div>
                <div class="ref-item">
                    <div class="ref-label">Jugement N°</div>
                    <div class="ref-value">{{ $divorce->numero_jugement ?? 'N/A' }}</div>
                </div>
            </div>

            <!-- Époux -->
            <div class="couple-section">
                <div class="section-title">⚮ Les ex-époux</div>
                <div class="couple-grid">
                    <!-- Ex-Époux -->
                    <div class="person-card epoux">
                        <div class="person-header">👨 Ancien Époux</div>
                        <div class="person-row">
                            <span class="person-label">Nom :</span>
                            <span class="person-value">{{ $divorce->mariage->epoux->nom ?? '—' }}</span>
                        </div>
                        <div class="person-row">
                            <span class="person-label">Prénom :</span>
                            <span class="person-value">{{ $divorce->mariage->epoux->prenom ?? '—' }}</span>
                        </div>
                        <div class="person-row">
                            <span class="person-label">Né le :</span>
                            <span class="person-value">{{ $divorce->mariage->epoux->date_naissance ? \Carbon\Carbon::parse($divorce->mariage->epoux->date_naissance)->format('d/m/Y') : '—' }}</span>
                        </div>
                        <div class="person-row">
                            <span class="person-label">À :</span>
                            <span class="person-value">{{ $divorce->mariage->epoux->lieu_naissance ?? '—' }}</span>
                        </div>
                    </div>

                    <!-- Ex-Épouse -->
                    <div class="person-card epouse">
                        <div class="person-header">👩 Ancienne Épouse</div>
                        <div class="person-row">
                            <span class="person-label">Nom :</span>
                            <span class="person-value">{{ $divorce->mariage->epouse->nom ?? '—' }}</span>
                        </div>
                        <div class="person-row">
                            <span class="person-label">Prénom :</span>
                            <span class="person-value">{{ $divorce->mariage->epouse->prenom ?? '—' }}</span>
                        </div>
                        <div class="person-row">
                            <span class="person-label">Née le :</span>
                            <span class="person-value">{{ $divorce->mariage->epouse->date_naissance ? \Carbon\Carbon::parse($divorce->mariage->epouse->date_naissance)->format('d/m/Y') : '—' }}</span>
                        </div>
                        <div class="person-row">
                            <span class="person-label">À :</span>
                            <span class="person-value">{{ $divorce->mariage->epouse->lieu_naissance ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations du divorce -->
            <div class="divorce-info">
                <div style="font-weight: 700; font-size: 11px; color: #7c3aed; margin-bottom: 8px;">📋 Détails du divorce</div>
                <div class="divorce-row">
                    <span class="divorce-label">Prononcé par :</span>
                    <span class="divorce-value">{{ $divorce->divorce_rendu }}</span>
                </div>
                <div class="divorce-row">
                    <span class="divorce-label">Date du divorce :</span>
                    <span class="divorce-value">{{ optional($divorce->date_divorce)->format('d/m/Y') ?? 'N/A' }}</span>
                </div>
                @if($divorce->date_jugement)
                <div class="divorce-row">
                    <span class="divorce-label">Date du jugement :</span>
                    <span class="divorce-value">{{ \Carbon\Carbon::parse($divorce->date_jugement)->format('d/m/Y') }}</span>
                </div>
                @endif
                @if($divorce->numero_jugement)
                <div class="divorce-row">
                    <span class="divorce-label">Numéro du jugement :</span>
                    <span class="divorce-value">{{ $divorce->numero_jugement }}</span>
                </div>
                @endif
                @if($divorce->date_transcription)
                <div class="divorce-row">
                    <span class="divorce-label">Transcrit le :</span>
                    <span class="divorce-value">{{ \Carbon\Carbon::parse($divorce->date_transcription)->format('d/m/Y') }}</span>
                </div>
                @endif
                <div class="divorce-row">
                    <span class="divorce-label">Entité :</span>
                    <span class="divorce-value">{{ $divorce->entite->nom ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- Mentions complémentaires -->
            @if($divorce->mentions_complementaire)
            <div class="mention-box">
                <strong>📌 Mentions complémentaires :</strong> {{ $divorce->mentions_complementaire }}
            </div>
            @endif

            <!-- Texte légal -->
            <div class="attestation-text">
                <p>
                    Le divorce a été prononcé conformément aux dispositions du Code de la Famille 
                    de la République Démocratique du Congo et transcrit sur les registres de l'état civil.
                </p>
            </div>

            <p style="margin: 8px 0; font-size: 11px; font-style: italic;">
                En foi de quoi, la présente attestation est délivrée pour servir et valoir ce que de droit.
            </p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="date-place">
                <p>Fait à {{ $divorce->entite->nom ?? 'Kinshasa' }},</p>
                <p>Le {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="officier">L'Officier de l'État Civil</div>
                <div style="margin-top: 2px; font-size: 10px;">
                    {{ $divorce->soussignataire ?? '_______________' }}
                </div>
                <div class="seal">
                    (Signature et Sceau officiel)
                </div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
            <div class="qr-code">
                <img width="65" height="65" 
                     src="https://api.qrserver.com/v1/create-qr-code/?size=75x75&data={{ urlencode(route('divorces.verify', $divorce)) }}&bgcolor=fffdf8&color=7c3aed" 
                     alt="QR">
            </div>
            <div class="qr-text">
                <p><strong>Vérification d'authenticité</strong></p>
                <p>Scannez ce code pour vérifier la validité de l'attestation.</p>
                <p style="margin-top: 3px; font-size: 7px;">
                    Réf : {{ $divorce->num_acte }} | Acte transcrit
                </p>
            </div>
        </div>

        <!-- Mentions légales -->
        <div class="legal-footer">
            République Démocratique du Congo — Acte authentique délivré conformément au Code de la Famille.<br>
            Document officiel • Toute falsification expose aux poursuites pénales (Art. 124 CP).
        </div>

        <!-- Filigrane -->
        <div class="watermark">DIVORCE</div>
    </div>
</body>
</html>