<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['createSubmit'])) {
  if (empty($_POST['title'])) {
    header('Location: /notes/');
    exit();
  } elseif (empty($_POST['description'])) {
    header('Location: /notes/');
    exit();
  }
  else {
    $req = $conn->prepare('INSERT INTO note (idUser, title, description, creationDate) VALUES(:idUser, :title, :description, NOW())');
    $req->execute(array(
        'idUser' => $user['id'],
        'title' => $_POST['title'],
        'description' => $_POST['description']
    ));
    header('Location: /notes/');
    exit();
  }
}
else {
  header('Location: /notes/');
  exit();
}
?>
