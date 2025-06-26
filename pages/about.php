<?php
session_start();
include(__DIR__ . "/../includes/header.php");
include(__DIR__ . "/../includes/navbar.php");
include(__DIR__ . "/../config/db.php");

// descrieri detaliate medici
$descrieri = [
    56 => "Dr. Dima Ioana — Specialist ortodont cu peste 10 ani de experiență. Abordare personalizată, tratamente moderne și rezultate impecabile. Expertiză în aparate invizibile și ortodonție digitală.",  
    57 => "Dr. Mihai Radu — Expert în estetică dentară, protetică și reconstrucții complexe. Atenție la detalii și pasiune pentru zâmbete naturale. Tehnici minim invazive și design personalizat pentru fiecare pacient.",
    60 => "Dr. Popescu Andrei — Chirurg cu pregătire avansată în implantologie, chirurgie orală și estetică gingivală. Profesionalism, calm și precizie în intervenții complexe.",
    62 => "Dr. Ionescu Maria — Medic pasionat de ortodonție modernă, cu o abordare empatică și eficientă. Utilizează cele mai noi tehnologii pentru tratamente confortabile și estetice.",
    63 => "Dr. Matei Elena — Specialist în restaurări dentare și estetică facială. Promovează tratamente minim invazive și pune accent pe comunicarea deschisă cu pacientul, pentru rezultate de durată și naturale."
];


// poze medici
$poze = [
    56 => "ioana.jpg",
    57 => "mihairadu.jpg",
    60 => "popescuandrei.jpg",
    62 => "ionescumaria.jpg",
    63 => "elena.jpg"
];

// adaugare recenzie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $id_pacient = $_SESSION['user_id'];
    $id_medic = intval($_POST['id_medic']);
    $comentariu = mysqli_real_escape_string($conn, $_POST['comentariu']);
    $rating = intval($_POST['rating']);

    $medic_query = mysqli_query($conn, "SELECT nume, prenume FROM utilizatori WHERE id = $id_medic");
    $medic_data = mysqli_fetch_assoc($medic_query);
    $nume_medic_complet = mysqli_real_escape_string($conn, $medic_data['nume'] . ' ' . $medic_data['prenume']);

    $check_sql = "SELECT * FROM programari WHERE id_pacient = $id_pacient AND medic = '$nume_medic_complet' AND status = 'confirmata'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $insert_sql = "INSERT INTO recenzii (id_pacient, id_medic, comentariu, rating, data)
                       VALUES ($id_pacient, $id_medic, '$comentariu', $rating, NOW())";
        mysqli_query($conn, $insert_sql);
        header("Location: about.php?success=1");
        exit();
    } else {
        echo '<div class="alert alert-danger text-center">Poți lăsa o recenzie doar după o programare confirmată la acest medic.</div>';
    }
}

$sql = "SELECT id, nume, prenume FROM utilizatori WHERE rol = 'medic'";
$result = mysqli_query($conn, $sql);
?>

<style>
  .medic-card {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    border-radius: 15px;
  }
  .medic-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }
  .medic-img {
    height: 300px;
    object-fit: cover;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
  }
  .rating-stars {
    color: #FFD700;
    font-size: 1.3rem;
  }
</style>

<div class="container my-5">
<?php if (isset($_GET['success'])): ?>
  <div class="alert alert-success text-center">Recenzia ta a fost trimisă cu succes!</div>
<?php endif; ?>

  <h1 class="section-title">Echipa SmileTrack</h1>
  <div class="text-center mb-3">
    <button onclick="toggleDescriere()" class="btn btn-warning">Afișează detalii despre clinica SmileTrack</button>
  </div>

  <div id="descriereClinica" class="highlight text-center mx-auto mb-4" style="max-width: 700px; display: none;">
    SmileTrack este o clinică modernă dedicată sănătății orale și zâmbetului fiecărui pacient. Oferim servicii profesionale, medici empatici și tehnologie de ultimă generație.
  </div>
  <hr>
  <div class="row g-5">

  <?php while ($medic = mysqli_fetch_assoc($result)): 
    $medic_id = $medic['id'];
    $nume_complet = $medic['nume'] . " " . $medic['prenume'];
    $nume_medic_sql_safe = mysqli_real_escape_string($conn, $nume_complet);

    $review_sql = "SELECT rating, comentariu FROM recenzii WHERE id_medic = $medic_id ORDER BY data DESC LIMIT 3";
    $review_result = mysqli_query($conn, $review_sql);
    $avg_sql = "SELECT AVG(rating) AS media FROM recenzii WHERE id_medic = $medic_id";
    $avg_result = mysqli_fetch_assoc(mysqli_query($conn, $avg_sql));
    $media = isset($avg_result['media']) && $avg_result['media'] !== null
    ? round($avg_result['media'], 1)
    : "0";
  ?>

    <div class="col-md-4">
      <div class="card shadow medic-card h-100">
        <img src="../assets/images/medici/<?= $poze[$medic_id] ?? 'placeholder-doctor.jpg' ?>" class="card-img-top medic-img" alt="Foto Medic">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-primary"><?= $nume_complet ?></h5>
          <p class="card-text"><?= $descrieri[$medic_id] ?? "Medic dedicat, parte din echipa SmileTrack." ?></p>

          <div class="mb-3">
            <span class="rating-stars">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <?= $i <= $media ? '★' : '☆' ?>
              <?php endfor; ?>
            </span>
            <small class="text-muted">(<?= $media ?>/5)</small>
          </div>

          <h6 class="mb-2">Recenzii recente:</h6>
          <div class="mb-3">
          <?php if (mysqli_num_rows($review_result) > 0): ?>
            <?php while ($review = mysqli_fetch_assoc($review_result)): ?>
              <p><em>"<?= $review['comentariu'] ?>"</em></p>
            <?php endwhile; ?>
          <?php else: ?>
              <p class="text-muted">Nicio recenzie momentan.</p>
          <?php endif; ?>
          </div>

          <?php if (isset($_SESSION['user_id']) && $_SESSION['rol'] == 'pacient'): ?>
            <?php
              $id_pacient = $_SESSION['user_id'];
              $check_sql = "SELECT * FROM programari WHERE id_pacient = $id_pacient AND medic = '$nume_medic_sql_safe' AND status = 'confirmata'";
              $check_result = mysqli_query($conn, $check_sql);
            ?>

            <?php if (mysqli_num_rows($check_result) > 0): ?>
              <form method="POST" class="mt-auto">
                <input type="hidden" name="id_medic" value="<?= $medic_id ?>">
                <div class="mb-2">
                  <textarea name="comentariu" class="form-control" placeholder="Scrie recenzia ta..." required></textarea>
                </div>
                <div class="mb-2">
                  <select name="rating" class="form-select">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                      <option value="<?= $i ?>"><?= $i ?> stele</option>
                    <?php endfor; ?>
                  </select>
                </div>
                <button type="submit" name="submit_review" class="btn btn-primary w-100">Trimite recenzie</button>
              </form>
            <?php else: ?>
              <p class="text-muted mt-auto">Poți lăsa recenzie doar după o programare confirmată.</p>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

  <?php endwhile; ?>

  </div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
