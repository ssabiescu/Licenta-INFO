<?php
session_start();
require_once("../../config/db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}

// Stergere cont
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sterge_id"])) {
    $id = (int) $_POST["sterge_id"];
    if ($id !== (int)$_SESSION["user_id"]) {
        $stmt = $conn->prepare("DELETE FROM utilizatori WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

$rezultat = $conn->query("SELECT * FROM utilizatori ORDER BY data_inregistrare DESC");
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
        <div class="container mt-5">
            <h2 class="mb-4">👥 Toți utilizatorii</h2>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center shadow-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>Nr. crt.</th>
                            <th>Nume</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Rol</th>
                            <th>Acțiune</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $nr_crt = 1;
                        while($user = $rezultat->fetch_assoc()): 
                    ?>
                        <tr>
                            <td><?= $nr_crt++ ?></td>
                            <td><?= htmlspecialchars($user["nume"] . " " . $user["prenume"]) ?></td>
                            <td><?= htmlspecialchars($user["email"]) ?></td>
                            <td><?= htmlspecialchars($user["telefon"]) ?></td>
                            <td>
                                <span class="badge bg-<?= $user["rol"] === "admin" ? "dark" : ($user["rol"] === "medic" ? "primary" : "secondary") ?>">
                                    <?= htmlspecialchars($user["rol"]) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user["id"] != $_SESSION["user_id"]): ?>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="editare_utilizator.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">
                                            ✏️ Editează
                                        </a>
                                        <form method="post" onsubmit="return confirm('Ești sigur că vrei să ștergi acest cont?');">
                                            <input type="hidden" name="sterge_id" value="<?= (int)$user['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                🗑️ Șterge
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <em class="text-muted">(propriu)</em>
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
</div>