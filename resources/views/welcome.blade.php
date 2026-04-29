<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Optimisation Marital · Plateforme officielle RDC</title>
  <!-- Font Awesome 6 (gratuit) pour plus d'icônes élégantes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* ===== VARIABLES & RESET ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
      background: linear-gradient(145deg, #f4f7fb 0%, #eef2f6 100%);
      color: #1e293b;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ===== TYPOGRAPHIE & LIENS ===== */
    h1, h2, h3 {
      font-weight: 600;
      line-height: 1.2;
    }

    /* ===== HEADER MODERNE AVEC OVERLAY ===== */
    .hero {
      background: linear-gradient(135deg, #0a2b4e 0%, #1e4a7a 100%);
      color: white;
      padding: 4rem 2rem;
      text-align: center;
      position: relative;
      isolation: isolate;
      box-shadow: 0 15px 30px -10px rgba(0, 40, 80, 0.3);
    }

    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMzAgMTBhMjAgMjAgMCAwIDEgMjAgMjAgMjAgMjAgMCAwIDEtNDAgMCAyMCAyMCAwIDAgMSAyMC0yMHoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48cGF0aCBkPSJNMzAgMjBhMTAgMTAgMCAwIDEgMTAgMTAgMTAgMTAgMCAwIDEtMjAgMCAxMCAxMCAwIDAgMSAxMC0xMHoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=') repeat;
      opacity = 0.1;
      z-index: -1;
    }

    .hero h1 {
      font-size: 3.2rem;
      margin-bottom: 0.5rem;
      letter-spacing: -0.02em;
      animation: fadeInDown 0.8s ease;
    }

    .hero p {
      font-size: 1.3rem;
      opacity: 0.9;
      max-width: 700px;
      margin: 1rem auto 0;
      font-weight: 300;
      animation: fadeInUp 0.8s ease 0.1s both;
    }

    .hero i {
      margin-right: 0.4rem;
      color: #ffd966;
    }

    /* ===== MAIN AVEC CARTES ===== */
    main {
      max-width: 1300px;
      margin: 3rem auto;
      padding: 0 2rem;
      flex: 1;
    }

    .intro-card {
      background: white;
      border-radius: 2rem;
      padding: 2.5rem;
      margin-bottom: 3rem;
      box-shadow: 0 25px 45px -15px rgba(0, 40, 80, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(4px);
      transition: transform 0.3s ease;
    }

    .intro-card:hover {
      transform: translateY(-5px);
    }

    .intro-card h2 {
      color: #0f3b5e;
      font-size: 2.2rem;
      margin-bottom: 1.2rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      border-bottom: 3px solid #e6eef9;
      padding-bottom: 0.7rem;
    }

    .intro-card h2 i {
      color: #2c7da0;
      font-size: 2rem;
    }

    .intro-card p {
      font-size: 1.15rem;
      line-height: 1.7;
      color: #2c3e50;
      margin-bottom: 2rem;
    }

    /* Grille de fonctionnalités */
    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.8rem;
      margin: 2.5rem 0 1.5rem;
    }

    .feature-item {
      background: #f8fcff;
      border-radius: 1.8rem;
      padding: 1.8rem 1.5rem;
      text-align: left;
      border: 1px solid #d9e9fa;
      transition: all 0.25s;
      box-shadow: 0 6px 12px -8px rgba(0, 70, 120, 0.2);
    }

    .feature-item:hover {
      background: white;
      border-color: #2c7da0;
      box-shadow: 0 20px 25px -12px #1e4a7a40;
      transform: scale(1.02);
    }

    .feature-icon {
      background: #1e4a7a15;
      width: 50px;
      height: 50px;
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.2rem;
    }

    .feature-icon i {
      font-size: 1.8rem;
      color: #1e4a7a;
    }

    .feature-item h3 {
      font-size: 1.35rem;
      margin-bottom: 0.6rem;
      color: #0b3b5c;
    }

    .feature-item p {
      font-size: 0.95rem;
      color: #3a546d;
      margin: 0;
      line-height: 1.5;
    }

    /* bouton moderne */
    .btn-connect {
      display: inline-flex;
      align-items: center;
      gap: 0.8rem;
      background: linear-gradient(115deg, #136f9b, #1e4a7a);
      color: white;
      border: none;
      padding: 1rem 2.5rem;
      font-size: 1.3rem;
      font-weight: 600;
      border-radius: 60px;
      box-shadow: 0 15px 25px -10px #0a2b4e;
      transition: all 0.25s;
      text-decoration: none;
      margin: 1rem 0 0.5rem;
      border: 1px solid #ffffff30;
      backdrop-filter: blur(4px);
    }

    .btn-connect i {
      font-size: 1.4rem;
      transition: transform 0.2s;
    }

    .btn-connect:hover {
      background: linear-gradient(115deg, #1a7fb3, #235f93);
      box-shadow: 0 25px 30px -8px #0a2b4e;
      transform: translateY(-3px);
    }

    .btn-connect:hover i {
      transform: translateX(6px);
    }

    /* petite section de statistique fictive */
    .stats-mini {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      background: #ffffffc2;
      backdrop-filter: blur(8px);
      border-radius: 50px;
      padding: 1.5rem 2rem;
      margin: 2rem 0 0;
      border: 1px solid white;
    }

    .stat {
      text-align: center;
    }

    .stat-number {
      font-size: 1.8rem;
      font-weight: 700;
      color: #1e4a7a;
    }

    .stat-label {
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #4b6584;
    }

    /* ===== FOOTER ÉLÉGANT ===== */
    footer {
      background: #132e48;
      color: #bdd3e8;
      padding: 2rem 2rem;
      text-align: center;
      font-size: 1rem;
      border-top: 3px solid #2c7da0;
      margin-top: 2rem;
    }

    footer i {
      color: #ffb347;
      margin: 0 0.3rem;
    }

    footer a {
      color: #ffd966;
      text-decoration: none;
      font-weight: 500;
    }

    footer a:hover {
      text-decoration: underline;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 680px) {
      .hero h1 {
        font-size: 2.2rem;
      }
      .hero p {
        font-size: 1.1rem;
      }
      .intro-card h2 {
        font-size: 1.8rem;
      }
      .features-grid {
        grid-template-columns: 1fr;
      }
      .stats-mini {
        flex-direction: column;
        gap: 1.2rem;
        border-radius: 30px;
      }
      .btn-connect {
        font-size: 1.2rem;
        padding: 0.9rem 2rem;
      }
    }
  </style>
</head>
<body>

  <header class="hero">
    <h1><i class="fas fa-ring"></i> Optimisation Marital</h1>
    <p><i class="fas fa-map-marker-alt"></i> Plateforme officielle de gestion et suivi des mariages · RDC</p>
    <div style="margin-top: 2rem; font-size: 1.2rem;">
      <span style="background: #ffffff20; padding: 0.4rem 1.2rem; border-radius: 40px; backdrop-filter: blur(4px);">
        <i class="fas fa-check-circle"></i> Kinshasa · Lubumbashi · Goma · Mbuji-Mayi
      </span>
    </div>
  </header>

  <main>
    <div class="intro-card">
      <h2>
        <i class="fas fa-binoculars"></i> 
        Vision globale du mariage civil
      </h2>
      <p>
        <strong>Optimisation Marital</strong> centralise l’enregistrement, le suivi et les statistiques des mariages 
        pour chaque commune, territoire, ville et province de la RDC. Agents, administrateurs et IT 
        disposent d’un tableau de bord clair et d’outils de recherche puissants.
      </p>

      <!-- Grille des fonctionnalités améliorées -->
      <div class="features-grid">
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-pen-fancy"></i></div>
          <h3>Insertion & suivi</h3>
          <p>Ajoutez des mariages avec tous les détails : époux, témoins, parents, dates. Suivi des dossiers en temps réel.</p>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
          <h3>Statistiques dynamiques</h3>
          <p>Tableaux de bord par échelon (province, ville, commune) avec filtres par âge, type de contrat, régime.</p>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-search"></i></div>
          <h3>Recherche multicritère</h3>
          <p>Recherche avancée : noms, dates, contrats de mariage, numéro d’acte, ou même par témoin.</p>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-users-cog"></i></div>
          <h3>Hiérarchie & rôles</h3>
          <p>Gestion complète des profils : agent communal, administrateur provincial, support IT avec permissions fines.</p>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-file-signature"></i></div>
          <h3>Visualisation intégrale</h3>
          <p>Époux, parents, témoins — tout apparaît sur une fiche synthétique et imprimable.</p>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
          <h3>Données sécurisées</h3>
          <p>Hébergement RDC, conformité aux normes, connexion chiffrée et audit trail.</p>
        </div>
      </div>

      <!-- Statistiques fictives pour embellir -->
      <div class="stats-mini">
        <div class="stat">
          <span class="stat-number">+127</span>
          <span class="stat-label">communes actives</span>
        </div>
        <div class="stat">
          <span class="stat-number">9.2k</span>
          <span class="stat-label">mariages enregistrés</span>
        </div>
        <div class="stat">
          <span class="stat-number">24</span>
          <span class="stat-label">provinces</span>
        </div>
        <div class="stat">
          <span class="stat-number">98%</span>
          <span class="stat-label">satisfaction</span>
        </div>
      </div>

      <!-- Bouton de connexion avec icône -->
      <div style="text-align: center;">
        <a href="/login" class="btn-connect">
          <span>Accéder à la plateforme</span>
          <i class="fas fa-arrow-right"></i>
        </a>
        <p style="margin-top: 0.7rem; color: #467a9e; font-size: 0.9rem;">
          <i class="fas fa-lock"></i> Connexion sécurisée réservée aux agents habilités
        </p>
      </div>
    </div>

    <!-- petite section additionnelle : actualités / valeurs (optionnel) -->
    <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; justify-content: center; margin-top: 2rem;">
      <div style="background: #1e4a7a0c; border-radius: 40px; padding: 0.8rem 1.8rem;">
        <i class="fas fa-calendar-alt" style="color: #1e4a7a;"></i> 
        <span style="font-weight: 500;">Mise à jour: mars 2026</span>
      </div>
      <div style="background: #1e4a7a0c; border-radius: 40px; padding: 0.8rem 1.8rem;">
        <i class="fas fa-heart" style="color: #c44569;"></i> 
        <span>Service public digital</span>
      </div>
    </div>
  </main>

  <footer>
    <i class="fas fa-copyright"></i> 2026 Optimisation Marital — Tous droits réservés <br>
    <span style="font-size: 0.95rem;">Fait à Kinshasa <i class="fas fa-map-pin"></i> |  v2.0 · interface modernisée</span>
    <div style="margin-top: 1rem;">
      <a href="#"><i class="fab fa-twitter"></i></a> 
      <a href="#" style="margin: 0 0.6rem;"><i class="fab fa-linkedin"></i></a> 
      <a href="#"><i class="fas fa-envelope"></i></a>
    </div>
  </footer>

</body>
</html>