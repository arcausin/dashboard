<?php require_once("include/database-connexion.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription - Tableau de bord</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <?php if (isset($_GET['prenom'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Veuillez entrer votre prénom
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>

                                <?php elseif(isset($_GET['nom'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Veuillez entrer votre nom
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>

                                <?php elseif(isset($_GET['mailAdress'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Veuillez entrer votre adresse mail
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>

                                <?php elseif(isset($_GET['mailAdressKnown'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Cette adresse mail est déjà utilisée
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>

                                <?php elseif(isset($_GET['keyRegister'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> La clé d'inscription est invalide
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>

                                <?php elseif(isset($_GET['password'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Veuillez entrer votre mot de passe
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>

                                <?php elseif(isset($_GET['passwordConfirm'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Veuillez confirmer votre mot de passe
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                <?php elseif(isset($_GET['passwordPasswordConfirm'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Erreur !</strong> Les mots de passe ne correspondent pas
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                <?php endif; ?>
                                <h1 class="h4 text-gray-900 mb-4">Créer un compte</h1>
                            </div>
                            <form class="user" action="register-processing.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="firstName" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Prénom">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastName" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" name="mailAdress" class="form-control form-control-user" id="exampleMailAdress" placeholder="Adresse mail">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="keyRegister" class="form-control form-control-user" id="examplekeyRegister" placeholder="Clé d'inscription">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Mot de passe">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="passwordConfirm" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Confirmer le mot de passe">
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Créer un compte">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Connexion !</a>
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
