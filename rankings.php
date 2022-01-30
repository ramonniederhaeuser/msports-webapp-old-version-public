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
  <?php echo htmlentities($user['vorname']); ?>,<br>
  Hier siehst du alle Ergebnisse<br>
  der aktuellen Woche<br><br>
</div>

<table class="table table-dark table-striped d-none" id="mensRankingTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Punkte</th>
    </tr>
  </thead>
  <tbody id="mensWeeklyRanking"></tbody>
</table>

<table class="table table-dark table-striped d-none" id="womensRankingTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Punkte</th>
    </tr>
  </thead>
  <tbody id="womensWeeklyRanking"></tbody>
</table>


<!--Get Challenges out of DB-->
<?php
$statement = $pdo->prepare("SELECT * FROM `challenges` ORDER BY `id` ASC");
$statement->execute();
$challenges = $statement->fetchAll();
?>

<!--foreach challenge create a card body with all infos in it-->
<?php foreach ($challenges as $challenge): 
  //save members and result to array
  $membersResultArray = json_decode($challenge['member']);

  //create Array, women and men
  $menArray = array();
  $womenArray = array();

  //create empty variables
  $name = "";
  $result = "";

  //push every user with name as key and result as value in it
  $counter = 0;
  //alternate userId and result in foreach loop
  foreach ($membersResultArray as $member) {
    if ($counter % 2 == 0) {
      $statement = $pdo->prepare("SELECT * FROM `users` WHERE id =:id");
      $statement->bindParam(":id", $member);
      $statement->execute();
      $user = $statement->fetch();
      //save name and result in variable
      $name = $user['vorname'] . " " . $user['nachname'];
    }
    else {
      if ($challenge['evaluation'] == "maxTime") {
        $eval = "m:s";
      }
      if ($challenge['evaluation'] == "roundCount") {
        $eval = "Runden";
      }
      if ($challenge['evaluation'] == "distance") {
        $eval = "Meter";
      }
      if ($challenge['evaluation'] == "maxRepetition") {
        $eval = "wdh.";
      }
      //save result in variable
      $result = $member;
    } 
    //only if both var are not empty create new string and reset values
    if (!empty($name) && !empty($result)) {
      //check if user is m or w and push in right array
      if($user['geschlecht'] == "m") {
        $arr = array($name => $result);
        $menArray = array_merge($arr, $menArray);
      }
      if($user['geschlecht'] == "w") {
        $arr = array($name => $result);
        $womenArray = array_merge($arr, $womenArray);
      }
      //clear var
      $name = "";
      $result = "";
    }
    $counter++;
  } 
  //sort each array, handling challengetype
  if ($challenge['evaluation'] == "maxTime") {
    asort($menArray);
    asort($womenArray);
  }
  if ($challenge['evaluation'] == "roundCount") {
    arsort($menArray);
    arsort($womenArray);
  }
  if ($challenge['evaluation'] == "distance") {
    arsort($menArray);
    arsort($womenArray);
  }
  if ($challenge['evaluation'] == "maxRepetition") {
    arsort($menArray);
    arsort($womenArray);
  }
?>

<div class="d-flex justify-content-center my-2 text-left">
  <div class="card" style="width: 25rem;">
    <div class="card-body">
      <h5 class="card-title text-info">Challenge Nr. <?php echo $challenge['id'] ?></h5>
      <p class="card-text text-info"><?php echo nl2br($challenge['info']) ?></p>
      <br>
      <h4>Rangliste Männer</h4>
      <br>
      <ol class="mensList">
        <?php foreach ($menArray as $key=>$result) {
          //compare if normal result or hr/min/sek
          if ($eval == "Runden" || $eval == "Meter" || $eval == "wdh.") {
            echo "<li>" . $key . "</li>";
          }
          else {
            //doing some math for returning min/sek
            $result = strval($result);
            $result = explode(".", $result);
            $min = $result[0];
            $sek = "0." . $result[1];
            $sek = strval(intval($sek * 60)); 
            //if seconds (40 = 4) means no double, add a 0 to it
            if (strlen($sek) < 2) {
              $sek =  "0" . $sek;
            }          
            echo "<li>" . $key .  "</li>";
          }
        } ?>
      </ol>
      <h4>Rangliste Frauen</h4>
      <br>
      <ol class="womensList">
        <?php foreach ($womenArray as $key=>$result) {
          //compare if normal result or hr/min/sek
          if ($eval == "Runden" || $eval == "Meter" || $eval == "wdh.") {
            echo "<li>" . $key .  "</li>";
          }
          else {
            //doing some math for returning min/sek
            $result = strval($result);
            $result = explode(".", $result);
            $min = $result[0];
            $sek = "0." . $result[1];
            $sek = strval(intval($sek * 60));
            if (strlen($sek) < 2) {
              $sek =  "0" . $sek;
            } 
            echo "<li>" . $key .  "</li>";
          }
        } ?>
      </ol>
    </div>
  </div>
</div>
<?php endforeach ?>


<?php 
include("templates/footer.inc.php")
?> 