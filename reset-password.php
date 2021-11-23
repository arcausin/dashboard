<?php
session_start();
require_once("include/database-connexion.php");
if (!empty($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

$reqResetPassword = $conn_dashboard->prepare('SELECT resetPasswordToken FROM user WHERE resetPasswordToken = ?');
$reqResetPassword->execute(array($_GET['token']));

if (empty($_GET['token'])) {
  header('Location: forgot-password.php');
  exit();
} elseif ($reqResetPassword->rowCount() == 0) {
  header('Location: forgot-password.php');
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

    <title>Réinitialisation de mot de passe - Tableau de bord</title>

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
                            <div class="col-lg-6 d-none d-lg-block bg-password-imag"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Réinitialisation de mot de passe</h1>
                                        <p class="mb-4">Veuillez entrer un nouveau mot de passe afin de réaccéder a votre compte.</p>
                                    </div>
                                    <form class="user" action="reset-password-processing.php?token=<?php echo $_GET['token'] ?>" method="post">
                                      <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe">
                                      </div>
                                      <div class="form-group">
                                        <input type="password" name="passwordConfirm" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Confirmer le mot de passe">
                                      </div>
                                      <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Mettre à jour votre mot de passe">
                                    </form>
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
