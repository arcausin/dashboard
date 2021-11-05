<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

$reqDeleteNote = $conn_dashboard->prepare('SELECT id, idUser FROM note WHERE id = ? AND idUser = ?');
$reqDeleteNote->execute(array($_POST['favoriteId'], $user['id']));

if ($reqDeleteNote->rowCount() == 0) {
  header('Location: /notes/');
  exit();
}
else {
  if (isset($_POST['addFavoriteSubmit'])) {
    $req = $conn_dashboard->prepare('UPDATE note SET favorite = 1 WHERE id = ?');
    $req->execute(array($_POST['favoriteId']));
    header('Location: /notes/');
    exit();
  } elseif (isset($_POST['removeFavoriteSubmit'])) {
    $req = $conn_dashboard->prepare('UPDATE note SET favorite = NULL WHERE id = ?');
    $req->execute(array($_POST['favoriteId']));
    header('Location: /notes/');
    exit();
  }
  else {
    header('Location: /notes/');
    exit();
  }
}
?>
