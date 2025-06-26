<?php
session_start();
require_once("../config/db.php");

$eroare = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST["email"]));
    $parola = $_POST["parola"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $eroare = "Email-ul introdus nu este valid.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM utilizatori WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $rez = $stmt->get_result();

        if ($rez->num_rows === 1) {
            $user = $rez->fetch_assoc();
            if (password_verify($parola, $user["parola"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["rol"] = $user["rol"];
                $_SESSION["nume"] = $user["nume"];
                $_SESSION["prenume"] = $user["prenume"];
                session_write_close();
                header("Location: ../dashboard/" . $user["rol"] . "/index.php");
                exit();
            } else {
                $eroare = "Parolă incorectă.";
            }
        } else {
            $eroare = "Cont inexistent.";
        }
    }
}
?>

<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<style>
  .login-wrapper {
    display: flex;
    min-height: 100vh;
    background: linear-gradient(to right, rgba(255,255,255,0) 48%, rgba(255,255,255,0.5) 52%), url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center fixed;
    background-size: cover;
  }

  .login-bg {
    flex: 1;
    background: url('../assets/images/login-bg.jpg') center center / cover no-repeat;
    position: relative;
  }

  body {
      background: url('/SmileTrack/assets/images/wpimg.jpg') no-repeat center center fixed;
      background-size: cover;
    }

  .login-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 30px;
    z-index: 1;
  }

  .login-box {
    background: #ffffff;
    border-radius: 15px;
    padding: 40px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  }

  .form-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
  }

  .form-group {
    position: relative;
  }

  .form-control {
    padding-left: 40px;
  }

  @media (min-width: 992px) {
    .login-bg {
      display: block;
    }
  }
</style>

<div class="login-wrapper">
  <div class="login-bg"></div>
  <div class="login-container">
    <div class="login-box">
      <h2 class="section-title">Autentificare</h2>

      <?php if ($eroare): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($eroare) ?></div>
      <?php endif; ?>

      <form method="post" action="">
        <div class="form-group mb-3">
          <i class="bi bi-envelope-fill form-icon"></i>
          <input type="email" name="email" class="form-control" placeholder="Adresă email" required>
        </div>
        <div class="form-group mb-4">
          <i class="bi bi-lock-fill form-icon"></i>
          <input type="password" name="parola" class="form-control" placeholder="Parolă" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-lg">Login</button>
        </div>
      </form>

      <p class="text-center mt-3">
        Nu ai cont? <a href="register.php">Creează cont nou</a>
      </p>
    </div>
  </div>
</div>

<?php include("../includes/footer.php"); ?>
