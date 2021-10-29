<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
session_start();
if (!empty($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

if (isset($_POST['submit'])) { // bouton submit appuyé
  if (empty($_POST['mailAdress'])) { // champ Adresse Mail vide
    // veuillez remplir le champ Adresse Mail
    header('Location: login.php');
    exit();
  } elseif (empty($_POST['password'])) { // champ Mot de passe vide
    // veuillez remplir le champ Mot de passe
    header('Location: login.php');
    exit();
  }
  else { // toutes les données du formulaires sont remplis
    $req = $conn->prepare('SELECT * FROM user WHERE mailAdress = ?');
    $req->execute(array($_POST['mailAdress']));
    $user = $req->fetch();

    if (password_verify($_POST['password'], $user['password'])) { // connexion valide
      // bienvenue !
      $_SESSION['id'] = $user['id'];
      header('Location: index.php');
      exit();
    }
    else { // connexion invalide
      // retour a la page connexion.php
      header('Location: login.php');
      exit();
    }
  }
}
else { // bouton submit non appuyé
  // veuillez validez le formulaire de connexion
  header('Location: login.php');
  exit();
}
?>
