<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");

if (isset($_POST['updateSubmit'])) { // on vérifie si on a bien récup toutes les infos
  if (empty($_POST['title'])) {
    header('Location: /notes/');
    exit();
  } elseif (empty($_POST['description'])) {
    header('Location: /notes/');
    exit();
  } elseif (empty($_POST['dateNotes'])) {
    header('Location: /notes/');
    exit();
  } elseif (empty($_POST['updateId'])) {
    header('Location: /notes/');
    exit();
  }
  else { // si c'est ok on vérifie si la note lui appartient
    $reqNote = $conn_dashboard->prepare('SELECT id, idUser, illustration FROM note WHERE id = ? AND idUser = ?');
    $reqNote->execute(array($_POST['updateId'], $user['id']));
    $note = $reqNote->fetch();
    $reqNote->closeCursor();

    if ($reqNote->rowCount() == 0) {
      header('Location: /notes/');
      exit();
    } elseif (isset($_FILES['illustrationUpdate']) && $_FILES['illustrationUpdate']['error'] == 0) { // si il ajoute une image on la stock
      $folder = $_SERVER['DOCUMENT_ROOT']."/img/notes/";

      switch ($_FILES['illustrationUpdate']['type']) {
        case 'image/png':
        $extension = ".png";
        break;
        case 'image/jpeg':
        $extension = ".jpg";
        break;
        case 'image/jpeg':
        $extension = ".jpeg";
        break;
        case 'image/bmp':
        $extension = ".bmp";
        break;
        case 'image/gif':
        $extension = ".gif";
        break;
        case 'image/x-icon':
        $extension = ".ico";
        break;
        case 'image/svg+xml':
        $extension = ".svg";
        break;
        case 'image/tiff':
        $extension = ".tif";
        break;
        case 'image/tiff':
        $extension = ".tiff";
        break;
        case 'image/webp':
        $extension = ".webp";
        break;

        default:
        $extension = ".unknown";
        break;
      }
      $file = md5(uniqid()) .$extension;
      move_uploaded_file($_FILES['illustrationUpdate']['tmp_name'], $folder . $file);

      if (!empty($note['illustration'])) {
        $link = $folder.$note['illustration'];
        unlink($link);
      }
    }
    else { // sinon on garde l'image qu'on avait deja et on update la base de données
      $file = $note['illustration'];
    }

    $req = $conn_dashboard->prepare('UPDATE note SET title = ?, description = ?, illustration = ?, dateNotes = ? WHERE id = ?');
    $req->execute(array($_POST['title'], $_POST['description'], $file, $_POST['dateNotes'], $_POST['updateId']));
    header('Location: /notes/');
    exit();
  }
} elseif (isset($_GET['idDeleteIllustration'])) { // on vient sur la page seulement pour supprimer l'image d'illustration d'une note
  $reqDeleteIllustration = $conn_dashboard->prepare('SELECT id, idUser, illustration FROM note WHERE id = ? AND idUser = ?');
  $reqDeleteIllustration->execute(array($_GET['idDeleteIllustration'], $user['id']));
  $deleteIllustration = $reqDeleteIllustration->fetch();
  $reqDeleteIllustration->closeCursor();

  if ($reqDeleteIllustration->rowCount() == 0) { // on vérifie si la note lui appartient
    header('Location: /notes/');
    exit();
  }
  else { // si la note lui appartient on supprime le fichier du serveur et on update la base de données
    $link = $folder.$deleteIllustration['illustration'];
    unlink($link);
    $file = NULL;

    $req = $conn_dashboard->prepare('UPDATE note SET illustration = ? WHERE id = ?');
    $req->execute(array($file, $_GET['idDeleteIllustration']));

    header('Location: /notes/');
    exit();
  }
}
else {
  header('Location: /notes/');
  exit();
}
?>
