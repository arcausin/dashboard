<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['deleteSubmit'])) {
  $reqDeleteNote = $conn_dashboard->prepare('SELECT id, idUser, illustration FROM note WHERE id = ? AND idUser = ?');
  $reqDeleteNote->execute(array($_POST['deleteId'], $user['id']));
  $deleteNote = $reqDeleteNote->fetch();
  $reqDeleteNote->closeCursor();

  if ($reqDeleteNote->rowCount() == 0) {
    header('Location: /notes/');
    exit();
  }
  else {
    $link = $_SERVER['DOCUMENT_ROOT']."/img/notes/".$deleteNote['illustration'];
    unlink($link);

    $req = $conn_dashboard->prepare('DELETE FROM note WHERE id = ?');
    $req->execute(array($_POST['deleteId']));

    header('Location: /notes/');
    exit();
  }
}
else {
  header('Location: /notes/');
  exit();
}
?>
