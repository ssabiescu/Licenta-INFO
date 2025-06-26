<?php include(__DIR__ . "/../includes/header.php"); ?>
<?php include(__DIR__ . "/../includes/navbar.php"); ?>

<style>
  .contact-card {
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }
  .emergency-toggle {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    color: #444;
    padding: 12px 18px;
    border-radius: 8px;
    text-align: center;
    font-size: 1rem;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
  }
  .emergency-toggle:hover {
    background: #e9ecef;
    color: #000;
  }
  .emergency-content {
    display: none;
    text-align: center;
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    color: #856404;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 2rem;
    font-size: 1.1rem;
  }
</style>

<div class="container my-5">
  <h1 class="section-title">Contact SmileTrack</h1>
  <p class="text-center text-muted mb-4 fs-5">Suntem aici pentru a-ți răspunde la orice întrebare și a te ajuta să îți programezi vizita.</p>
  <hr>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="p-4 bg-white contact-card h-100">
        <h4 class="mb-4 text-primary"><i class="bi bi-telephone me-2"></i>Informații de contact</h4>
        <p class="mb-3"><i class="bi bi-geo-alt-fill me-2 text-danger"></i> Aleea Studenților 3, Timișoara</p>
        <p class="mb-3"><i class="bi bi-telephone-fill me-2 text-success"></i> +40 724 840 942</p>
        <p class="mb-3"><i class="bi bi-envelope-fill me-2 text-primary"></i> contact@smiletrack.ro</p>
        <p class="mb-3"><i class="bi bi-globe2 me-2 text-secondary"></i> www.smiletrack.ro</p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="p-4 bg-white contact-card h-100">
        <h4 class="mb-4 text-primary"><i class="bi bi-clock me-2"></i>Programul clinicii</h4>
        <ul class="list-group list-group-flush fs-5">
          <li class="list-group-item d-flex justify-content-between"><span>Luni - Vineri</span><span>08:00 - 20:00</span></li>
          <li class="list-group-item d-flex justify-content-between"><span>Sâmbătă</span><span>09:00 - 14:00</span></li>
          <li class="list-group-item d-flex justify-content-between"><span>Duminică</span><span>Închis</span></li>
        </ul>
      </div>
    </div>
  </div>

  <hr>

  <div class="emergency-toggle" onclick="toggleUrgenta()">
    Ai o urgență stomatologică? Află cum ne poți contacta
  </div>
  <div class="emergency-content" id="urgentaBox">
    <strong>Pentru urgențe stomatologice, sunați la <a href="tel:0724840942" class="text-decoration-none text-dark fw-bold">0724 840 942</a> — disponibil NONSTOP.</strong>
  </div>

<br>

  <div class="mt-5">
    <h4 class="text-center mb-3 text-primary"><i class="bi bi-map me-2"></i>Localizare clinică</h4> <hr>
    <div class="ratio ratio-16x9 shadow rounded">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3310.954681400463!2d21.23897316892093!3d45.747739287438115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47455d88ba15a4e1%3A0xe67550e6c3a4b286!2sComplexul%20Studen%C8%9Besc%20UPT!5e0!3m2!1sen!2sro!4v1747674207120!5m2!1sen!2sro" 
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</div>

<script>
function toggleUrgenta() {
  const box = document.getElementById("urgentaBox");
  box.style.display = (box.style.display === "none" || box.style.display === "") ? "block" : "none";
}
</script>

<?php include(__DIR__ . "/../includes/footer.php"); ?>