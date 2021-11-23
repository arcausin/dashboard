<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
session_start();
if (!empty($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

$reqResetPassword = $conn_dashboard->prepare('SELECT resetPasswordToken FROM user WHERE resetPasswordToken = ?');
$reqResetPassword->execute(array($_GET['token']));

if (isset($_POST['submit'])) { // bouton submit appuyé
  if (empty($_POST['password'])) { // champ Mot de passe vide
    // veuillez remplir le champ Mot de passe
    header('Location: reset-password.php?password&token=' . $_GET['token']);
    exit();
  } elseif (empty($_POST['passwordConfirm'])) { // champ Confirmer le mot de passe vide
    // veuillez confirmer votre Mot de passe
    header('Location: reset-password.php?passwordConfirm&token' . $_GET['token']);
    exit();
  } elseif ($reqResetPassword->rowCount() == 0) {
    header('Location: reset-password.php');
    exit();
  } elseif ($_POST['password'] != $_POST['passwordConfirm']) { // champ Mot de passe et Confirmer le mot de passe différent
    // les Mots de passe ne correspondent pas
    header('Location: reset-password.php?passwordPasswordConfirm&token' . $_GET['token']);
    exit();
  }
  else { // toutes les données du formulaires sont correctes
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $req = $conn_dashboard->prepare('UPDATE user SET password = ?, resetPasswordToken = ? WHERE resetPasswordToken = ?');
    $req->execute(array($passwordHash, NULL, $_GET['token']));

    header('Location: login.php?passwordSwitch');
    exit();
  }
}
else { // bouton submit non appuyé
  // veuillez validez le formulaire d'inscription
  header('Location: forgot-password.php');
  exit();
}
?>
