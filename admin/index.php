<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<!--Get Members out OF db-->
<?php
$statement = $pdo->prepare("SELECT * FROM `users`");
$statement->execute();
$users = $statement->fetchAll();

$memberCounter = 0;
foreach ($users AS $count) {
  $memberCounter++;
}



?>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" id="index-jumbotron">
  <div class="container text-center">
    <p class="mb-4">Willkommen im Admin Bereich</p>
    <br>
    <h3><strong class="d-none" id="registeredValueCounter"><?php echo $memberCounter ?></strong> Registrierte Nutzer<h3>
    <hr class="my-5">
    <h4 class="mb-5">Was möchtest du tun?</h4>
    <div class="container col-8 col-sm-8 col-md-7 col-lg-5 justify-content-center">
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="admin-member.php" role="button">Benutzereinträge bearbeiten</a></p> 
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="admin-training.php" role="button">Training erstellen</a></p>
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="admin-training-edit.php" role="button">Trainings</a></p>
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="admin-abos.php" role="button">Abos hinzufügen/ bearbeiten</a></p>
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="admin-messages.php" role="button">Kontaktanfragen einsehen</a></p>
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="challenge.php" role="button">Challenge erstellen</a></p>
      <p><a class="btn btn-primary btn-block btn-md mb-2 mt-2" href="challenge-results.php" role="button">Challenges Ergebnisse</a></p>
    </div>
  </div>
</div>
  
<?php 
include("templates/admin-footer.inc.php")
?>