<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['deleteSubmit'])) {
  $req = $conn_dashboard->prepare('DELETE FROM note WHERE id = ?');
  $req->execute(array($_POST['deleteId']));
  header('Location: /notes/');
  exit();
}
else {
  header('Location: /notes/');
  exit();
}
?>
