<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<!--get all challenges out of DB-->
<?php
$statement = $pdo->prepare("SELECT * FROM `challenges` ORDER BY `id` ASC");
$statement->execute();
$challenges = $statement->fetchAll();
?>


<table class="table">
	<thead>
		<th>ID</th>
		<th>Beschreibung</th>
		<th>Auswertungsmethode</th>
		<th>Rangliste</th>
    <th>Aktion</th>
	</thead>
	<tbody>
		<?php foreach($challenges AS $challenge): ?>
			<tr>
				<td><?php echo $challenge["id"]; ?></td>
				<td><?php echo nl2br($challenge["info"]); ?></td>
        <td><?php 

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

        //evaluate which evaluation form is on and show
        if ($challenge["evaluation"] == "roundCount") {
          echo "nach Anzahl Runden";
        };
        if ($challenge["evaluation"] == "maxTime") {
          echo "nach Gesamtzeit";
        };
        if ($challenge["evaluation"] == "distance") {
          echo "nach Distanz";
        }; 
        if ($challenge["evaluation"] == "maxRepetition") {
          echo "nach Anzahl wiederholungen";
        };   
        ?>
        </td>
        <td>
        <h5>Männer</h5>
        <br>
        <ol>
          <?php foreach ($menArray as $key=>$result) {
          //compare if normal result or hr/min/sek
          if ($eval == "Runden" || $eval == "Meter" || $eval == "wdh.") {
            echo "<li>" . $key . " " . $result . " " . $eval . "</li>";
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
              $sek = "0" . $sek;
            }          
            echo "<li>" . $key . " " . $min . ":" . $sek . " " . $eval . "</li>";
          }
          } ?>
        </ol>
        <h5>Frauen</h5>
        <br>
        <ol>
          <?php foreach ($womenArray as $key=>$result) {
          //compare if normal result or hr/min/sek
          if ($eval == "Runden" || $eval == "Meter" || $eval == "wdh.") {
            echo "<li>" . $key . " " . $result . " " . $eval . "</li>";
          }
          else {
            //doing some math for returning min/sek
            $result = strval($result);
            $result = explode(".", $result);
            $min = $result[0];
            $sek = "0." . $result[1];
            $sek = strval(intval($sek * 60));
            if (strlen($sek) < 2) {
              $sek = "0" . $sek;
            } 
            echo "<li>" . $key . " " . $min . ":" . $sek . " " . $eval . "</li>";
          }
          } ?>


          <?php
          //create new array for weekly Ranking
          $weeklyRankingMen = array();
          $weeklyRankingWomen = array();

          //fill each array with values and give some points
          $menscount = 1;
          foreach ($menArray as $key=>$result) {
            //give some points
            if ($menscount == 1) {$points = 25;};
            if ($menscount == 2) {$points = 22;};
            if ($menscount == 3) {$points = 20;};
            if ($menscount == 4) {$points = 18;};
            if ($menscount == 5) {$points = 16;};
            if ($menscount == 6) {$points = 15;};
            if ($menscount == 7) {$points = 14;};
            if ($menscount == 8) {$points = 13;};
            if ($menscount == 9) {$points = 12;};
            if ($menscount == 10) {$points = 11;};
            if ($menscount == 11) {$points = 10;};
            if ($menscount == 12) {$points = 9;};
            if ($menscount == 13) {$points = 8;};
            if ($menscount == 14) {$points = 7;};
            if ($menscount == 15) {$points = 6;};
            if ($menscount == 16) {$points = 5;};
            if ($menscount == 17) {$points = 4;};
            if ($menscount == 18) {$points = 3;};
            if ($menscount == 19) {$points = 2;};
            if ($menscount == 20) {$points = 1;};
            if ($menscount >= 21) {$points = 0;};
            //save to array
            $weeklyRankingMen[] = array(
              'name' => $key,
              'points' => $points
            );
            $menscount++;
          }

          //encode array to string
          $encodedMen = htmlspecialchars(json_encode($weeklyRankingMen));


          $womenscount = 1;
          foreach ($womenArray as $key=>$result) {
            //give some points
            if ($womenscount == 1) {$points = 25;};
            if ($womenscount == 2) {$points = 22;};
            if ($womenscount == 3) {$points = 20;};
            if ($womenscount == 4) {$points = 18;};
            if ($womenscount == 5) {$points = 16;};
            if ($womenscount == 6) {$points = 15;};
            if ($womenscount == 7) {$points = 14;};
            if ($womenscount == 8) {$points = 13;};
            if ($womenscount == 9) {$points = 12;};
            if ($womenscount == 10) {$points = 11;};
            if ($womenscount == 11) {$points = 10;};
            if ($womenscount == 12) {$points = 9;};
            if ($womenscount == 13) {$points = 8;};
            if ($womenscount == 14) {$points = 7;};
            if ($womenscount == 15) {$points = 6;};
            if ($womenscount == 16) {$points = 5;};
            if ($womenscount == 17) {$points = 4;};
            if ($womenscount == 18) {$points = 3;};
            if ($womenscount == 19) {$points = 2;};
            if ($womenscount == 20) {$points = 1;};
            if ($womenscount >= 21) {$points = 0;};
            //save to array
            $weeklyRankingWomen[] = array(
              'name' => $key,
              'points' => $points
            );
            $womenscount++;
          }    

          //encode array to string
          $encodedWomen = htmlspecialchars(json_encode($weeklyRankingWomen));
          
          ?>
        </ol>
        </td>
        <!--form to delete challenge-->
        <td>
          <form action="./views/challenge-delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $challenge["id"]; ?>" />
            <input type="hidden" name="rankingMen" value="<?php echo $encodedMen; ?>" />
            <input type="hidden" name="rankingWomen" value="<?php echo $encodedWomen; ?>" />
            <button type="submit">Löschen/Speichern</button>
          </form>
        </td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<hr class="my-3">

<?php 
include("templates/admin-footer.inc.php")
?>