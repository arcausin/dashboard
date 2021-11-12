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
  } elseif (empty($_POST['dateNotes'])) {
    header('Location: /notes/');
    exit();
  }
  else {
    if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] == 0) {
      $folder = $_SERVER['DOCUMENT_ROOT']."/img/notes/";

      switch ($_FILES['illustration']['type']) {
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
      move_uploaded_file($_FILES['illustration']['tmp_name'], $folder . $file);
    }
    else {
      $file = NULL;
    }
    $req = $conn_dashboard->prepare('INSERT INTO note (idUser, title, description, illustration, dateNotes) VALUES(:idUser, :title, :description, :illustration, :dateNotes)');
    $req->execute(array(
        'idUser' => $user['id'],
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'illustration' => $file,
        'dateNotes' => $_POST['dateNotes']
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
