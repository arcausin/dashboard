<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['addFavoriteSubmit'])) {
  $req = $conn->prepare('UPDATE note SET favorite = 1 WHERE id = ?');
  $req->execute(array($_POST['favoriteId']));
  header('Location: /notes/');
  exit();
} elseif (isset($_POST['removeFavoriteSubmit'])) {
  $req = $conn->prepare('UPDATE note SET favorite = NULL WHERE id = ?');
  $req->execute(array($_POST['favoriteId']));
  header('Location: /notes/');
  exit();
}
else {
  header('Location: /notes/');
  exit();
}
?>
