
<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body, html {
        height: 100%;
    }

    .page-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 40px 20px;
    }

    .error-icon {
        font-size: 4rem;
        color: #dc3545;
    }

    .btn-home {
        font-size: 1.1rem;
        padding: 12px 25px;
        border-radius: 8px;
    }
</style>

<div class="page-wrapper">
    <div class="content-wrapper">
        <div>
            <div class="error-icon mb-4">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1 class="display-5 fw-bold mb-3">Ne pare rău, pagina nu a fost găsită</h1>
            <p class="lead text-muted mb-4">Se pare că adresa introdusă nu există sau a fost mutată.</p>
            <a href="/SmileTrack/index.php" class="btn btn-primary btn-home">
                <i class="fas fa-home me-2"></i> Înapoi la pagina principală
            </a>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</div>
