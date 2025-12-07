<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Mariage - RDC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --rdc-blue: #0073ce;
            --rdc-yellow: #f7d417;
            --rdc-red: #ce1126;
            --gold: #d4af37;
        }

        body {
            background-color: #f9f5e9;
            font-family: 'Times New Roman', serif;
            padding: 10px 0;
        }

        .certificate-container {
            border: 10px double var(--gold);
            padding: 1rem;
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fffef7;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .rdc-flag {
            display: flex;
            justify-content: center;
            margin: 0 auto 0.5rem;
            height: 25px;
            width: 80%;
        }

        .flag-stripe {
            height: 100%;
            flex: 1;
        }

        .blue-stripe {
            background-color: var(--rdc-blue);
        }

        .yellow-stripe {
            background-color: var(--rdc-yellow);
        }

        .red-stripe {
            background-color: var(--rdc-red);
        }

        .certificate-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0.5rem 0;
            color: var(--rdc-blue);
            text-transform: uppercase;
        }

        .certificate-title::after {
            content: "";
            display: block;
            width: 250px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--rdc-blue), var(--rdc-yellow), var(--rdc-red), transparent);
            margin: 0.3rem auto;
        }

        .certificate-content {
            padding: 0.5rem;
            font-size: 0.95rem;
        }

        .info-block {
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            min-width: 120px;
        }

        .info-value {
            border-bottom: 1px dotted #666;
            padding: 0 5px;
            min-width: 200px;
            display: inline-block;
        }

        .couple-section {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .person-section {
            flex: 1;
            padding: 0.5rem;
            background-color: rgba(247, 212, 23, 0.05);
            border-left: 2px solid var(--rdc-blue);
        }

        .bride-section {
            border-left-color: var(--rdc-red);
        }

        .section-title {
            font-weight: bold;
            color: var(--rdc-blue);
            margin-bottom: 0.5rem;
        }

        .marriage-details {
            margin: 1rem 0;
            padding: 0.5rem;
            background-color: rgba(0, 115, 206, 0.03);
        }

        .signature-section {
            text-align: right;
            margin-top: 1rem;
        }

        .signature-line {
            width: 250px;
            border-top: 1px solid #000;
            margin-left: auto;
            margin-top: 0.5rem;
            position: relative;
        }

        .signature-line::after {
            content: "Signature et cachet";
            position: absolute;
            right: 0;
            top: -0.6rem;
            font-size: 0.7rem;
            background: #fffef7;
            padding: 0 3px;
        }

        .official-stamp {
            position: absolute;
            bottom: 15px;
            right: 15px;
        }

        .stamp {
            width: 80px;
            height: 80px;
            border: 1px dashed var(--rdc-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-15deg);
            font-weight: bold;
            color: var(--rdc-red);
            font-size: 0.8rem;
        }

        .document-number {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 0.8rem;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .certificate-container {
                box-shadow: none;
                border: 10px double var(--gold);
            }

            @page {
                size: A4 landscape;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="document-number">
            N°: MC-{{ date('Y-m', strtotime($mariage->date_mariage)) }}-{{ $mariage->id }}
        </div>

        <div class="certificate-header">
            <div class="rdc-flag">
                <div class="flag-stripe blue-stripe"></div>
                <div class="flag-stripe yellow-stripe"></div>
                <div class="flag-stripe red-stripe"></div>
                <div class="flag-stripe yellow-stripe"></div>
                <div class="flag-stripe blue-stripe"></div>
            </div>
            <div style="font-weight: bold; font-size: 1.1rem;">
                RÉPUBLIQUE DÉMOCRATIQUE DU CONGO
            </div>
            <div style="font-size: 1rem;">
                COMMUNE DE <span class="info-value">{{ $mariage->commune->nom }}</span>
            </div>
            <div class="certificate-title">CERTIFICAT DE MARIAGE</div>
        </div>

        <div class="certificate-content">
            <div class="info-block">
                Nous, Officier de l'État Civil de la Commune de <span
                    class="info-value">{{ $mariage->commune->nom }}</span>,
                certifions que le mariage a été dûment célébré entre :
            </div>

            <div class="couple-section">
                <div class="person-section groom-section">
                    <div class="section-title">ÉPOUX</div>
                    <div class="info-block">
                        <span class="info-label">Nom et prénoms:</span>
                        <span class="info-value">{{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}
                            {{ $mariage->epoux->postnom }}</span>
                    </div>
                    <div class="info-block">
                        <span class="info-label">Né le:</span>
                        <span class="info-value">{{ date('d/m/Y', strtotime($mariage->epoux->date_naissance)) }}</span>
                        <span class="info-label">à:</span>
                        <span class="info-value">{{ $mariage->epoux->lieu_naissance }}</span>
                    </div>
                    <div class="info-block">
                        <span class="info-label">Fils de:</span>
                        <span class="info-value">
                            {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->nom }}
                            {{ $mariage->epoux->parentsEpoux->where('type', 'pere')->first()->prenom }}
                        </span>
                    </div>
                    <div class="info-block">
                        <span class="info-label">et de:</span>
                        <span class="info-value">
                            {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->nom }}
                            {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->prenom }}
                            {{ $mariage->epoux->parentsEpoux->where('type', 'mere')->first()->postnom }}
                        </span>
                    </div>
                </div>

                <div class="person-section bride-section">
                    <div class="section-title">ÉPOUSE</div>
                    <div class="info-block">
                        <span class="info-label">Nom et prénoms:</span>
                        <span class="info-value">{{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}
                            {{ $mariage->epouse->postnom }}</span>
                    </div>
                    <div class="info-block">
                        <span class="info-label">Née le:</span>
                        <span
                            class="info-value">{{ date('d/m/Y', strtotime($mariage->epouse->date_naissance)) }}</span>
                        <span class="info-label">à:</span>
                        <span class="info-value">{{ $mariage->epouse->lieu_naissance }}</span>
                    </div>
                    <div class="info-block">
                        <span class="info-label">Fille de:</span>
                        <span class="info-value">
                            {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->nom }}
                            {{ $mariage->epouse->parentsEpouse->where('type', 'pere')->first()->prenom }}
                        </span>
                    </div>
                    <div class="info-block">
                        <span class="info-label">et de:</span>
                        <span class="info-value">
                            {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->nom }}
                            {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->prenom }}
                            {{ $mariage->epouse->parentsEpouse->where('type', 'mere')->first()->postnom }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="marriage-details">
                <div class="info-block">
                    <span class="info-label">Date du mariage:</span>
                    <span class="info-value">{{ date('d/m/Y', strtotime($mariage->date_mariage)) }}</span>
                </div>
                <div class="info-block">
                    <span class="info-label">Lieu de célébration:</span>
                    <span class="info-value">{{ $mariage->lieu_mariage }}</span>
                </div>
                <div class="info-block">
                    <span class="info-label">Régime matrimonial:</span>
                    <span class="info-value">{{ $mariage->regimeMatrimonial->contrat->type_contrat }}</span>
                </div>
                <div class="info-block">
                    <span class="info-label">Date d'enregistrement:</span>
                    <span class="info-value">{{ date('d/m/Y') }}</span>
                </div>
            </div>

            <div class="signature-section">
                <div>Fait à <span class="info-value">{{ $mariage->commune->nom }}</span>, le <span
                        class="info-value">{{ date('d/m/Y') }}</span></div>
                <div class="signature-line"></div>
                <div style="font-weight: bold; font-style: italic;">L'Officier de l'État Civil</div>
            </div>

            <div class="official-stamp">
                <div class="stamp">OFFICIEL</div>
            </div>
        </div>
    </div>
</body>

</html>
