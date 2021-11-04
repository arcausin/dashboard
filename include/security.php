<?php
session_start();
if (empty($_SESSION['id'])) {
  header('Location: /login.php');
  exit();
}
$req = $conn_dashboard->prepare('SELECT id, firstName, lastName, mailAdress, creationDate FROM user WHERE id = ?');
$req->execute(array($_SESSION['id']));
$user = $req->fetch();
?>
