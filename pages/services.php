<?php include(__DIR__ . "/../includes/header.php"); ?>
<?php include(__DIR__ . "/../includes/navbar.php"); ?>

<style>
  .hero-section {
    background: url('../assets/images/background.jpg') center center / cover no-repeat;
    height: 300px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
  }

  .hero-overlay {
    background: rgba(0, 0, 0, 0.6);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }

  .hero-text {
    position: relative;
    z-index: 2;
    text-align: center;
  }

  .service-card {
    border: none;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: white;
  }

  .service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .bg-gradient-blue {
    background: linear-gradient(135deg, #007bff, #00c6ff);
  }

  .bg-gradient-green {
    background: linear-gradient(135deg, #28a745, #84d9a2);
  }

  .bg-gradient-orange {
    background: linear-gradient(135deg, #fd7e14, #ffb347);
  }

  .bg-gradient-purple {
    background: linear-gradient(135deg, #6f42c1, #b19cd9);
  }

  .bg-gradient-pink {
    background: linear-gradient(135deg, #e83e8c, #ff9a9e);
  }

  .bg-gradient-dark {
    background: linear-gradient(135deg, #343a40, #6c757d);
  }

  .bg-gradient-gold {
    background: linear-gradient(135deg, #FFD700, #FFA500);
  }

  .bg-gradient-cyan {
    background: linear-gradient(135deg, #00CED1, #40E0D0);
  }

  .bg-gradient-silver {
    background: linear-gradient(135deg, #C0C0C0, #E0E0E0);
  }
</style>

<div class="hero-section mb-5">
  <div class="hero-overlay"></div>
  <div class="hero-text">
    <h1 class="display-4">Serviciile noastre</h1>
    <p class="lead">Tehnologie avansată, tratamente personalizate și o echipă dedicată zâmbetului tău.</p>
  </div>
</div>

<div class="container mb-5">
  <div class="row g-4">

    <div class="col-md-4">
      <div class="card service-card bg-gradient-blue text-white h-100 p-4">
        <h4><i class="bi bi-person-lines-fill me-2"></i>Consultații & Diagnostic</h4>
        <p>Consult detaliat, diagnostic corect, plan personalizat de tratament. Radiografie panoramică, CBCT, planificare computerizată.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-green text-white h-100 p-4">
        <h4><i class="bi bi-brightness-high-fill me-2"></i>Estetică dentară</h4>
        <p>Albire profesională, fațete ceramice, bonding, remodelare gingivală. Zâmbet perfect adaptat fizionomiei tale.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-orange text-white h-100 p-4">
        <h4><i class="bi bi-diagram-3 me-2"></i>Ortodonție avansată</h4>
        <p>Aparate metalice, ceramice, safir, gutiere transparente (Invisalign). Corectăm alinierea cu rezultate stabile.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-purple text-white h-100 p-4">
        <h4><i class="bi bi-building me-2"></i>Protetică & Reabilitare</h4>
        <p>Coroane metalo-ceramice, zirconiu, punți dentare, proteze mobile sau pe implanturi. Reconstruim estetica și funcționalitatea.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-pink text-white h-100 p-4">
        <h4><i class="bi bi-shield-check me-2"></i>Igienizare & Profilaxie</h4>
        <p>Detartraj ultrasonic, airflow, periaj profesional, fluorizare. Îngrijire preventivă pentru sănătatea pe termen lung a dinților.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-dark text-white h-100 p-4">
        <h4><i class="bi bi-scissors me-2"></i>Chirurgie orală</h4>
        <p>Extracții dentare simple și complexe, molari de minte incluși, rezecții apicale, chistectomii. Intervenții minim-invazive.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-gold text-white h-100 p-4">
        <h4><i class="bi bi-pin-angle me-2"></i>Implantologie modernă</h4>
        <p>Implanturi dentare premium, adiții osoase, sinus lift, tehnologie PRF. Soluții sigure pentru înlocuirea dinților pierduți.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-cyan text-white h-100 p-4">
        <h4><i class="bi bi-emoji-smile me-2"></i>Pedodonție (copii)</h4>
        <p>Sigilări, tratamente carii, traumatologie dentară pediatrică, prevenție personalizată pentru cei mici într-un mediu relaxant.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card service-card bg-gradient-silver text-white h-100 p-4">
        <h4><i class="bi bi-heart-pulse-fill me-2"></i>Tratamente de urgență</h4>
        <p>Gestionăm rapid urgențele: dureri acute, abcese, traumatisme, fracturi dentare. Asistență medicală imediată, 365 zile/an.</p>
      </div>
    </div>

  </div>
  <hr>
  <div class="mt-5 text-center">
    <h4 class="text-primary">SmileTrack — un zâmbet bine construit înseamnă mai mult decât dinți sănătoși</h4>
    <p class="text-muted mx-auto" style="max-width: 900px;">
      Combinăm expertiza medicală, empatia față de pacient și cele mai moderne tehnologii pentru a-ți oferi nu doar tratamente eficiente, ci și confort psihologic, rezultate estetice excepționale și un plan personalizat adaptat perfect nevoilor tale.
    </p>
  </div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
