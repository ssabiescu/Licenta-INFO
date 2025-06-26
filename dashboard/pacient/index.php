<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "pacient") {
    header("Location: ../../auth/login.php");
    exit();
}
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<style>
  body {
    background: url('/Smiletrack/assets/images/wpimg.jpg') no-repeat center center fixed;
    background-size: cover;
  }
  
  .dashboard-box {
    max-width: 800px;
    margin: 60px auto;
    padding: 40px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    text-align: center;
  }

  .dashboard-box h2 {
    font-weight: 700;
    margin-bottom: 20px;
  }

  .dashboard-box p {
    color: #666;
    margin-bottom: 30px;
  }

  .dashboard-actions .btn {
    margin: 10px;
    min-width: 180px;
    font-size: 1.1rem;
    padding: 12px 20px;
  }

  .dashboard-icon {
    font-size: 3rem;
    color: #0d6efd;
    margin-bottom: 15px;
  }
</style>

<div class="dashboard-box">
  <div class="dashboard-icon">
    <i class="bi bi-person-badge-fill"></i>
  </div>
  <h2>Bine ai venit, <?= htmlspecialchars($_SESSION["nume"]) ?> <?= htmlspecialchars($_SESSION["prenume"]) ?>!</h2>
  <p>Acesta este dashboard-ul tău de pacient. Alege una dintre opțiunile de mai jos:</p>

  <div class="dashboard-actions d-flex justify-content-center flex-wrap">
    <a href="contul_meu.php" class="btn btn-primary">
      <i class="bi bi-person-circle me-1"></i> Contul meu
    </a>
    <a href="programari.php" class="btn btn-outline-secondary">
      <i class="bi bi-calendar-check me-1"></i> Programările mele
    </a>
    <a href="/SmileTrack/auth/logout.php" class="btn btn-outline-danger">
      <i class="bi bi-box-arrow-right me-1"></i> Logout
    </a>
  </div>
</div>

<?php include("../../includes/footer.php"); ?>
