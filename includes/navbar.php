<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['rol'] ?? 'vizitator';
$nume = $_SESSION['nume'] ?? '';

$link_dashboard = "#";
if ($rol === 'pacient') {
    $link_dashboard = "/SmileTrack/dashboard/pacient/index.php";
} elseif ($rol === 'medic') {
    $link_dashboard = "/SmileTrack/dashboard/medic/index.php";
} elseif ($rol === 'admin') {
    $link_dashboard = "/SmileTrack/dashboard/admin/index.php";
}
?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="/SmileTrack/pages/home.php">SmileTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-2">
                <li class="nav-item"><a class="nav-link" href="/SmileTrack/pages/home.php">Acasă</a></li>
                <li class="nav-item"><a class="nav-link" href="/SmileTrack/pages/about.php">Despre noi</a></li>
                <li class="nav-item"><a class="nav-link" href="/SmileTrack/pages/prices.php">Prețuri</a></li>
                <li class="nav-item"><a class="nav-link" href="/SmileTrack/pages/services.php">Servicii</a></li>
                <li class="nav-item"><a class="nav-link" href="/SmileTrack/pages/gallery.php">Galerie</a></li>
                <li class="nav-item"><a class="nav-link" href="/SmileTrack/pages/contact.php">Contact</a></li>

                <?php if (isset($_SESSION["user_id"])): ?>
                    <?php if ($rol === 'pacient'): ?>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/pacient/programari.php">Programări</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/pacient/contul_meu.php">Contul meu</a></li>
                    <?php elseif ($rol === 'medic'): ?>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/medic/programari.php">Programări</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/medic/adauga_pacient.php">Adaugă pacient</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/medic/pacienti.php">Pacienți</a></li>
                    <?php elseif ($rol === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/admin/programari.php">Programări</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/admin/utilizatori.php">Conturi</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SmileTrack/dashboard/admin/adauga_medic.php">Adaugă medic</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link text-danger" href="/SmileTrack/auth/logout.php">Logout</a></li>
                    <li class="nav-item ms-2">
                        <a href="<?= $link_dashboard ?>" class="badge bg-primary text-decoration-none px-3 py-2"><?= ucfirst($rol) ?>: <?= htmlspecialchars($nume) ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary btn-sm px-3" href="/SmileTrack/auth/login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
