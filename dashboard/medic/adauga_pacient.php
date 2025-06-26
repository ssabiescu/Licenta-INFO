<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "medic") {
    header("Location: ../../auth/login.php");
    exit();
}

$eroare = $succes = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = trim($_POST["nume"]);
    $prenume = trim($_POST["prenume"]);
    $email = trim($_POST["email"]);
    $telefon = trim($_POST["telefon"]);
    $parola = $_POST["parola"];
    $confirmare = $_POST["confirmare"];

    if ($parola !== $confirmare) {
        $eroare = "Parolele nu coincid.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM utilizatori WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $eroare = "Email-ul există deja.";
        } else {
            $hashParola = password_hash($parola, PASSWORD_DEFAULT);
            $rol = "pacient";

            $stmt = $conn->prepare("INSERT INTO utilizatori (nume, prenume, email, telefon, parola, rol) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nume, $prenume, $email, $telefon, $hashParola, $rol);
            if ($stmt->execute()) {
                $succes = "Pacientul a fost adăugat cu succes!";
            } else {
                $eroare = "Eroare la adăugare.";
            }
        }
    }
}
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<style>
    body, html {
        height: 100%;
    }
    .page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .content-wrap {
        flex: 1;
    }
</style>

<div class="page-container">
    <div class="content-wrap">
        <div class="container py-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold">➕ Adaugă pacient nou</h2>
                <p class="text-muted">Completează datele pacientului pentru a-l adăuga în sistem.</p>
            </div>

            <?php if ($eroare): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($eroare) ?></div>
            <?php elseif ($succes): ?>
                <div class="alert alert-success text-center"><?= htmlspecialchars($succes) ?></div>
            <?php endif; ?>

            <form method="post" class="shadow p-4 bg-light rounded">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nume</label>
                        <input type="text" name="nume" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prenume</label>
                        <input type="text" name="prenume" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="telefon" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Parolă</label>
                        <input type="password" name="parola" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirmă parola</label>
                        <input type="password" name="confirmare" class="form-control" required>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        👤 Adaugă pacient
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include("../../includes/footer.php"); ?>
</div>