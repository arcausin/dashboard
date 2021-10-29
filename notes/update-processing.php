<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['updateSubmit'])) {
  if (empty($_POST['title'])) {
    header('Location: /notes/');
    exit();
  } elseif (empty($_POST['description'])) {
    header('Location: /notes/');
    exit();
  } elseif (empty($_POST['updateId'])) {
    header('Location: /notes/');
    exit();
  }
  else {
    $req = $conn->prepare('UPDATE note SET title = ?, description = ? WHERE id = ?');
    $req->execute(array($_POST['title'], $_POST['description'], $_POST['updateId']));
    header('Location: /notes/');
    exit();
  }
}
else {
  header('Location: /notes/');
  exit();
}
?>
