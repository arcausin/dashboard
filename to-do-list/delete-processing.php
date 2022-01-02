<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['deleteSubmit'])) {
  $reqDeleteNote = $conn_dashboard->prepare('SELECT idUser FROM to_do_list WHERE id = ? AND idUser = ?');
  $reqDeleteNote->execute(array($_POST['deleteId'], $user['id']));
  $deleteNote = $reqDeleteNote->fetch();
  $reqDeleteNote->closeCursor();

  if ($reqDeleteNote->rowCount() == 0) {
    header('Location: /to-do-list/');
    exit();
  }
  else {
    $req = $conn_dashboard->prepare('DELETE FROM to_do_list WHERE id = ?');
    $req->execute(array($_POST['deleteId']));

    header('Location: /to-do-list/');
    exit();
  }
}
else {
  header('Location: /to-do-list/');
  exit();
}
?>
