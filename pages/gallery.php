<?php include(__DIR__ . "/../includes/header.php"); ?>
<?php include(__DIR__ . "/../includes/navbar.php"); ?>

<style>
  .gallery-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .gallery-img:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  }

  .gallery-title {
    font-weight: bold;
    text-align: center;
    margin-bottom: 40px;
  }
</style>

<div class="container mt-5 mb-5">
  <h1 class="section-title">Galerie SmileTrack</h1>

  <p class="text-center text-muted mb-4">Descoperă imagini din clinica noastră și rezultatele tratamentelor oferite.</p>
  <hr>
  <div class="row g-4">

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery1.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery2.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery3.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery4.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery5.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery6.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery7.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery8.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery9.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery10.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery11nou.jpg" alt="poza smiletrack" class="gallery-img">
    </div>

    <div class="col-md-4 col-sm-6">
      <img src="../assets/images/gallery12.jpg" alt="poza smiletrack" class="gallery-img">
    </div>
  </div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
