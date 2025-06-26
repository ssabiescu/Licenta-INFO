<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "pacient") {
    header("Location: ../../auth/login.php");
    exit();
}

$succes = $eroare = "";

// Anulare programare
if (isset($_GET['cancel']) && $_GET['cancel'] === "1" && isset($_GET['id'])) {
    $appointment_id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE programari SET status = 'anulata' WHERE id = ? AND id_pacient = ?");
    $stmt->bind_param("ii", $appointment_id, $_SESSION["user_id"]);
    if ($stmt->execute()) {
        header("Location: programari.php?succes=anulare");
        exit();
    } else {
        $eroare = "Eroare la anularea programării.";
    }
}

// Feedback din URL
if (isset($_GET["succes"])) {
    if ($_GET["succes"] == "1") {
        $succes = "Programarea a fost trimisă și este în așteptare.";
    } elseif ($_GET["succes"] == "anulare") {
        $succes = "Programarea a fost anulată cu succes.";
    }
}

// preluare datele pacientului pentru autocomplete
$id_pacient = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM utilizatori WHERE id = ?");
$stmt->bind_param("i", $id_pacient);
$stmt->execute();
$rez = $stmt->get_result();
$user = $rez->fetch_assoc();

// preluam medicii pentru dropdown
$medici = $conn->query("SELECT nume, prenume FROM utilizatori WHERE rol = 'medic'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = htmlspecialchars(trim($_POST["nume"]));
    $prenume = htmlspecialchars(trim($_POST["prenume"]));
    $telefon = htmlspecialchars(trim($_POST["telefon"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $medic = htmlspecialchars(trim($_POST["medic"]));
    $data_programare = $_POST["data_programare"];
    $ora_programare = $_POST["ora_programare"];
    $detalii = htmlspecialchars(trim($_POST["detalii"]));

    $stmt = $conn->prepare("INSERT INTO programari (id_pacient, nume, prenume, telefon, email, medic, data_programare, ora_programare, detalii)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $id_pacient, $nume, $prenume, $telefon, $email, $medic, $data_programare, $ora_programare, $detalii);
    if ($stmt->execute()) {
        $succes = "Programarea a fost trimisă și este în așteptare.";
    } else {
        $eroare = "Eroare la trimiterea programării.";
    }
}

// afisare programarile pacientului
$rezultat = $conn->query("SELECT * FROM programari WHERE id_pacient = $id_pacient ORDER BY data_programare DESC");
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">📅 Programările mele</h2>

    <?php if ($succes): ?>
        <div class="alert alert-success shadow-sm"><?= htmlspecialchars($succes) ?></div>
    <?php elseif ($eroare): ?>
        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($eroare) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-5">
        <h4 class="mb-4">📝 Creează o programare nouă</h4>
        <form method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nume" class="form-control" value="<?= htmlspecialchars($user['nume']) ?>" required placeholder="Nume">
                </div>
                <div class="col-md-6">
                    <input type="text" name="prenume" class="form-control" value="<?= htmlspecialchars($user['prenume']) ?>" required placeholder="Prenume">
                </div>
                <div class="col-md-6">
                    <input type="text" name="telefon" class="form-control" value="<?= htmlspecialchars($user['telefon']) ?>" required placeholder="Telefon">
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required placeholder="Email">
                </div>
                <div class="col-md-6">
                    <select name="medic" class="form-control" required>
                        <option value="">Alege un medic</option>
                        <?php while ($medic = $medici->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($medic['nume'] . ' ' . $medic['prenume']) ?>">
                                <?= htmlspecialchars($medic['nume'] . ' ' . $medic['prenume']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="data_programare" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="time" name="ora_programare" class="form-control" required>
                </div>
                <div class="col-12">
                    <textarea name="detalii" class="form-control" rows="3" placeholder="Detalii (opțional)"></textarea>
                </div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">📨 Trimite programare</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm p-4">
        <h4 class="mb-4">📖 Istoric programări</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nr.</th>
                        <th>Data</th>
                        <th>Ora</th>
                        <th>Medic</th>
                        <th>Status</th>
                        <th>Detalii</th>
                        <th>Acțiune</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $numar_crt = 1;
                        while($row = $rezultat->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $numar_crt++ ?></td>
                        <td><?= htmlspecialchars($row["data_programare"]) ?></td>
                        <td><?= htmlspecialchars($row["ora_programare"]) ?></td>
                        <td><?= htmlspecialchars($row["medic"]) ?></td>
                        <td>
                            <?php
                                switch ($row["status"]) {
                                    case "confirmata": echo "<span class='badge bg-success'>Confirmată</span>"; break;
                                    case "anulata": echo "<span class='badge bg-danger'>Anulată</span>"; break;
                                    default: echo "<span class='badge bg-warning text-dark'>În așteptare</span>"; break;
                                }
                            ?>
                        </td>
                        <td style="word-break: break-word; white-space: pre-wrap;">
                            <?= nl2br(htmlspecialchars($row["detalii"] ?: '-')) ?>
                        </td>
                        <td>
                            <?php if ($row["status"] !== "anulata"): ?>
                                <a href="?cancel=1&id=<?= htmlspecialchars($row['id']) ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Sigur doriți să anulați această programare?')">
                                    Anulează
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
