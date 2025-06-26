<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "pacient") {
    header("Location: ../../auth/login.php");
    exit();
}

$id = $_SESSION["user_id"];

// stergere cont daca s-a dat submit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sterge_cont"])) {
    // sterge programarile
    $stmt1 = $conn->prepare("DELETE FROM programari WHERE id_pacient = ?");
    $stmt1->bind_param("i", $id);
    $stmt1->execute();

    // sterge recenziile
    $stmt2 = $conn->prepare("DELETE FROM recenzii WHERE id_pacient = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();

    // sterge contul
    $stmt3 = $conn->prepare("DELETE FROM utilizatori WHERE id = ?");
    $stmt3->bind_param("i", $id);
    $stmt3->execute();

    // logout si redirect
    session_destroy();
    header("Location: ../../index.php?deleted=1");
    exit();
}

// obtine datele userului
$sql = "SELECT nume, prenume, email, telefon FROM utilizatori WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$rez = $stmt->get_result();
$user = $rez->fetch_assoc();
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<style>
  body {
    background: url('/Smiletrack/assets/images/wpimg.jpg') no-repeat center center fixed;
    background-size: cover;
  }
  
  .account-card {
    max-width: 700px;
    margin: 60px auto;
    padding: 40px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    text-align: center;
  }

  .account-card h2 {
    margin-bottom: 30px;
    font-weight: 700;
  }

  .account-avatar {
    width: 100px;
    height: 100px;
    background: #0d6efd;
    color: white;
    border-radius: 50%;
    font-size: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 0 0 6px rgba(13,110,253,0.2);
  }

  .info-block {
    margin: 20px 0;
    text-align: left;
  }

  .info-block i {
    color: #0d6efd;
    margin-right: 10px;
    font-size: 1.2rem;
  }

  .info-block strong {
    display: inline-block;
    width: 90px;
    color: #333;
  }

  .btn-edit {
    margin-top: 30px;
    font-size: 1.1rem;
    padding: 10px 30px;
  }

  .btn-delete {
    margin-top: 20px;
    font-size: 1rem;
    padding: 10px 20px;
  }
</style>

<div class="account-card">
  <div class="account-avatar">
    <i class="bi bi-person-fill"></i>
  </div>

  <h2>Contul meu</h2>

  <div class="info-block">
    <i class="bi bi-person-circle"></i><strong>Nume:</strong> <?= htmlspecialchars($user["nume"] . " " . $user["prenume"]) ?>
  </div>
  <div class="info-block">
    <i class="bi bi-envelope-fill"></i><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?>
  </div>
  <div class="info-block">
    <i class="bi bi-telephone-fill"></i><strong>Telefon:</strong> <?= htmlspecialchars($user["telefon"]) ?>
  </div>

  <a href="editare_cont.php" class="btn btn-warning btn-edit">
    <i class="bi bi-pencil-square me-1"></i> Editează datele contului
  </a>

  <form method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi contul? Această acțiune este ireversibilă!');">
    <button type="submit" name="sterge_cont" class="btn btn-danger btn-delete">
      <i class="bi bi-trash3-fill me-1"></i> Șterge contul
    </button>
  </form>
</div>

<?php include("../../includes/footer.php"); ?>
