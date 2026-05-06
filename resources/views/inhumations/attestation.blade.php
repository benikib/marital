<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acte d'inhumation - RDC</title>
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

        .acte {
            max-width: 850px;
            width: 100%;
            margin: 0 auto;
            background: #fffdf8;
            background-image: 
                linear-gradient(rgba(100, 150, 200, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(100, 150, 200, 0.03) 1px, transparent 1px);
            background-size: 25px 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid #b89b5b;
            border-radius: 6px;
            position: relative;
            padding: 18px 28px 22px 28px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .acte::before {
            content: "";
            position: absolute;
            top: 8px; left: 8px; right: 8px; bottom: 8px;
            border: 1.5px double #d4af37;
            border-radius: 3px;
            pointer-events: none;
            opacity: 0.5;
        }

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

        .identity-block {
            background: #f0f7ff;
            padding: 10px 16px;
            border-radius: 8px;
            border-left: 4px solid #0284c7;
            margin: 10px 0;
        }

        .identity-row {
            display: flex;
            margin-bottom: 5px;
            flex-wrap: wrap;
        }

        .label {
            font-weight: 700;
            min-width: 140px;
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

        .parents-block {
            margin: 10px 0;
            padding: 10px 16px;
            background: #f9f6ee;
            border-radius: 8px;
            border: 1px solid #e2d3bb;
        }

        .parents-title {
            font-weight: 700;
            font-size: 11px;
            color: #5f4e2e;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-bottom: 1px solid #d4af37;
            padding-bottom: 3px;
        }

        .inhumation-block {
            margin: 10px 0;
            padding: 10px 16px;
            background: #eef2ff;
            border-radius: 8px;
            border-left: 4px solid #4f46e5;
        }

        .declaration-block {
            margin: 10px 0;
            padding: 10px 12px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
        }

        .attestation-text {
            margin: 12px 0 8px;
            text-align: justify;
            font-size: 11px;
            line-height: 1.5;
            padding: 8px 12px;
            background: #f0fdf4;
            border-radius: 6px;
            border-left: 3px solid #22c55e;
        }

        .mention-box {
            margin: 8px 0;
            padding: 6px 10px;
            background: #fef3c7;
            border-radius: 4px;
            font-size: 10px;
            color: #92400e;
            border-left: 3px solid #f59e0b;
        }

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
            bottom: 100px;
            left: 60px;
            opacity: 0.03;
            font-size: 70px;
            font-weight: bold;
            color: #0284c7;
            transform: rotate(-20deg);
            pointer-events: none;
            white-space: nowrap;
        }

        .print-btn {
            position: fixed;
            top: 16px;
            right: 16px;
            background: #0284c7;
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
            background: #0369a1;
        }

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
            .acte {
                box-shadow: none;
                border: 2px solid #b89b5b;
                background: white;
                padding: 0.15in 0.25in;
                max-width: 100%;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
            .acte::before {
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

    <div class="acte">
        <div class="flag">
            <div class="blue"></div>
            <div class="yellow"></div>
            <div class="blue"></div>
            <div class="yellow"></div>
            <div class="red"></div>
        </div>

        <div class="header">
            <div class="republic">RÉPUBLIQUE DÉMOCRATIQUE DU CONGO</div>
            <div class="ministere">MINISTÈRE DE L'INTÉRIEUR ET SÉCURITÉ</div>
            <div class="ministere">SERVICE DE L'ÉTAT CIVIL</div>
            <div class="title">ACTE D'INHUMATION</div>
            <div class="numero">
                N° {{ $inhumation->numero_acte ?? 'INH-' . date('Y') . '-' . str_pad($inhumation->id ?? 1, 5, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <div class="content">
            <div class="intro">
                L'an {{ date('Y') }}, le {{ now()->translatedFormat('d F') }}, à {{ now()->format('H:i') }}
            </div>

            <!-- Identité du défunt -->
            <div class="identity-block">
                <div class="identity-row">
                    <span class="label">Nom et prénoms :</span>
                    <span class="value">
                        <strong>{{ strtoupper($inhumation->personne->nom ?? '__________') }}</strong> 
                        {{ $inhumation->personne->prenom ?? '__________' }}
                        @if(($inhumation->personne->postnom ?? false))
                            {{ $inhumation->personne->postnom }}
                        @endif
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Sexe :</span>
                    <span class="value">{{ ($inhumation->personne->sexe ?? '') == 'M' ? 'Masculin' : 'Féminin' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Date de naissance :</span>
                    <span class="value">
                        {{ isset($inhumation->personne->date_naissance) ? \Carbon\Carbon::parse($inhumation->personne->date_naissance)->translatedFormat('d F Y') : '__________' }}
                    </span>
                </div>
                <div class="identity-row">
                    <span class="label">Lieu de naissance :</span>
                    <span class="value">{{ $inhumation->personne->lieu_naissance ?? '__________' }}</span>
                </div>
                {{-- <div class="identity-row">
                    <span class="label">Date du décès :</span>
                    <span class="value">{{ isset($inhumation->date_deces) ? \Carbon\Carbon::parse($inhumation->date_deces)->translatedFormat('d F Y') : '__________' }}</span>
                </div> --}}
            </div>

            <!-- Filiation -->
            <div class="parents-block">
                <div class="parents-title"> Filiation du défunt</div>
                <div class="identity-row">
                    <span class="label">Père :</span>
                    <span class="value">{{ $inhumation->pere_nom ?? $inhumation->personne->pere ?? '__________' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Mère :</span>
                    <span class="value">{{ $inhumation->mere_nom ?? $inhumation->personne->mere ?? '__________' }}</span>
                </div>
            </div>

            <!-- Informations d'inhumation -->
            <div class="inhumation-block">
                <div class="identity-row">
                    <span class="label">Lieu d'inhumation :</span>
                    <span class="value">{{ $inhumation->lieu_inhumation ?? '__________' }}</span>
                </div>
                <div class="identity-row">
                    <span class="label">Date d'inhumation :</span>
                    <span class="value">{{ isset($inhumation->date_inhumation) ? \Carbon\Carbon::parse($inhumation->date_inhumation)->translatedFormat('d F Y') : '__________' }}</span>
                </div>
                {{-- <div class="identity-row">
                    <span class="label">Heure de l'inhumation :</span>
                    <span class="value">{{ $inhumation->heure_inhumation ?? '__________' }}</span>
                </div> --}}
                <div class="identity-row">
                    <span class="label">Concession / Cimetière :</span>
                    <span class="value">{{ $inhumation->cimetiere ?? '__________' }}</span>
                </div>
            </div>

            <!-- Déclarant -->
            <div class="declaration-block">
                <div style="font-weight: 700; font-size: 11px; margin-bottom: 5px;">📝 Déclaration</div>
                <div class="identity-row">
                    <span class="label">Déclarant :</span>
                    <span class="value">{{ $inhumation->declarant_nom ?? '__________' }}</span>
                </div>
                @if($inhumation->declarant_qualite ?? false)
                <div class="identity-row">
                    <span class="label">Qualité :</span>
                    <span class="value">{{ $inhumation->declarant_qualite }}</span>
                </div>
                @endif
                <div class="identity-row">
                    <span class="label">Date de déclaration :</span>
                    <span class="value">
                        {{ isset($inhumation->date_declaration) ? \Carbon\Carbon::parse($inhumation->date_declaration)->format('d/m/Y') : (isset($inhumation->created_at) ? $inhumation->created_at->format('d/m/Y') : '__________') }}
                    </span>
                </div>
            </div>

            <!-- Mention marginale -->
            @if($inhumation->mention_marginale ?? false)
            <div class="mention-box">
                <strong>📌 Mention marginale :</strong> {{ $inhumation->mention_marginale }}
            </div>
            @endif

            <!-- Texte légal -->
            <div class="attestation-text">
                <p>
                    Le présent acte d'inhumation est dressé conformément aux dispositions du Code de la Famille 
                    de la République Démocratique du Congo et au règlement sur les sépultures et cimetières.
                    Il atteste que le corps de la personne ci-dessus désignée a été inhumé au lieu et date indiqués.
                </p>
                <p style="margin-top: 6px;">
                    Transcription sur les registres de l'état civil de 
                    <strong>{{ $inhumation->entite->nom ?? '__________' }}</strong>.
                </p>
            </div>

            <p style="margin: 8px 0; font-size: 11px; font-style: italic;">
                Délivré pour servir et valoir ce que de droit.
            </p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="date-place">
                <p>Fait à {{ $inhumation->entite->nom ?? 'Kinshasa' }},</p>
                <p>Le {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="officier">L'Officier de l'État Civil</div>
                <div style="margin-top: 2px; font-size: 10px;">
                    {{ $inhumation->officier_nom ?? ($inhumation->user->name ?? '_______________') }}
                </div>
                <div class="seal">
                    (Signature et sceau officiel)
                </div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
            <div class="qr-code">
                <img width="65" height="65" 
                     src="https://api.qrserver.com/v1/create-qr-code/?size=75x75&data={{ urlencode(route('inhumations.verify', $inhumation->id ?? 1)) }}&bgcolor=fffdf8&color=0284c7" 
                     alt="QR Code de vérification">
            </div>
            <div class="qr-text">
                <p><strong>🔐 Vérification d'authenticité</strong></p>
                <p>Scannez ce code pour vérifier la validité de l'acte d'inhumation.</p>
                <p style="margin-top: 3px; font-size: 7px;">
                    Réf : {{ $inhumation->numero_acte ?? 'INH-' . ($inhumation->id ?? 'XXXXX') }}
                </p>
            </div>
        </div>

        <!-- Mentions légales -->
        <div class="legal-footer">
            République Démocratique du Congo — Acte authentique d'inhumation délivré conformément au Code de la Famille.<br>
            Document officiel • Toute falsification expose aux poursuites pénales (Art. 124 CP).
        </div>

        <div class="watermark">ACTE D'INHUMATION</div>
    </div>
</body>
</html> 