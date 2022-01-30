<?php
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

//check if usr is logged in
//must integrate in every internal page
$user = check_user();

include("templates/header.inc.php");

if(isset($_GET['save'])) {
	$save = $_GET['save'];
	
	if($save == 'personal_data') {
		$vorname = trim($_POST['vorname']);
		$nachname = trim($_POST['nachname']);
		$geburtstag = trim($_POST['geburtstag']);
		
		if($vorname == "" || $nachname == "") {
			$error_msg = "Bitte Vor-und Nachname ausfüllen.";
		} else {
			$statement = $pdo->prepare("UPDATE users SET vorname = :vorname, nachname = :nachname, geburtstag = :geburtstag, updated_at=NOW() WHERE id = :userid");
			$result = $statement->execute(array('vorname' => $vorname, 'nachname'=> $nachname, 'geburtstag'=> $geburtstag, 'userid' => $user['id'] ));
			
			$success_msg = "Daten erfolgreich gespeichert.";
		}
	} else if($save == 'email') {
		$passwort = $_POST['passwort'];
		$email = trim($_POST['email']);
		$email2 = trim($_POST['email2']);
		
		if($email != $email2) {
			$error_msg = "Die eingegebenen E-Mail-Adressen stimmten nicht überein.";
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error_msg = "Bitte eine gültige E-Mail-Adresse eingeben.";
		} else if(!password_verify($passwort, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		} else {
			$statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :userid");
			$result = $statement->execute(array('email' => $email, 'userid' => $user['id'] ));
				
			$success_msg = "E-Mail-Adresse erfolgreich gespeichert.";
		}
		
	} else if($save == 'passwort') {
		$passwortAlt = $_POST['passwortAlt'];
		$passwortNeu = trim($_POST['passwortNeu']);
		$passwortNeu2 = trim($_POST['passwortNeu2']);
		
		if($passwortNeu != $passwortNeu2) {
			$error_msg = "Die eingegebenen Passwörter stimmten nicht überein.";
		} else if($passwortNeu == "") {
			$error_msg = "Das Passwort darf nicht leer sein.";
		} else if(!password_verify($passwortAlt, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		} else {
			$passwort_hash = password_hash($passwortNeu, PASSWORD_DEFAULT);
				
			$statement = $pdo->prepare("UPDATE users SET passwort = :passwort WHERE id = :userid");
			$result = $statement->execute(array('passwort' => $passwort_hash, 'userid' => $user['id'] ));
				
			$success_msg = "Passwort erfolgreich gespeichert.";
		}
		
	}
}

$user = check_user();

?>

<div class="container main-container mt-5">

<h1>Einstellungen</h1>

<?php 
if(isset($success_msg) && !empty($success_msg)):
?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	<?php echo $success_msg; ?>
	</div>
<?php 
endif;
?>

<?php 
if(isset($error_msg) && !empty($error_msg)):
?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	<?php echo $error_msg; ?>
	</div>
<?php 
endif;
?>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="mr-3" role="presentation" class="active"><a href="#data" aria-controls="home" role="tab" data-toggle="tab">Persönliche Daten</a></li>
    <li class="mr-3" role="presentation"><a href="#email" aria-controls="profile" role="tab" data-toggle="tab">E-Mail</a></li>
    <li role="presentation"><a href="#passwort" aria-controls="messages" role="tab" data-toggle="tab">Passwort</a></li>
  </ul>

  <!-- Personal Data-->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="data">
    	<br>
    	<form action="?save=personal_data" method="post" class="form-horizontal">
    		<div class="form-group">
    			<label for="inputVorname" class="col-sm-2 control-label">Vorname</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputVorname" name="vorname" type="text" value="<?php echo htmlentities($user['vorname']); ?>" required>
    			</div>
    		</div>
    		
    		<div class="form-group">
    			<label for="inputNachname" class="col-sm-2 control-label">Nachname</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputNachname" name="nachname" type="text" value="<?php echo htmlentities($user['nachname']); ?>" required>
    			</div>
				</div>
				
				<div class="form-group">
    			<label for="inputGeburtstag" class="col-sm-2 control-label">Geburtsdatum</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputGeburtstag" name="geburtstag" type="date" value="<?php echo htmlentities($user['geburtstag']); ?>" required>
    			</div>
    		</div>
    		
    		<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Speichern</button>
			    </div>
			</div>
    	</form>
    </div>
    
    <!-- Change email -->
    <div role="tabpanel" class="tab-pane" id="email">
    	<br>
    	<p>Zum Ändern deiner E-Mail-Adresse gib bitte dein aktuelles Passwort sowie die neue E-Mail-Adresse ein.</p>
    	<form action="?save=email" method="post" class="form-horizontal">
    		<div class="form-group">
    			<label for="inputPasswort" class="col-sm-2 control-label">Passwort</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswort" name="passwort" type="password" required>
    			</div>
    		</div>
    		
    		<div class="form-group">
    			<label for="inputEmail" class="col-sm-2 control-label">E-Mail</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputEmail" name="email" type="email" value="<?php echo htmlentities($user['email']); ?>" required>
    			</div>
    		</div>
    		
    		
    		<div class="form-group">
    			<label for="inputEmail2" class="col-sm-2 control-label">E-Mail (wiederholen)</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputEmail2" name="email2" type="email"  required>
    			</div>
    		</div>
    		
    		<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Speichern</button>
			    </div>
			</div>
    	</form>
    </div>
    
    <!-- Change Password -->
    <div role="tabpanel" class="tab-pane" id="passwort">
    	<br>
    	<p>Zum Änderen deines Passworts gib bitte dein aktuelles Passwort sowie das neue Passwort ein.</p>
    	<form action="?save=passwort" method="post" class="form-horizontal">
    		<div class="form-group">
    			<label for="inputPasswort" class="col-sm-2 control-label">Altes Passwort</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswort" name="passwortAlt" type="password" required>
    			</div>
    		</div>
    		
    		<div class="form-group">
    			<label for="inputPasswortNeu" class="col-sm-2 control-label">Neues Passwort</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswortNeu" name="passwortNeu" type="password" required>
    			</div>
    		</div>
    		
    		
    		<div class="form-group">
    			<label for="inputPasswortNeu2" class="col-sm-2 control-label">Neues Passwort (wiederholen)</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswortNeu2" name="passwortNeu2" type="password"  required>
    			</div>
    		</div>
    		
    		<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Speichern</button>
			    </div>
			</div>
    	</form>
    </div>
  </div>

</div>


</div>
<?php 
include("templates/footer.inc.php")
?>
