<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}
?>

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/navbar.php"); ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body, html {
        height: 100%;
    }

    body {
      background: url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .content-wrap {
        flex: 1;
    }

    .admin-btn {
        font-size: 1.2rem;
        padding: 15px;
        border-radius: 12px;
    }
</style>

<div class="page-container">
    <div class="content-wrap">
        <div class="container mt-5 mb-5" style="max-width: 600px;">
            <div class="text-center mb-4">
                <h2 class="mb-3">👋 Salut, administrator <span class="text-primary"><?= htmlspecialchars($_SESSION["nume"]) ?></span>!</h2>
                <p class="lead">Ai acces complet la gestionarea aplicației <strong>SmileTrack</strong>.</p>
            </div>

            <div class="d-grid gap-3">
                <a href="programari.php" class="btn btn-primary admin-btn shadow-sm">
                    <i class="fas fa-calendar-check me-2"></i>Programări
                </a>
                <a href="utilizatori.php" class="btn btn-secondary admin-btn shadow-sm">
                    <i class="fas fa-users me-2"></i>Conturi utilizatori
                </a>
                <a href="adauga_medic.php" class="btn btn-success admin-btn shadow-sm">
                    <i class="fas fa-user-md me-2"></i>Adaugă medic
                </a>
                <a href="/SmileTrack/auth/logout.php" class="btn btn-outline-danger admin-btn shadow-sm">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
    </div>

    <?php include("../../includes/footer.php"); ?>
</div>
