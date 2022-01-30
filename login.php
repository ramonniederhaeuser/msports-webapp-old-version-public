<?php 
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");


$error_msg = "";
if(isset($_POST['email']) && isset($_POST['passwort'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];

	$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();

	//Check Password
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['id'];

		header("location: internal.php");
		exit;
	} 
	else {
		require("templates/header.inc.php");
		echo '<div class="container alert alert-danger text-center mt-5">
						<hr class="m<3">
						<a href="index.php">E-Mail oder Passwort war ungültig, zurückkehren oder neu Einloggen</a>
					</div>';
		require("templates/footer.inc.php");
	}
}

$email_value = "";
if(isset($_POST['email']))
	$email_value = htmlentities($_POST['email']); 
?>
