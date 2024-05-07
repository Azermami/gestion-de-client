<?php
 session_start();

                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include "db_connexion.php";

                    $email = $_POST['email'];
                    $password = $_POST['pwd'];

                    $sql = "SELECT * FROM client WHERE `e-mail` = '$email' AND `mot_de_passe` = '$password'";
                    $result = $conn->query($sql);
                    $row=$result->fetch_assoc();
                    if ($result->num_rows > 0) {
						$_SESSION['nom']=$row['nom'];
						$_SESSION['prenom']=$row['prenom'];
						$_SESSION['telephone']=$row['telephone'];
				        $_SESSION['id_client']=$row['id_client'];
						$_SESSION['e-mail']=$row['e-mail'];
                        header("Location: index.php");
                      echo "<p>Authentification réussie !</p>";
                    } else {
                      echo '<p class="error-message">Échec de l\'authentification. Veuillez vérifier votre mail et votre mot de passe.</p>';

                    }

                    $conn->close();
                  }
                  ?>
<!DOCTYPE html>
<html lang="en">
<style>
  .error-message {
    color: red;
	font-weight: bold;
  }
</style>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
  <meta name="author" content="AdminKit">
  <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

  <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

  <title>Se connecter</title>

  <link href="css/app.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
  <main class="d-flex w-100">
    <div class="container d-flex flex-column">
      <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
              <h1 class="h2">Bienvenue</h1>
              <p class="lead">
                Connectez-vous à votre compte pour continuer
              </p>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="m-sm-3">
                 
                  <form method="post">
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input class="form-control form-control-lg" type="password" name="pwd" placeholder="Enter your password" />
                    </div>
                    <div>
                      <div class="form-check align-items-center">
                        <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
                        <label class="form-check-label text-small" for="customControlInline">Souviens-toi de moi</label>
                      </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <button type="submit" class="btn btn-lg btn-primary">Se connecter</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="text-center mb-3">
              je n'ai pas de compte? <a href="s'inscrire.html">S'inscrire</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="js/app.js"></script>

</body>

</html>
