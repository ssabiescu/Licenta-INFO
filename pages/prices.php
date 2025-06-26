<?php include(__DIR__ . "/../includes/header.php"); ?>
<?php include(__DIR__ . "/../includes/navbar.php"); ?>

<style>
  .card-hover {
    transition: transform 0.4s ease, box-shadow 0.4s ease, max-height 0.5s ease;
    overflow: hidden;
    max-height: 120px;
  }
  .card-hover.expanded {
    max-height: 700px;
  }
  .card-title {
    cursor: pointer;
    user-select: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .card-title i.bi-chevron-down {
    transition: transform 0.3s ease;
  }
  .card-title.expanded i.bi-chevron-down {
    transform: rotate(180deg);
  }
</style>

<main class="flex-grow-1">
  <div class="container py-5">
    <h1 class="section-title">Lista de prețuri SmileTrack</h1>
    <p class="text-center text-muted mb-5">Apasă pe o categorie pentru a vedea detaliile serviciilor.</p>
  <hr>
    <div class="row g-4">

      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-primary">
              <span><i class="bi bi-search me-2"></i>Consultații</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Consultație inițială <span>100 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Consultație de control <span>50 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Consultație urgență <span>150 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Radiografie panoramică <span>80 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Plan tratament personalizat <span>200 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-success">
              <span><i class="bi bi-droplet-half me-2"></i>Igienizare</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Detartraj + periaj + airflow <span>250 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Fluorizare profesională <span>100 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Periaj profesional simplu <span>80 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Profilaxie completă <span>300 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Igienizare cu laser <span>400 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-warning">
              <span><i class="bi bi-star-fill me-2"></i>Estetică dentară</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Albire profesională <span>800 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Fațetă ceramică <span>1500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Fațetă compozit <span>800 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Remodelare gingivală <span>500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Bonding estetic <span>300 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-danger">
              <span><i class="bi bi-bandaid-fill me-2"></i>Tratamente</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Plombă compozit simplă <span>250 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Refacere plombă veche <span>200 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Tratament canal monoradicular <span>350 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Tratament canal pluriradicular <span>500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Reconstrucție coronară <span>400 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-secondary">
              <span><i class="bi bi-hospital me-2"></i>Protetică</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Coroană metalo-ceramică <span>900 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Coroană zirconiu <span>1300 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Punte dentară 3 elemente <span>2400 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Proteza totală acrilică <span>2500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Inlay / Onlay ceramic <span>900 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-info">
              <span><i class="bi bi-braces me-2"></i>Ortodonție</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Aparat metalic <span>2500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Aparat ceramic <span>3300 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Aparat safir <span>4000 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Gutiere transparente <span>4500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Control lunar aparat <span>150 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-danger">
              <span><i class="bi bi-scissors me-2"></i>Chirurgie</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Extracție simplă <span>200 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Extracție molar minte <span>500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Rezecție apicală <span>700 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Chistectomie <span>900 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Incizie abces + drenaj <span>300 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-success">
              <span><i class="bi bi-pin-angle-fill me-2"></i>Implantologie</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Implant dentar clasic <span>3500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Implant zigomatic <span>6000 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Adiție osoasă simplă <span>1500 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Sinus lift intern <span>2000 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Membrană PRF <span>400 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 col-lg-4">
        <div class="card card-hover shadow-sm h-100" onclick="toggleCard(this)">
          <div class="card-body">
            <h5 class="card-title text-primary">
              <span><i class="bi bi-emoji-smile-fill me-2"></i>Pedodonție</span>
              <i class="bi bi-chevron-down"></i>
            </h5>
            <ul class="list-unstyled mt-3">
    <li class='d-flex justify-content-between py-1 border-bottom'>Sigilare dinți <span>100 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Tratament carii copii <span>150 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Extracție dinte temporar <span>120 RON</span></li>
<li class='d-flex justify-content-between py-1 border-bottom'>Tratament traumatism dentar <span>300 RON</span></li>

            </ul>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</main>

<?php include(__DIR__ . "/../includes/footer.php"); ?>