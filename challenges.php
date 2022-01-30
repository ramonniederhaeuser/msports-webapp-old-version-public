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

<div class="h4">
  Hallo <?php echo htmlentities($user['vorname']); ?>,<br>
  Heute schon eine Challenge gemacht?<br><br>
</div>

<!--Get Trainings out of DB-->
<?php
$statement = $pdo->prepare("SELECT * FROM `challenges` ORDER BY `id` ASC");
$statement->execute();
$challenges = $statement->fetchAll();
?>

<!--foreach challenge create a card body and show form-->
<?php foreach ($challenges as $challenge): ?>

<div class="d-flex justify-content-center my-2 text-left">
  <div class="card" style="width: 25rem;">
    <div class="card-body">
      <h5 class="card-title">Challenge Nr. <?php echo $challenge['id'] ?></h5>
      <p class="card-text"><?php echo nl2br($challenge['info']) ?></p>

      <!--only show video Box if not empty-->
      <?php if (!empty($challenge['videolink'])) { ?>
      <iframe src="<?php echo $challenge['videolink']; ?>"></iframe>
      <?php } ?>

      <form action="./views/challengeSaveResult.php?challengeid=<?php echo $challenge["id"]; ?>" method="post">
        <div class="form-group">
          <label class="font-weight-bold" for="inputresult1">Resultat in
            <?php 
            //check which format should get in input
              if ($challenge['evaluation'] == "maxTime") {
                echo "<br>" . "<br>" . "Minuten" . "<br>";
                echo '<input name="challengeResultMin" type="number" min="0" class="form-control" required>';
                echo "sek" . "<br>";
                echo '<input name="challengeResultSek" type="number" min="1" max="59" class="form-control" required>';
              }
              if ($challenge['evaluation'] == "distance") {
                echo "meter" . "<br>" . "<br>";
                echo '<input name="challengeResult" type="number" min="1" step="1" class="form-control" id="inputresult1" required>';
              }
              if ($challenge['evaluation'] == "roundCount") {
                echo "anzahl Runden" . "<br>" . "<br>";
                echo '<input name="challengeResult" type="number" min="1" step="1" class="form-control" id="inputresult1" required>';
              }
              if ($challenge['evaluation'] == "maxRepetition") {
                echo "anzahl wiederholungen" . "<br>" . "<br>";
                echo '<input name="challengeResult" type="number" min="1" step="1" class="form-control" id="inputresult1" required>';
              }
            ?></label>
        </div>
        <button type="submit" class="btn btn-primary">Abschicken</button>
      </form>       

    </div>
  </div>
</div>

<?php endforeach ?>


<?php 
include("templates/footer.inc.php")
?>