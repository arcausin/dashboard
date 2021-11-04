<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/key-register.php");

if (isset($_POST['submit'])) { // bouton submit appuyé
  if (empty($_POST['firstName'])) { // champ Prénom vide
    header('Location: register.php?firstName');
    exit();
  } elseif (empty($_POST['lastName'])) { // champ Nom vide
    header('Location: register.php?lastName');
    exit();
  } elseif (empty($_POST['mailAdress'])) { // champ Adresse Mail vide
    // veuillez remplir le champ Adresse Mail
    header('Location: register.php?mailAdress');
    exit();
  } elseif ($_POST['keyRegister'] != $keyRegister) { // champ Clé d'Inscription invalide
    // La clé d'inscription est invalide
    header('Location: register.php?keyRegister');
    exit();
  } elseif (empty($_POST['password'])) { // champ Mot de passe vide
    // veuillez remplir le champ Mot de passe
    header('Location: register.php?password');
    exit();
  } elseif (empty($_POST['passwordConfirm'])) { // champ Confirmer le mot de passe vide
    // veuillez confirmer votre Mot de passe
    header('Location: register.php?passwordConfirm');
    exit();
  } elseif ($_POST['password'] != $_POST['passwordConfirm']) { // champ Mot de passe et Confirmer le mot de passe différent
    // les Mots de passe ne correspondent pas
    header('Location: register.php?passwordPasswordConfirm');
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
