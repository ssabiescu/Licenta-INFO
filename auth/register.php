<?php
session_start();
require_once("../config/db.php");

$eroare = "";
$succes = "";
$showRedirect = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = htmlspecialchars(trim($_POST["nume"]));
    $prenume = htmlspecialchars(trim($_POST["prenume"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $telefon = htmlspecialchars(trim($_POST["telefon"]));
    $parola = $_POST["parola"];
    $confirmare = $_POST["confirmare"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $eroare = "Email-ul nu este valid.";
    } elseif (!preg_match("/^[0-9]{10}$/", $telefon)) {
        $eroare = "Telefonul trebuie să conțină exact 10 cifre.";
    } elseif ($parola !== $confirmare) {
        $eroare = "Parolele nu coincid.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM utilizatori WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $eroare = "Email-ul este deja folosit.";
        } else {
            $hashParola = password_hash($parola, PASSWORD_DEFAULT);
            $rol = "pacient";

            $stmt = $conn->prepare("INSERT INTO utilizatori (nume, prenume, email, telefon, parola, rol) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nume, $prenume, $email, $telefon, $hashParola, $rol);

            if ($stmt->execute()) {
                $succes = "Cont creat cu succes!";
                $showRedirect = true;
            } else {
                $eroare = "Eroare la crearea contului.";
            }
        }
    }
}
?>

<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<style>
  .register-wrapper {
    display: flex;
    min-height: 100vh;
    background: linear-gradient(to right, rgba(255,255,255,0) 48%, rgba(255,255,255,0.5) 52%), url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center fixed;
    background-size: cover;
  }

  .register-bg {
    background: url('../assets/images/login-bg.jpg') center center / cover no-repeat;
    flex: 1;
    display: none;
    position: relative;
  }

  .register-form {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 30px;
    z-index: 1;
  }

  .register-box {
    background: #ffffff;
    border-radius: 15px;
    padding: 40px;
    max-width: 650px;
    width: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  @media (min-width: 992px) {
    .register-bg {
      display: block;
    }
  }
</style>


<div class="register-wrapper">
  <div class="register-bg"></div>
  <div class="register-form">
    <div class="register-box">
      <h2 class="mb-4 text-center text-success">Creează cont nou</h2>

      <?php if ($eroare): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($eroare) ?></div>
      <?php elseif ($succes): ?>
        <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
        <?php if ($showRedirect): ?>
          <div class="alert alert-info mt-3 text-center" role="alert">
            <strong>Cont creat cu succes!</strong> Vei fi redirecționat în <span id="countdown" class="fw-bold text-primary">3</span> secunde...
          </div>
          <script>
            let counter = 3;
            const countdownEl = document.getElementById("countdown");
            const interval = setInterval(() => {
              counter--;
              if (counter <= 0) {
                clearInterval(interval);
                window.location.href = "login.php";
              } else {
                countdownEl.textContent = counter;
              }
            }, 1000);
          </script>
        <?php endif; ?>
      <?php endif; ?>

      <form method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Nume</label>
            <input type="text" name="nume" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Prenume</label>
            <input type="text" name="prenume" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Telefon</label>
            <input type="text" name="telefon" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Parolă</label>
            <input type="password" name="parola" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Confirmă parola</label>
            <input type="password" name="confirmare" class="form-control" required>
          </div>
        </div>
        <div class="d-grid mt-3">
          <button type="submit" class="btn btn-success btn-lg">Creează cont</button>
        </div>
        <p class="mt-3 text-center">
          Ai deja un cont? <a href="login.php" class="link-primary">Autentifică-te aici</a>.
        </p>
      </form>
    </div>
  </div>
</div>

<?php include("../includes/footer.php"); ?>
