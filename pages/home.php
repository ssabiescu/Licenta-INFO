<?php include(__DIR__ . "/../includes/header.php"); ?>
<?php include(__DIR__ . "/../includes/navbar.php"); ?>

<style>
  .hero {
    background: url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center;
    background-size: cover;
    min-height: 550px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color:rgb(31, 81, 245);
  }

  .hero-content p.lead {
    font-size: 1.2rem;    
    font-weight: 550;       
    color:rgb(62, 79, 95);          
   
  }

  .icon-box {
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .icon-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  }

  .testimonial-box {
    padding: 30px;
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  }
</style>

<main class="flex-grow-1">

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <h1 class="display-3 fw-bold mb-3">Bine ai venit la SmileTrack</h1>
    <p class="lead mb-4">Grijă, tehnologie și estetică, perfect echilibrate pentru zâmbetul tău.</p>
    <a href="services.php" class="btn btn-primary btn-lg me-3">Vezi serviciile</a>
    <a href="../auth/login.php" class="btn btn-warning btn-lg">Autentificare</a>
  </div>
</section>

<!-- CE NE DEFINESTE -->
<div class="container py-5 text-center">
  <h2 class="text-primary mb-4 fw-bold">SmileTrack înseamnă mai mult decât stomatologie</h2>
  <div class="row g-4">
    <hr>
    <div class="col-md-4">
      <div class="p-4 icon-box bg-light shadow-sm h-100">
        <i class="bi bi-person-heart display-5 text-danger"></i>
        <h5 class="mt-3">Relație umană reală</h5>
        <p>Pacientul este partenerul nostru. Ascultăm, explicăm și creăm planuri personalizate.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="p-4 icon-box bg-light shadow-sm h-100">
        <i class="bi bi-cpu-fill display-5 text-info"></i>
        <h5 class="mt-3">Tehnologie avansată</h5>
        <p>Radiologie 3D, scanner intraoral, implanturi computerizate. Precizie și siguranță.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="p-4 icon-box bg-light shadow-sm h-100">
        <i class="bi bi-star-fill display-5 text-warning"></i>
        <h5 class="mt-3">Rezultate premium</h5>
        <p>Estetică impecabilă, confort sporit și rezultate stabile pentru fiecare pacient.</p>
      </div>
    </div>
  </div>
</div>

<!-- SERVICII -->
<div class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="mb-4 text-success fw-bold">Servicii complete pentru toată familia</h2>
    <p class="mb-4 fs-5">Consultații, ortodonție, chirurgie, implanturi, estetică dentară și profilaxie — toate sub același acoperiș SmileTrack.</p>
    <a href="services.php" class="btn btn-success btn-lg">Vezi toate serviciile</a>
  </div>
</div>

<!-- TESTIMONIALE -->
<div class="py-5" style="background: linear-gradient(to bottom, #f8f9fa, #ffffff);">
  <div class="container text-center">
    <h2 class="text-primary mb-5 fw-bold">Ce spun pacienții noștri</h2>
    <hr>
    <div class="row g-4 justify-content-center">

      <div class="col-md-4">
        <div class="testimonial-box h-100">
          <p class="fst-italic mb-4">"Cea mai bună experiență dentară avută vreodată. Totul profesionist, fără durere, rezultate excelente."</p>
          <h6 class="text-secondary">— Andreea M.</h6>
        </div>
      </div>

      <div class="col-md-4">
        <div class="testimonial-box h-100">
          <p class="fst-italic mb-4">"Mi-am pus implanturi la SmileTrack. Totul a decurs impecabil, fără complicații, rapid și sigur."</p>
          <h6 class="text-secondary">— Cristian P.</h6>
        </div>
      </div>

      <div class="col-md-4">
        <div class="testimonial-box h-100">
          <p class="fst-italic mb-4">"Copiii mei vin cu drag aici. Atmosferă relaxantă, echipă amabilă și tratamente blânde."</p>
          <h6 class="text-secondary">— Maria S.</h6>
        </div>
      </div>

    </div>
  </div>
</div>

</main>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
