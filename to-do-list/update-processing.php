<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (!empty($_GET['updateId'])) {
  $reqUpdateNote = $conn_dashboard->prepare('SELECT id, idUser, step FROM to_do_list WHERE id = ? AND idUser = ?');
  $reqUpdateNote->execute(array($_GET['updateId'], $user['id']));
  $updateNote = $reqUpdateNote->fetch();
  $reqUpdateNote->closeCursor();

  if ($reqUpdateNote->rowCount() == 0) {
    header('Location: /to-do-list/');
    exit();
  }
  else {
    if ($updateNote['step'] == 1) {
      $req = $conn_dashboard->prepare('UPDATE to_do_list SET step = 2 WHERE id = ?');
      $req->execute(array($_GET['updateId']));
      header('Location: /to-do-list/');
      exit();
    }
    elseif ($updateNote['step'] == 2) {
      $req = $conn_dashboard->prepare('UPDATE to_do_list SET step = 3 WHERE id = ?');
      $req->execute(array($_GET['updateId']));
      header('Location: /to-do-list/');
      exit();
    }
    elseif ($updateNote['step'] == 3) {
      $req = $conn_dashboard->prepare('UPDATE to_do_list SET step = 1 WHERE id = ?');
      $req->execute(array($_GET['updateId']));
      header('Location: /to-do-list/');
      exit();
    }
    else {
      header('Location: /to-do-list/');
      exit();
    }
  }
}
else {
  header('Location: /to-do-list/');
  exit();
}
?>
