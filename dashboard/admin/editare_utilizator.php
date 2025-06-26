<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}

$mesaj = "";
$eroare = "";

if (!isset($_GET["id"])) {
    header("Location: utilizatori.php");
    exit();
}

$id = (int)$_GET["id"];
$stmt = $conn->prepare("SELECT * FROM utilizatori WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$rez = $stmt->get_result();

if ($rez->num_rows === 0) {
    $eroare = "Utilizatorul nu a fost găsit.";
} else {
    $user = $rez->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nume = htmlspecialchars(trim($_POST["nume"]));
    $prenume = htmlspecialchars(trim($_POST["prenume"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $telefon = htmlspecialchars(trim($_POST["telefon"]));
    $rol = $_POST["rol"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $eroare = "Email invalid.";
    } else {
        $stmt = $conn->prepare("UPDATE utilizatori SET nume=?, prenume=?, email=?, telefon=?, rol=? WHERE id=?");
        $stmt->bind_param("sssssi", $nume, $prenume, $email, $telefon, $rol, $id);
        if ($stmt->execute()) {
            $mesaj = "Cont actualizat cu succes.";

            $parola = $_POST["parola"] ?? '';
            $confirmare = $_POST["confirmare"] ?? '';

            if (!empty($parola) || !empty($confirmare)) {
                if ($parola !== $confirmare) {
                    $eroare = "Parolele nu coincid.";
                } else {
                    $hash = password_hash($parola, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE utilizatori SET parola = ? WHERE id = ?");
                    $stmt->bind_param("si", $hash, $id);
                    $stmt->execute();
                }
            }

            header("Refresh:2; url=utilizatori.php");
        } else {
            $eroare = "Eroare la actualizare.";
        }
    }
}
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-5 mb-5" style="max-width: 700px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <h3 class="mb-4 text-center"><i class="fas fa-user-edit me-2"></i>Editare cont utilizator</h3>

            <?php if ($mesaj): ?>
                <div class="alert alert-success"><?= $mesaj ?></div>
            <?php elseif ($eroare): ?>
                <div class="alert alert-danger"><?= $eroare ?></div>
            <?php endif; ?>

            <?php if (!empty($user)): ?>
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
                <div class="mb-3">
                    <label class="form-label">Telefon</label>
                    <input type="text" name="telefon" class="form-control" value="<?= htmlspecialchars($user['telefon']) ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Rol</label>
                    <select name="rol" class="form-select">
                        <option value="pacient" <?= $user['rol'] === 'pacient' ? 'selected' : '' ?>>Pacient</option>
                        <option value="medic" <?= $user['rol'] === 'medic' ? 'selected' : '' ?>>Medic</option>
                        <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-save me-2"></i>Salvează modificările
                </button>

                <hr class="my-4">

                <h5 class="mb-3"><i class="fas fa-key me-2"></i>Resetare parolă</h5>
                <p class="text-muted small mb-3">Lăsați câmpurile libere dacă nu doriți să resetați parola.</p>

                <div class="mb-3">
                    <label class="form-label">Parolă nouă</label>
                    <input type="password" name="parola" class="form-control">
                </div>
                <div class="mb-4">
                    <label class="form-label">Confirmare parolă</label>
                    <input type="password" name="confirmare" class="form-control">
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
