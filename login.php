<?php
session_start();
require_once("include/database-connexion.php");
if (!empty($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Connexion - Tableau de bord</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                      <?php if (isset($_GET['mailAdress'])): ?>
                                          <div class="alert alert-danger alert-dismissible fade show">
                                              <strong>Erreur !</strong> Veuillez entrer votre adresse mail
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          </div>

                                      <?php elseif(isset($_GET['password'])): ?>
                                          <div class="alert alert-danger alert-dismissible fade show">
                                              <strong>Erreur !</strong> Veuillez entrer votre mot de passe
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          </div>

                                        <?php elseif(isset($_GET['invalid'])): ?>
                                            <div class="alert alert-danger alert-dismissible fade show">
                                                <strong>Erreur !</strong> L'adresse mail ou le mot de passe est invalide
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                        <?php endif; ?>
                                        <h1 class="h4 text-gray-900 mb-4">Connexion</h1>
                                    </div>
                                    <form class="user" action="login-processing.php" method="post">
                                        <div class="form-group">
                                            <input type="email" name="mailAdress" class="form-control form-control-user"
                                                id="exampleMailAdress" aria-describedby="emailHelp"
                                                placeholder="Adresse mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="examplePassword" placeholder="Mot de passe">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Créer un compte !</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
