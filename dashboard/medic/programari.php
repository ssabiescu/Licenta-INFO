<?php
session_start();
require_once("../../config/db.php");
require_once("../../includes/mailgun_confirmare.php"); // include functia trimiteEmailConfirmare()


if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "medic") {
    header("Location: ../../auth/login.php");
    exit();

}

$id_medic = $_SESSION["nume"] . ' ' . $_SESSION["prenume"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["adauga_programare"])) {
    $nume = htmlspecialchars($_POST["nume"]);
    $prenume = htmlspecialchars($_POST["prenume"]);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $email = htmlspecialchars($_POST["email"]);
    $data = htmlspecialchars($_POST["data_programare"]);
    $ora = htmlspecialchars($_POST["ora_programare"]);
    $detalii = htmlspecialchars($_POST["detalii"]);
    $medic = $_SESSION["nume"];

    $stmt = $conn->prepare("INSERT INTO programari (nume, prenume, telefon, email, medic, data_programare, ora_programare, detalii, status)

                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'in asteptare')");

    $stmt->bind_param("ssssssss", $nume, $prenume, $telefon, $email, $medic, $data, $ora, $detalii);


    if ($stmt->execute()) {
        header("Location: programari.php?succes=1");
        exit();
    } else {
        header("Location: programari.php?eroare=1");
        exit();
    }
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmare_id"])) {
        $id = (int)$_POST["confirmare_id"];
        $stmt = $conn->prepare("UPDATE programari SET status = 'confirmata' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt2 = $conn->prepare("SELECT nume, prenume, email, medic, data_programare, ora_programare FROM programari WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $rez = $stmt2->get_result();
        $row = $rez->fetch_assoc();

        if ($row) {
            $nume_pacient = $row["prenume"] . " " . $row["nume"];
            $email = $row["email"];
            $medic = $row["medic"];
            $data = date("d.m.Y", strtotime($row["data_programare"]));
            $ora = substr($row["ora_programare"], 0, 5);

            trimiteEmailConfirmare($nume_pacient, $email, $medic, $data, $ora);
        }
        header("Location: programari.php?email=1");
        exit();
    }

    if (isset($_POST["anulare_id"])) {
        $id = (int)$_POST["anulare_id"];
        $stmt = $conn->prepare("UPDATE programari SET status = 'anulata' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

$rezultat = $conn->prepare("SELECT * FROM programari WHERE medic = ? ORDER BY data_programare DESC");
$rezultat->bind_param("s", $id_medic);
$rezultat->execute();
$rez = $rezultat->get_result();
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
  #calendar {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
  }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📋 Programări</h2>
        <button class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#calendarSidebar">
            📅 Vezi calendarul
        </button>
    </div>

    <!-- Sidebar cu Calendar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="calendarSidebar" aria-labelledby="calendarSidebarLabel" style="width: 60vw; max-width: 100%;">
      <div class="offcanvas-header">
        <h5 id="calendarSidebarLabel">Calendar programări confirmate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Închide"></button>
      </div>
      <div class="offcanvas-body">
        <div id="calendar"></div>
      </div>
    </div>

    <!-- Modal pentru detalii -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Detalii programare</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Închide"></button>
          </div>
          <div class="modal-body">
            <p><strong>Nume pacient + medic:</strong> <span id="modal-title"></span></p>
            <p><strong>Email:</strong> <span id="modal-email"></span></p>
            <p><strong>Telefon:</strong> <span id="modal-telefon"></span></p>
            <p><strong>Detalii:</strong> <span id="modal-detalii"></span></p>
          </div>
        </div>
      </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ro',
                events: '../../api/incarca_programari.php',
                eventClick: function(info) {
                    const ext = info.event.extendedProps;
                    document.getElementById("modal-title").textContent = info.event.title;
                    document.getElementById("modal-email").textContent = ext.email;
                    document.getElementById("modal-telefon").textContent = ext.telefon;
                    document.getElementById("modal-detalii").textContent = ext.detalii;
                    var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
                    myModal.show();
                }
            });

            calendar.render();
        });
    </script>

    <div class="card shadow-sm p-4 mb-5">
        <h4 class="mb-4">Programări primite</h4>
        <?php if (isset($_GET["succes"])): ?>
            <div class="alert alert-success">Programarea a fost adăugată cu succes.</div>
        <?php elseif (isset($_GET["eroare"])): ?>
            <div class="alert alert-danger">Eroare la adăugarea programării.</div>
        <?php elseif (isset($_GET["email"])): ?>
            <div class="alert alert-success">Email de confirmare trimis pacientului cu succes.</div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nr.</th>
                        <th>Pacient</th>
                        <th>Data</th>
                        <th>Ora</th>
                        <th>Medic</th>
                        <th>Detalii</th>
                        <th>Status</th>
                        <th>Acțiune</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $numar_crt = 1;
                        while($row = $rez->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?= $numar_crt++ ?></td>
                        <td><?= htmlspecialchars($row["nume"] . " " . $row["prenume"]) ?></td>
                        <td><?= htmlspecialchars($row["data_programare"]) ?></td>
                        <td><?= htmlspecialchars($row["ora_programare"]) ?></td>
                        <td><?= htmlspecialchars($row["medic"]) ?></td>
                        <td><?= nl2br(htmlspecialchars($row["detalii"] ?: '-')) ?></td>
                        <td>
                            <?php
                                switch ($row["status"]) {
                                    case "confirmata": echo "<span class='badge bg-success'>Confirmată</span>"; break;
                                    case "anulata": echo "<span class='badge bg-danger'>Anulată</span>"; break;
                                    default: echo "<span class='badge bg-warning text-dark'>În așteptare</span>"; break;
                                }
                            ?>
                        </td>
                        <td>
                            <form method="post" class="d-flex flex-column gap-2">
                                <input type="hidden" name="confirmare_id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-success">Confirmă</button>
                            </form>
                            <form method="post" onsubmit="return confirm('Ești sigur că vrei să anulezi această programare?');">
                                <input type="hidden" name="anulare_id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Anulează</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm p-4 bg-light">
        <h4 class="mb-4">Adaugă o programare nouă</h4>
        <form method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nume" class="form-control" placeholder="Nume" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="prenume" class="form-control" placeholder="Prenume" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="telefon" class="form-control" placeholder="Telefon" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-4">
                    <input type="date" name="data_programare" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <input type="time" name="ora_programare" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="detalii" class="form-control" placeholder="Detalii">
                </div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" name="adauga_programare" class="btn btn-primary btn-lg">Adaugă programare</button>
            </div>
        </form>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
