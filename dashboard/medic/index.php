<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "medic") {
    header("Location: ../../auth/login.php");
    exit();
}
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .medic-btn {
        font-size: 1.2rem;
        padding: 15px;
        border-radius: 12px;
    }
    body {
      background: url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center fixed;
      background-size: cover;
    }
</style>

<main class="flex-grow-1">
  <div class="container py-5" style="max-width: 600px;">
    <div class="text-center mb-4">
      <h2 class="fw-bold mb-3">👨‍⚕️ Bine ai venit, dr. <?= htmlspecialchars($_SESSION["nume"]) ?> <?= htmlspecialchars($_SESSION["prenume"]) ?>!</h2>
      <p class="text-muted">Acesta este dashboard-ul tău de medic. Alege una dintre acțiunile disponibile:</p>
    </div>

    <div class="d-grid gap-3">
      <a href="programari.php" class="btn btn-primary medic-btn shadow-sm">
        <i class="fas fa-calendar-check me-2"></i>Vizualizare programări
      </a>
      <a href="adauga_pacient.php" class="btn btn-success medic-btn shadow-sm">
        <i class="fas fa-user-plus me-2"></i>Adaugă pacient
      </a>
      <a href="pacienti.php" class="btn btn-secondary medic-btn shadow-sm">
        <i class="fas fa-users me-2"></i>Vizualizare pacienți
      </a>
      <a href="/SmileTrack/auth/logout.php" class="btn btn-outline-danger medic-btn shadow-sm">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
      </a>
    </div>
  </div>
</main>

<?php include("../../includes/footer.php"); ?>
