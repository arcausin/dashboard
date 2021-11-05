<?php
session_start();
if (empty($_SESSION['id'])) {
  header('Location: /login.php');
  exit();
}
$reqUser = $conn_dashboard->prepare('SELECT id, firstName, lastName, mailAdress, creationDate FROM user WHERE id = ?');
$reqUser->execute(array($_SESSION['id']));
$user = $reqUser->fetch();
$reqUser->closeCursor();
?>
