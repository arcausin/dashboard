<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

function validationData($donnees) {
	$donnees = trim($donnees); // Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
	$donnees = stripslashes($donnees); // Supprime les antislashs d'une chaîne
	$donnees = htmlspecialchars($donnees); // Convertit les caractères spéciaux en entités HTML
	return $donnees;
}

if (isset($_POST['createSubmit'])) {
  if (empty(validationData($_POST['task']))) {
    header('Location: /to-do-list/');
    exit();
  }
  else {
    $req = $conn_dashboard->prepare('INSERT INTO to_do_list (idUser, task, dateToDoList) VALUES(:idUser, :task, NOW())');
    $req->execute(array(
        'idUser' => $user['id'],
        'task' => validationData($_POST['task'])
    ));
    header('Location: /to-do-list/');
    exit();
  }
}
else {
  header('Location: /to-do-list/');
  exit();
}
?>
