<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
session_start();
if (!empty($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

$reqResetPassword = $conn_dashboard->prepare('SELECT firstName, lastName, mailAdress FROM user WHERE mailAdress = ?');
$reqResetPassword->execute(array($_POST['mailAdress']));
$resetPassword = $reqResetPassword->fetch();
$reqResetPassword->closeCursor();

if (isset($_POST['submit'])) { // bouton submit appuyé
  if (empty($_POST['mailAdress'])) { // champ Adresse Mail vide
    // veuillez remplir le champ Adresse Mail
    header('Location: forgot-password.php?mailAdress');
    exit();
  } elseif ($reqResetPassword->rowCount() == 0) {
    header('Location: forgot-password.php?mailAdressUnknown');
    exit();
  }
  else { // toutes les données du formulaires sont correctes
    $resetPasswordToken = bin2hex(random_bytes(32));

    $req = $conn_dashboard->prepare('UPDATE user SET resetPasswordDate = now(), resetPasswordToken = ? WHERE mailAdress = ?');
    $req->execute(array($resetPasswordToken, $_POST['mailAdress']));

    // préparation du mail
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $subject = "[Assistant virtuel] - Demande de réinitialisation de mot de passe";

    ob_start();
		?>
		<p>Bonjour <?php echo $resetPassword['firstName'] . " " . $resetPassword['lastName'] ?>,<br/>
		Nous avons reçu une demande de réinitialisation de mot de passe.<br/>
    Voici le lien pour réinitialiser votre mot de passe : <a href="https://dashboard.alexis-dambrosio.fr/reset-password.php?token=<?php echo $resetPasswordToken ?>">Lien</a><br/>
		___________________________<br/><br/>
		Cordialement<br/>
		[Assistant virtuel]<br/><br/>
		<i>Si vous n'êtes pas à l'origine de cette activité, veuillez ignorer ce mail.</i></p>
		<?php
		$message = ob_get_clean();

    ob_start();
		?>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<title><?php echo $subject ?></title>
			</head>
			<body>
				<?php echo $message ?>
			</body>
		</html>
		<?php
		$corpsEmail = ob_get_clean();

    // envoie du mail
    if (mail($_POST['mailAdress'], $subject, $corpsEmail, $headers)) {
      header('Location: forgot-password.php?mailSend');
      exit();
    }
    else {
      header('Location: forgot-password.php?mailNotSend');
      exit();
    }
  }
}
else { // bouton submit non appuyé
  // veuillez validez le formulaire d'inscription
  header('Location: forgot-password.php');
  exit();
}
?>
