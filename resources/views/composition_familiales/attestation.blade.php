<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Composition Familiale - RDC</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page { size: A4; margin: 0.35in; }

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
                linear-gradient(rgba(120, 120, 180, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(120, 120, 180, 0.03) 1px, transparent 1px);
            background-size: 25px 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid #b89b5b;
            border-radius: 6px;
            position: relative;
            padding: 18px 28px 22px 28px;
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

        .flag { display: flex; width: 100%; height: 14px; margin-bottom: 8px; border-radius: 2px; overflow: hidden; }
        .flag .blue { background: #0073ce; flex: 1; }
        .flag .yellow { background: #f7d417; flex: 1; }
        .flag .red { background: #ce1126; flex: 1; }

        .header { text-align: center; margin-bottom: 12px; }
        .republic { font-size: 13px; letter-spacing: 3px; text-transform: uppercase; color: #1e3a8a; font-weight: 700; margin: 3px 0; }
        .ministere { font-size: 10px; color: #5a4a2e; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; }
        .title {
            font-size: 21px;
            font-weight: 800;
            color: #4338ca;
            text-transform: uppercase;
            letter-spacing: 2.5px;
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

        .content { margin: 12px 0; font-size: 12px; line-height: 1.45; }
        .intro { margin-bottom: 10px; font-style: italic; text-align: center; }

        .reference-block { display: flex; justify-content: space-between; gap: 10px; margin: 10px 0; }
        .ref-item {
            flex: 1;
            background: #f8f6f0;
            padding: 8px 12px;
            border-radius: 6px;
            text-align: center;
            border: 1px solid #e2d3bb;
        }
        .ref-label { font-size: 9px; text-transform: uppercase; color: #7b6e54; letter-spacing: 0.5px; }
        .ref-value { font-size: 13px; font-weight: 700; color: #1e293b; margin-top: 2px; }

        .family-info {
            background: #eef2ff;
            padding: 10px 16px;
            border-radius: 8px;
            border-left: 4px solid #4338ca;
            margin: 12px 0;
        }

        .row { display: flex; margin-bottom: 5px; }
        .label {
            font-weight: 700;
            min-width: 160px;
            color: #5f4e2e;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.3px;
        }
        .value { font-weight: 600; color: #1f2a36; font-size: 12px; }

        .children-block {
            margin: 12px 0;
            padding: 10px 16px;
            background: #f9f6ee;
            border-radius: 8px;
            border: 1px solid #e2d3bb;
        }
        .children-title {
            font-weight: 700;
            font-size: 11px;
            color: #5f4e2e;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-bottom: 1px solid #d4af37;
            padding-bottom: 3px;
        }
        .child-item {
            margin-bottom: 6px;
            padding: 6px 8px;
            border-radius: 4px;
            background: #fff;
            border: 1px solid #eee3ca;
            font-size: 11px;
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

        .signature-section { display: flex; justify-content: space-between; margin-top: 18px; }
        .date-place { font-size: 11px; }
        .signature { text-align: right; }
        .signature-line { border-top: 1.5px solid #1e2a36; width: 200px; margin-top: 20px; margin-bottom: 4px; }
        .officier { font-weight: 700; font-size: 12px; color: #2e3b4e; text-transform: uppercase; }
        .seal { margin-top: 3px; font-size: 9px; color: #6f6a5e; }

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

        .legal-footer { margin-top: 10px; font-size: 8px; color: #8a846c; text-align: center; }
        .watermark {
            position: absolute;
            bottom: 110px;
            left: 35px;
            opacity: 0.03;
            font-size: 52px;
            font-weight: bold;
            color: #4338ca;
            transform: rotate(-20deg);
            pointer-events: none;
            white-space: nowrap;
        }

        .print-btn {
            position: fixed;
            top: 16px;
            right: 16px;
            background: #4338ca;
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
        .print-btn:hover { background: #3730a3; }

        @media print {
            html, body { height: 100%; margin: 0 !important; padding: 0 !important; background: white; }
            body { display: block; padding: 0; }
            .attestation {
                box-shadow: none;
                border: 2px solid #b89b5b;
                background: white;
                padding: 0.15in 0.25in;
                max-width: 100%;
            }
            .print-btn { display: none; }
            * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">
        <span>🖨️</span> Imprimer (1 page)
    </button>

    <div class="attestation">
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
            <div class="title">ATTESTATION DE COMPOSITION FAMILIALE</div>
            <div class="numero">N° {{ $compositionFamiliale->num_acte ?? 'CF-' . date('Y') . '-' . str_pad($compositionFamiliale->id, 5, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="content">
            <div class="intro">
                Le soussigné, Officier de l'État Civil, certifie la composition de ménage ci-dessous :
            </div>

            <div class="reference-block">
                <div class="ref-item">
                    <div class="ref-label">Acte de composition</div>
                    <div class="ref-value">{{ $compositionFamiliale->num_acte ?? 'N/A' }}</div>
                </div>
                <div class="ref-item">
                    <div class="ref-label">Date d'enregistrement</div>
                    <div class="ref-value">{{ $compositionFamiliale->created_at?->format('d/m/Y') ?? 'N/A' }}</div>
                </div>
                <div class="ref-item">
                    <div class="ref-label">Nombre d'enfants</div>
                    <div class="ref-value">{{ $compositionFamiliale->nombre_enfants ?? $compositionFamiliale->enfants->count() }}</div>
                </div>
            </div>

            <div class="family-info">
                
                <div class="row">
                    <span class="label">Couple de référence :</span>
                    <span class="value">
                        {{ $compositionFamiliale->mariage->epoux->nom ?? '-' }} {{ $compositionFamiliale->mariage->epoux->prenom ?? '' }}
                        et
                        {{ $compositionFamiliale->mariage->epouse->nom ?? '-' }} {{ $compositionFamiliale->mariage->epouse->prenom ?? '' }}
                    </span>
                </div>
                <div class="row">
                    <span class="label">Entité administrative :</span>
                    <span class="value">{{ $compositionFamiliale->entite->nom ?? 'N/A' }}</span>
                </div>
                <div class="row">
                    <span class="label">Soussignataire :</span>
                    <span class="value">{{ $compositionFamiliale->soussignataire ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="children-block">
                <div class="children-title">Liste des enfants</div>
                @forelse($compositionFamiliale->enfants as $index => $enfant)
                    <div class="child-item">
                        <strong>{{ $index + 1 }}.</strong>
                        {{ $enfant->nom }} {{ $enfant->postnom }} {{ $enfant->prenom }}
                        — {{ $enfant->sexe ?? 'N/A' }},
                        né(e) le {{ optional($enfant->date_naissance)->format('d/m/Y') ?? 'N/A' }}
                        @if($enfant->lieu_naissance)
                            à {{ $enfant->lieu_naissance }}
                        @endif
                    </div>
                @empty
                    <div class="child-item">Aucun enfant enregistré dans cet acte.</div>
                @endforelse
            </div>

            <div class="attestation-text">
                La présente attestation est établie conformément aux dispositions légales en vigueur en
                République Démocratique du Congo et délivrée à l'intéressé pour servir et valoir ce que de droit.
            </div>
        </div>

        <div class="signature-section">
            <div class="date-place">
                <p>Fait à {{ $compositionFamiliale->entite->nom ?? 'Kinshasa' }},</p>
                <p>Le {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="officier">L'Officier de l'État Civil</div>
                <div style="margin-top: 2px; font-size: 10px;">
                    {{ $compositionFamiliale->soussignataire ?? $compositionFamiliale->user->name ?? '_______________' }}
                </div>
                <div class="seal">(Signature et sceau officiel)</div>
            </div>
        </div>

        <div class="qr-section">
            <div class="qr-code">
                <img width="65" height="65"
                    src="https://api.qrserver.com/v1/create-qr-code/?size=75x75&data={{ urlencode(route('composition_familiales.show', $compositionFamiliale)) }}&bgcolor=fffdf8&color=4338ca"
                    alt="QR">
            </div>
            <div class="qr-text">
                <p><strong>Vérification d'authenticité</strong></p>
                <p>Scannez ce code pour consulter l'acte enregistré.</p>
                <p style="margin-top: 3px; font-size: 7px;">
                    Réf : {{ $compositionFamiliale->num_acte ?? 'CF-' . $compositionFamiliale->id }}
                </p>
            </div>
        </div>

        <div class="legal-footer">
            République Démocratique du Congo — Document officiel d'état civil.<br>
            Toute falsification expose aux poursuites prévues par la loi.
        </div>

        <div class="watermark">COMPOSITION FAMILIALE</div>
    </div>
</body>
</html>
