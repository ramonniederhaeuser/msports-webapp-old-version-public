<?php
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>

<div class="container main-container mt-5 text-center">

<h3>Persönliche Abo Daten</h3>

<?php echo htmlentities($user['nachname']); echo " "; echo htmlentities($user['vorname']) ?><br>

<?php
$id = htmlentities($user['id']);
$statement = $pdo->prepare("SELECT * FROM `users` WHERE `id` = $id");
$statement->execute();
$user = $statement->fetch();
?>

<form class="mt-5">

<div class="form-group">
  <label class="font-weight-bold">User ID:</label>
  <input class="form-control" value="<?php echo $user["id"] ?>" type="text" readonly>
</div>

<div class="form-group">
  <label for="inputEmail" class="font-weight-bold">E-Mail:</label>
  <input class="form-control" value="<?php echo $user["email"] ?>" type="email" id="inputEmail" name="email" readonly>
</div>

<div class="form-group">
  <label for="inputVorname" class="font-weight-bold">Vorname:</label>
  <input class="form-control" value="<?php echo $user["vorname"] ?>" type="text" id="inputVorname" name="vorname" readonly>
</div>

<div class="form-group">
  <label for="inputNachname" class="font-weight-bold">Nachname:</label>
  <input class="form-control" value="<?php echo $user["nachname"] ?>" type="text" id="inputNachname" name="nachname" readonly>
</div>

<div class="form-group">
  <label for="inputGeburtstag" class="font-weight-bold">Geburtsdatum:</label>
  <input class="form-control" value="<?php echo $user["geburtstag"] ?>" type="text" id="inputGeburtstag" name="geburtstag" readonly>
</div>

<div class="form-group">
  <label for="inputCreated_at" class="font-weight-bold">Registriert am:</label>
  <input class="form-control" value="<?php echo $user["created_at"] ?>" type="text" id="inputCreated_at" name="created_at" readonly>
</div>

<div class="form-group">
  <label for="inputUpdated_at" class="font-weight-bold">Letzte Änderung:</label>
  <input class="form-control" value="<?php echo $user["updated_at"] ?>" type="text" id="inputUpdated_at" name="updated_at" readonly>
</div>

<div class="form-group">
  <label for="inputAboExpiring" class="font-weight-bold">Abo Ablaufdatum:</label>
  <input class="form-control" value="<?php echo $user["abo_expiring_date"] ?>" type="text" id="inputAboExpiring" name="abo_expiring_date" readonly>
  <?php  
    $expiringDate = $user["abo_expiring_date"];
    $dateNow = date("Y-m-d");
    //logic for checking days expired
    $origin = new DateTime($dateNow);
    $target = new DateTime($expiringDate);
    $interval = $origin->diff($target);

    //Check Abo expiring date and create alert
    if ($dateNow >= $expiringDate && !is_null($expiringDate)) {
      echo '<div class="alert alert-danger" role="alert">Abo seit ';
      echo ($interval->format('%a Tagen '));
      echo 'abgelaufen</div>';
    }
    if ($dateNow < $expiringDate) {
      echo '<div class="alert alert-success" role="alert">Abo aktuell, läuft in ';
      echo ($interval->format('%r%a Tagen '));
      echo 'ab</div>';
    }
    if (is_null($expiringDate)) {
      echo '<div class="alert alert-warning" role="alert">Kein Abo hinterlegt</div>';
    }
  ?>
</div>

<div class="form-group">
  <label for="input10xAbo" class="font-weight-bold">10er Abo:</label>
  <input class="form-control" value="<?php if (empty($user["10x_abo"]) || $user["10x_abo"] <= 0) {echo "Nein";}
                                           else {echo "Ja, noch " . $user["10x_abo"] . " Training übrig";}?>" 
                              type="text" 
                              id="input10xAbo" 
                              name="10x_abo" readonly>
</div>
</form>



<?php 
include("templates/footer.inc.php")
?>