<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}

// Stergere programare
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sterge_id"])) {
    $id = $_POST["sterge_id"];
    $stmt = $conn->prepare("DELETE FROM programari WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Afisare programări
$rezultat = $conn->query("SELECT p.*, u.nume, u.prenume FROM programari p
                          LEFT JOIN utilizatori u ON p.id_pacient = u.id
                          ORDER BY data_programare DESC");
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    #calendarSidebar {
        width: 60vw !important;
        max-width: 100%;
    }
    #calendar {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
    }
</style>

<div class="page-container">
    <div class="content-wrap">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>📋 Toate programările</h2>
                <button class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#calendarSidebar">
                    📅 Vezi calendarul
                </button>
            </div>

            <!-- Sidebar Calendar -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="calendarSidebar" aria-labelledby="calendarSidebarLabel" style="width: 60vw; max-width: 100%;">
              <div class="offcanvas-header">
                <h5 id="calendarSidebarLabel">Calendar programări confirmate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Închide"></button>
              </div>
              <div class="offcanvas-body">
                <div id="calendar"></div>
              </div>
            </div>

            <!-- Modal calendar -->
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

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center shadow-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>Nr. crt.</th>
                            <th>Pacient</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Medic</th>
                            <th>Data</th>
                            <th>Ora</th>
                            <th>Status</th>
                            <th>Detalii</th>
                            <th>Acțiune</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nr_crt = 1;
                            while($row = $rezultat->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $nr_crt++ ?></td>
                            <td><?= htmlspecialchars($row["nume"] . " " . $row["prenume"]) ?></td>
                            <td><?= htmlspecialchars($row["email"] ?: '-') ?></td>
                            <td><?= htmlspecialchars($row["telefon"] ?: '-') ?></td>
                            <td><?= htmlspecialchars($row["medic"] ?: '-') ?></td>
                            <td><?= htmlspecialchars($row["data_programare"]) ?></td>
                            <td><?= htmlspecialchars($row["ora_programare"]) ?></td>
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
                                <form method="post" onsubmit="return confirm('Ești sigur că vrei să ștergi această programare?');">
                                    <input type="hidden" name="sterge_id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center">
                                        <i class="fas fa-trash me-1"></i> Șterge
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("../../includes/footer.php"); ?>
</div>
