<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");

$reqResetPassword = $conn_dashboard->prepare('SELECT mailAdress FROM user WHERE mailAdress = ?');
$reqResetPassword->execute(array($_POST['mailAdress']));

if (isset($_POST['submit'])) { // bouton submit appuyé
  if (empty($_POST['mailAdress'])) { // champ Adresse Mail vide
    // veuillez remplir le champ Adresse Mail
    header('Location: register.php?mailAdress');
    exit();
  } elseif ($reqResetPassword->rowCount() != 0) {
    header('Location: register.php?mailAdressUnknown');
    exit();
  }
  else { // toutes les données du formulaires sont correctes
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $req = $conn_dashboard->prepare('INSERT INTO user (firstName, lastName, mailAdress, password, creationDate) VALUES (:firstName, :lastName, :mailAdress, :password, now())');
    $req->execute(array(
      'firstName' => $_POST['firstName'],
      'lastName' => $_POST['lastName'],
      'mailAdress' => $_POST['mailAdress'],
      'password' => $passwordHash
    ));
    header('Location: login.php');
    exit();
  }
}
else { // bouton submit non appuyé
  // veuillez validez le formulaire d'inscription
  header('Location: register.php');
  exit();
}
?>
