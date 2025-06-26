<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "medic") {
    header("Location: ../../auth/login.php");
    exit();
}

// Stergere pacient
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sterge_id"])) {
    $id = $_POST["sterge_id"];
    $stmt = $conn->prepare("DELETE FROM utilizatori WHERE id = ? AND rol = 'pacient'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Afisare pacienti
$rezultat = $conn->query("SELECT * FROM utilizatori WHERE rol = 'pacient' ORDER BY data_inregistrare DESC");
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<main class="flex-grow-1">
  <div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Lista pacienților</h2>
    <hr>
    <?php if ($rezultat->num_rows === 0): ?>
      <div class="alert alert-info text-center">Nu există pacienți înregistrați.</div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center shadow-sm">
          <thead class="table-primary">
            <tr>
              <th>Nr. crt.</th>
              <th>Nume complet</th>
              <th>Email</th>
              <th>Telefon</th>
              <th>Data înregistrare</th>
              <th>Acțiune</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $numar_crt = 1;
            while($pacient = $rezultat->fetch_assoc()): 
            ?>
            <tr>
              <td><?= $numar_crt++ ?></td>
              <td><?= htmlspecialchars($pacient["nume"] . " " . $pacient["prenume"]) ?></td>
              <td><?= htmlspecialchars($pacient["email"]) ?></td>
              <td><?= htmlspecialchars($pacient["telefon"]) ?></td>
              <td><?= $pacient["data_inregistrare"] ?></td>
              <td>
                <form method="post" class="d-inline" onsubmit="return confirm('Ești sigur că vrei să ștergi acest pacient?');">
                  <input type="hidden" name="sterge_id" value="<?= $pacient['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash-fill me-1"></i> Șterge
                  </button>
                </form>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php include("../../includes/footer.php"); ?>
