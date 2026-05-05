<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificat de Mariage — RDC</title>
  <style>
    /* RESET COMPLET POUR IMPRESSION PARFAITE */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
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

    /* CONTENEUR PRINCIPAL — TAILLE FIXE POUR UNE PAGE */
    .certificate {
      max-width: 1000px;
      width: 100%;
      margin: 0 auto;
      background: #fffdf8;
      background-image: 
        linear-gradient(rgba(215, 190, 140, 0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(215, 190, 140, 0.06) 1px, transparent 1px);
      background-size: 35px 35px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      border: 2px solid #b89b5b;
      border-radius: 6px;
      position: relative;
      padding: 25px 30px 30px 30px;
      page-break-inside: avoid;
      break-inside: avoid;
    }

    /* BORDURE DÉCORATIVE INTÉRIEURE */
    .certificate::before {
      content: "";
      position: absolute;
      top: 10px; left: 10px; right: 10px; bottom: 10px;
      border: 2px double #d4af37;
      border-radius: 6px;
      pointer-events: none;
      opacity: 0.6;
    }

    /* EN-TÊTE */
    .republic-header {
      text-align: center;
      margin-bottom: 8px;
    }

    .flag-rdc {
      display: flex;
      width: 100%;
      height: 18px;
      margin-bottom: 8px;
      border-radius: 2px;
      overflow: hidden;
    }
    .flag-stripe { flex: 1; }
    .blue { background: #0073ce; }
    .yellow { background: #f7d417; }
    .red { background: #ce1126; }

    .republique {
      font-size: 16px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #2c3e50;
      font-weight: 700;
      margin: 2px 0;
    }
    .etat-civil {
      font-size: 18px;
      font-weight: 700;
      color: #8b6f3c;
      border-bottom: 1px solid #d4af37;
      display: inline-block;
      padding-bottom: 4px;
      margin-bottom: 12px;
      text-transform: uppercase;
      letter-spacing: 3px;
    }

    .main-title {
      font-size: 32px;
      font-weight: 800;
      color: #1e3a8a;
      text-transform: uppercase;
      letter-spacing: 3px;
      margin: 12px 0 6px;
      word-spacing: 6px;
    }

    .numero-acte {
      font-size: 15px;
      background: #f1efe7;
      display: inline-block;
      padding: 4px 20px;
      border-radius: 30px;
      color: #3e3a2e;
      font-weight: 600;
      border: 1px dashed #c9b27e;
      margin-bottom: 10px;
    }

    .intro-text {
      font-size: 16px;
      margin: 15px 0 12px;
      font-style: italic;
      text-align: center;
      color: #3d3a2e;
    }

    /* GRILLE ÉPOUX/ÉPOUSE — COMPACTE */
    .couple-grid {
      display: flex;
      gap: 20px;
      justify-content: center;
      margin: 8px 0 12px;
    }

    .spouse-card {
      flex: 1 1 260px;
      background: #fcfaf5;
      border: 1px solid #e3d6bf;
      border-radius: 14px;
      padding: 14px 16px 12px;
      border-top: 5px solid #b4945c;
    }
    .spouse-card.epoux { border-top-color: #2e5a8c; }
    .spouse-card.epouse { border-top-color: #a5506e; }

    .spouse-header {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 12px;
      font-size: 20px;
      font-weight: 700;
      color: #2d3e56;
      border-bottom: 1px solid #ddd2bd;
      padding-bottom: 6px;
    }

    .spouse-detail {
      display: flex;
      margin-bottom: 6px;
      font-size: 15px;
    }
    .label {
      font-weight: 700;
      min-width: 100px;
      color: #5f4e2e;
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.3px;
    }
    .value {
      font-weight: 500;
      color: #1f2a36;
    }

    /* INFO MARIAGE — COMPACTE */
    .wedding-info {
      background: #f4f0e7;
      padding: 12px 20px;
      border-radius: 10px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin: 12px 0 8px;
      border-left: 6px solid #b4945c;
    }
    .info-item {
      text-align: center;
      min-width: 140px;
    }
    .info-item .label {
      min-width: auto;
      display: block;
      margin-bottom: 3px;
      font-size: 13px;
    }
    .info-item .value {
      font-size: 17px;
      font-weight: 700;
      color: #1e3a5f;
    }
    .statut-badge {
      background: #1e3a8a;
      color: white;
      padding: 3px 14px;
      border-radius: 40px;
      font-weight: 600;
      font-size: 14px;
      display: inline-block;
    }

    /* TÉMOINS */
    .temoins-box {
      margin: 10px 0 6px;
      background: #f9f6ee;
      padding: 8px 16px;
      border-radius: 10px;
      font-size: 14px;
    }

    /* SIGNATURE — OPTIMISÉE */
    .signature-block {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      margin-top: 18px;
    }
    .left-place {
      font-size: 14px;
      color: #3e3a2e;
    }
    .right-signature {
      text-align: right;
    }
    .officier-line {
      border-top: 2px solid #1e2a36;
      width: 240px;
      margin-top: 25px;
      margin-bottom: 4px;
    }
    .officier-title {
      font-weight: 700;
      font-size: 15px;
      color: #2e3b4e;
      text-transform: uppercase;
    }

    /* QR CODE — POSITION RÉDUITE */
    .qr-area {
      position: absolute;
      bottom: 20px;
      right: 25px;
      background: white;
      padding: 6px 6px 3px 6px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.04);
      border: 1px solid #e2d3bb;
      text-align: center;
    }
    .qr-caption {
      font-size: 9px;
      margin-top: 2px;
      color: #7b6e54;
      letter-spacing: 0.5px;
    }

    /* MENTIONS LÉGALES */
    .legal-footer {
      margin-top: 8px;
      font-size: 10px;
      color: #6f6a5e;
      text-align: center;
      border-top: 1px dashed #cbb586;
      padding-top: 7px;
    }

    /* BOUTON IMPRESSION */
    .print-btn {
      position: fixed;
      top: 16px;
      right: 16px;
      background: #1e3a8a;
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 40px;
      font-size: 16px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.1);
      cursor: pointer;
      border: 1px solid #f1e3c0;
      display: flex;
      align-items: center;
      gap: 6px;
      z-index: 999;
    }
    .print-btn:hover {
      background: #112b66;
    }

    /* FILIGRANE */
    .watermark {
      position: absolute;
      bottom: 55px;
      left: 30px;
      opacity: 0.05;
      font-size: 60px;
      font-weight: bold;
      color: #a58e62;
      transform: rotate(-15deg);
      pointer-events: none;
    }

    /* RÈGLES D'IMPRESSION : FORCE UNE PAGE */
    @media print {
      html, body {
        height: 100%;
        margin: 0 !important;
        padding: 0 !important;
        background: white;
      }
      body {
        display: block;
        padding: 0.15in;
      }
      .certificate {
        box-shadow: none;
        border: 2px solid #b89b5b;
        background: white;
        padding: 0.2in 0.25in;
        max-width: 100%;
        page-break-after: avoid;
        page-break-inside: avoid;
      }
      .certificate::before {
        border: 2px double #b4945c;
      }
      .print-btn {
        display: none;
      }
      .qr-area {
        border: 1px solid #aaa;
      }
      /* force l'ajustement */
      * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }

    /* Pour les petits écrans, on garde le centrage */
    @media screen and (max-width: 700px) {
      body { padding: 8px; }
      .certificate { padding: 20px 18px; }
    }
  </style>
</head>
<body>
  <button class="print-btn" onclick="window.print()">
    <span style="font-size:20px;">🖨️</span> Imprimer (1 page)
  </button>

  <div class="certificate">
    <!-- Drapeau RDC -->
    <div class="flag-rdc">
      <div class="flag-stripe blue"></div>
      <div class="flag-stripe yellow"></div>
      <div class="flag-stripe blue"></div>
      <div class="flag-stripe yellow"></div>
      <div class="flag-stripe red"></div>
    </div>

    <div class="republic-header">
      <div class="republique">RÉPUBLIQUE DÉMOCRATIQUE DU CONGO</div>
      <div class="etat-civil">ÉTAT CIVIL · ACTE DE MARIAGE</div>
    </div>

    <div style="text-align: center;">
      <div class="main-title">CERTIFICAT DE MARIAGE</div>
      <div class="numero-acte">
        N° {{ $mariage->numero_officiel ?? 'MC/'.$mariage->id.'/'.date('Y') }}
      </div>
    </div>

    <div class="intro-text">
      ⚭ Nous, Officier de l’État Civil, certifions que le mariage a été célébré entre :
    </div>

    <!-- ÉPOUX & ÉPOUSE -->
    <div class="couple-grid">
      <div class="spouse-card epoux">
        <div class="spouse-header">
          <span>👨‍⚖️ ÉPOUX</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Nom</span>
          <span class="value">{{ $mariage->epoux->nom }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Prénom</span>
          <span class="value">{{ $mariage->epoux->prenom }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Né le</span>
          <span class="value">{{ $mariage->epoux->date_naissance }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">À</span>
          <span class="value">{{ $mariage->epoux->lieu_naissance ?? '—' }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Profession</span>
          <span class="value">{{ $mariage->epoux->profession ?? '—' }}</span>
        </div>
      </div>

      <div class="spouse-card epouse">
        <div class="spouse-header">
          <span>👰 ÉPOUSE</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Nom</span>
          <span class="value">{{ $mariage->epouse->nom }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Prénom</span>
          <span class="value">{{ $mariage->epouse->prenom }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Née le</span>
          <span class="value">{{ $mariage->epouse->date_naissance }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">À</span>
          <span class="value">{{ $mariage->epouse->lieu_naissance ?? '—' }}</span>
        </div>
        <div class="spouse-detail">
          <span class="label">Profession</span>
          <span class="value">{{ $mariage->epouse->profession ?? '—' }}</span>
        </div>
      </div>
    </div>

    <!-- INFORMATIONS CÉLÉBRATION -->
    <div class="wedding-info">
      <div class="info-item">
        <span class="label">📅 Date du mariage</span>
        <span class="value">{{ \Carbon\Carbon::parse($mariage->date_mariage)->translatedFormat('d F Y') }}</span>
      </div>
      <div class="info-item">
        <span class="label">📍 Lieu</span>
        <span class="value">{{ $mariage->lieu_mariage }}</span>
      </div>
      <div class="info-item">
        <span class="label">⚖️ Régime</span>
        <span class="value">{{ $mariage->regime->contrat->nom ?? 'Comm. réduite' }}</span>
      </div>
      <div class="info-item">
        <span class="label">📋 Statut</span>
        <span class="value">
          <span class="statut-badge">{{ $mariage->statut->nom ?? 'CÉLÉBRÉ' }}</span>
        </span>
      </div>
    </div>

    <!-- TÉMOINS (si présents) -->
    @if(isset($mariage->temoins) && count($mariage->temoins))
    <div class="temoins-box">
      <span style="font-weight: 700; color: #5f4e2e;">TÉMOINS :</span>
      @foreach($mariage->temoins as $temoin)
        <span style="margin-left: 16px;">{{ $temoin->nom }} {{ $temoin->prenom }}</span>
      @endforeach
    </div>
    @endif

    <!-- SIGNATURE -->
    <div class="signature-block">
      <div class="left-place">
        <div style="font-weight: 600;">Fait à {{ $mariage->entite->nom ?? 'Kinshasa' }}</div>
        <div>Le {{ now()->translatedFormat('d F Y') }}</div>
        <div style="margin-top: 6px; font-size: 12px;">En foi de quoi ce certificat est délivré.</div>
      </div>
      <div class="right-signature">
        <div class="officier-line"></div>
        <div class="officier-title">Officier de l’État Civil</div>
        <div style="font-size: 13px;">{{ $mariage->officier_nom ?? 'M. KABILA M.' }}</div>
        <div style="font-size: 11px; color: #3f3a2c;">(Signature & Sceau)</div>
      </div>
    </div>

    <!-- QR CODE (taille réduite pour tenir) -->
    <div class="qr-area">
      <img width="95" height="95" style="display:block; border-radius: 6px;" 
           src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('mariages.verify', $mariage)) }}&bgcolor=fffdf8&color=1e3a8a" 
           alt="QR vérification">
      <div class="qr-caption">Vérification en ligne</div>
    </div>

    <!-- MENTIONS LÉGALES -->
    <div class="legal-footer">
      République Démocratique du Congo — Acte authentique délivré conformément au Code de la Famille.<br>
      Document officiel. Toute falsification expose aux poursuites pénales.
    </div>

    <!-- FILIGRANE DISCRET -->
    <div class="watermark">⚜ RDC ⚜</div>
  </div>
</body>
</html>