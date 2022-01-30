<?php 
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

include("templates/header.inc.php")
?>
<div class="container main-container registration-form">
<h1>Registrierung</h1>
<?php
$showFormular = true; //Variable if form should show
 
if(isset($_GET['register'])) {
	$error = false;
	$vorname = trim($_POST['vorname']);
	$nachname = trim($_POST['nachname']);
	$geburtstag = trim($_POST['geburtstag']);
	$geschlecht = $_POST['geschlecht'];
	$email = trim($_POST['email']);
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	
	if(empty($vorname) || empty($nachname) || empty($email) || empty($geburtstag)) {
		echo 'Bitte alle Felder ausfüllen<br>';
		$error = true;
	}
  
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	} 	
	if(strlen($passwort) == 0) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}
	
	//Check if Email doesnt resists
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();
		
		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}	
	}
	
	//No Error, User can be registrated
	if(!$error) {	
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
		
		$statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, geburtstag, geschlecht) VALUES (:email, :passwort, :vorname, :nachname, :geburtstag, :geschlecht)");
		$result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'geburtstag' => $geburtstag, 'geschlecht' => $geschlecht));
		
		if($result) {		
			echo 'Du wurdest erfolgreich registriert. <a href="index.php">Zurück zur Startseite</a>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	} 
}
 
if($showFormular) {
?>

<form action="?register=1" method="post">

<div class="form-group">
<label for="inputVorname">Vorname:</label>
<input type="text" id="inputVorname" size="40" maxlength="250" name="vorname" class="form-control" required>
</div>

<div class="form-group">
<label for="inputNachname">Nachname:</label>
<input type="text" id="inputNachname" size="40" maxlength="250" name="nachname" class="form-control" required>
</div>

<div class="form-group">
<label for="inputGeburtstag">Geburtsdatum:</label>
<input type="date" id="inputGeburtstag" size="40" maxlength="250" name="geburtstag" class="form-control" required>
</div>

<div id="checkBoxValidationForm">
	<div class="form-check form-check-inline mt-4">
		<input name="geschlecht" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="m">
		<label class="form-check-label" for="inlineCheckbox1">Männlich</label>
	</div>
	<div class="form-check form-check-inline mb-4">
		<input  name="geschlecht" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="w">
		<label class="form-check-label" for="inlineCheckbox2">Weiblich</label>
	</div>
</div>

<div class="form-group">
<label for="inputEmail">E-Mail:</label>
<input type="email" id="inputEmail" size="40" maxlength="250" name="email" class="form-control" required>
</div>

<div class="form-group">
<label for="inputPasswort">Dein Passwort:</label>
<input type="password" id="inputPasswort" size="40"  maxlength="250" name="passwort" class="form-control" required>
</div> 

<div class="form-group">
<label for="inputPasswort2">Passwort wiederholen:</label>
<input type="password" id="inputPasswort2" size="40" maxlength="250" name="passwort2" class="form-control" required>
</div> 
<button id="registerButton" type="submit" class="btn btn-lg btn-primary btn-block">Registrieren</button>
</form>
 
<?php
} //End if($showFormular)
	

?>
</div>

<?php 
include("templates/footer.inc.php")
?>