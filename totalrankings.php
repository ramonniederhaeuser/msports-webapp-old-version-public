<?php
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>

<!--Get Challenge Total Ranking out of DB-->
<?php
$statement = $pdo->prepare("SELECT * FROM `challengeRankings`");
$statement->execute();
$challengeRankings = $statement->fetchAll();

$menArray = array();
$womenArray = array();

//get each user and his points and fill in new Array
foreach ($challengeRankings as $challengeRanking) {
  $temporary = json_decode($challengeRanking["resultsMen"]);
  foreach ($temporary as $singleResult) {
    
    $name = $singleResult->{"name"};
    $points = $singleResult->{"points"};

    //search within array if name already exists add points
    $search = array_search($name, array_column($menArray, 'name'));
    if ($search === false) {
      $menArray[] = array(
        'name' => $name,
        'points' => $points
      );
    }
    else {
      $menArray[$search]["points"] = $menArray[$search]["points"] + $points;
    }
  }
}

//get each user and his points and fill in new Array
foreach ($challengeRankings as $challengeRanking) {
  $temporary = json_decode($challengeRanking["resultsWomen"]);
  foreach ($temporary as $singleResult) {
    
    $name = $singleResult->{"name"};
    $points = $singleResult->{"points"};

    //search within array if name already exists add points
    $search = array_search($name, array_column($womenArray, 'name'));
    if ($search === false) {
      $womenArray[] = array(
        'name' => $name,
        'points' => $points
      );
    }
    else {
      $womenArray[$search]["points"] = $womenArray[$search]["points"] + $points;
    }
  }
}

//sort arrays
usort($menArray, "custom_sort");
usort($womenArray, "custom_sort");
//custom sort function, to sort points descendin
function custom_sort($a, $b) {
  return $a["points"]<$b["points"];
}


?>

<div class="container main-container mt-5 text-center">

  <div class="h4">
    <?php echo htmlentities($user['vorname']); ?>,<br>
    Wo stehst du im<br>Gesamtranking<br>
    aller Challenges?<br><br>
  </div>

  <table class="table table-striped table-primary">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Punkte</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        //get all challenges and results
        $count = 1;
        foreach ($menArray as $men) { 
          echo "<tr>";
          echo '<th scope="row">' . $count . "</th>";
          echo "<td>" . $men["name"] . "</td>";
          echo "<td>" . $men["points"] . "</td>";
          echo "</tr>";
          $count++;
        }
      ?>
    </tbody>
  </table>
  <br><br>
  <table class="table table-striped table-primary">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Punkte</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        //get all challenges and results
        $count = 1;
        foreach ($womenArray as $women) { 
          echo "<tr>";
          echo '<th scope="row">' . $count . "</th>";
          echo "<td>" . $women["name"] . "</td>";
          echo "<td>" . $women["points"] . "</td>";
          echo "</tr>";
          $count++;
        }
      ?>
    </tbody>
  </table>

</div>

<?php 
include("templates/footer.inc.php")
?> 