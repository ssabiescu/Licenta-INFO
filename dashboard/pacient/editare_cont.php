<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "pacient") {
    header("Location: ../../auth/login.php");
    exit();
}

$mesaj = "";
$eroare = "";
$id = $_SESSION["user_id"];

$stmt = $conn->prepare("SELECT * FROM utilizatori WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$rez = $stmt->get_result();
$user = $rez->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nume = htmlspecialchars(trim($_POST["nume"]));
    $prenume = htmlspecialchars(trim($_POST["prenume"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $telefon = htmlspecialchars(trim($_POST["telefon"]));
    $parola = $_POST["parola"] ?? '';
    $confirmare = $_POST["confirmare"] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $eroare = "Email-ul nu este valid.";
    } elseif (!preg_match("/^[0-9]{10}$/", $telefon)) {
        $eroare = "Telefonul trebuie să conțină exact 10 cifre.";
    } elseif (!empty($parola) && $parola !== $confirmare) {
        $eroare = "Parolele nu coincid.";
    } else {
        $stmt = $conn->prepare("UPDATE utilizatori SET nume=?, prenume=?, email=?, telefon=? WHERE id=?");
        $stmt->bind_param("ssssi", $nume, $prenume, $email, $telefon, $id);
        $stmt->execute();

        if (!empty($parola)) {
            $hash = password_hash($parola, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE utilizatori SET parola=? WHERE id=?");
            $stmt->bind_param("si", $hash, $id);
            $stmt->execute();
        }

        $mesaj = "Datele au fost actualizate cu succes!";
        $_SESSION["nume"] = $nume;
    }
}
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<style>
  body {
    background: url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center fixed;
    background-size: cover;
  }

  .card {
    background-color: rgba(255, 255, 255, 0.95);
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-5 mb-5" style="max-width: 700px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <h3 class="mb-4 text-center"><i class="fas fa-user-edit me-2"></i>Editează contul meu</h3>

            <?php if ($mesaj): ?>
                <div class="alert alert-success"><?= $mesaj ?></div>
            <?php elseif ($eroare): ?>
                <div class="alert alert-danger"><?= $eroare ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nume</label>
                    <input type="text" name="nume" class="form-control" value="<?= htmlspecialchars($user['nume']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prenume</label>
                    <input type="text" name="prenume" class="form-control" value="<?= htmlspecialchars($user['prenume']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Telefon</label>
                    <input type="text" name="telefon" class="form-control" value="<?= htmlspecialchars($user['telefon']) ?>" required>
                </div>

                <hr class="my-4">

                <h5 class="mb-3"><i class="fas fa-key me-2"></i>Resetare parolă (opțional)</h5>
                <p class="text-muted small mb-3">Completează doar dacă vrei să schimbi parola.</p>

                <div class="mb-3">
                    <label class="form-label">Parolă nouă</label>
                    <input type="password" name="parola" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="form-label">Confirmare parolă</label>
                    <input type="password" name="confirmare" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-save me-2"></i>Salvează modificările
                </button>
            </form>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
