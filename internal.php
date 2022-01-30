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

	<h2>Herzlich willkommen!</h2>

	Hallo <?php echo htmlentities($user['vorname']); ?>,<br>
	Hier erscheinen deine Trainings:<br><br>

	<!--Get Trainings out of DB-->
	<?php
	$statement = $pdo->prepare("SELECT * FROM `trainings` ORDER BY DATE(date) ASC");
	$statement->execute();
	$trainings = $statement->fetchAll();
	?>

	<div class="container-fluid text-center">
		<?php foreach ($trainings as $training) : ?>
			<div class="jumbotron">
				<h3 type="date"><?php echo $training["date"] ?></h3>
				<h3><?php echo $training["time"] ?></h3>
				<p class="lead"><?php echo nl2br($training["info"]); ?></p>
				<p class="lead">Maximale Teilnehmer: <?php echo $training["max_member"]; ?></p>
				<?php
				//check if maxmember is reached and hide form
				//get member log and max member out of db
				$member_log = $training["member_log"];
				$max_member = $training["max_member"];
				//get training time and date out of db
				$trainingTime = $training["time"];
				$trainingDate = $training["date"];
				//var for abo comparison
				$dateNow = date("Y-m-d"); //get datenow
				$timeNow = date("H:i:s"); //get time now
				$expiringDate = $user["abo_expiring_date"]; //users expiring date


				//Set Show formular variable to true
				$showFormular = true;

				//check if max member already achieved and if so, show red button 
				if ($member_log >= $max_member) {
					$showFormular = false;
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Maximale Teilnehmer erreicht!</strong>
							</div>';
				}

				//if registration deadline reached hide check-in form
				if ($trainingDate == $dateNow && $timeNow >= "17:30:00") {
					$showFormular = false;
					echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
								<strong>Anmeldefrist endet jeweils um 17:30</strong>
							</div>';
				}


				//if user either has Abo nor 10x Abo disable check-In Button 
				//logic for checking days expired
				$origin = new DateTime($dateNow);
				$target = new DateTime($expiringDate);
				$interval = $origin->diff($target);
				//compare Abo Data and set true or false
				if ($dateNow >= $expiringDate || is_null($expiringDate)) {
					$abo = false;
				} else {
					$abo = true;
				}
				if (empty($user["10x_abo"]) || $user["10x_abo"] <= 0) {
					$aboTen = false;
				} else {
					$aboTen = true;
				}
				//show that no abo is here and hide check in Button
				if ($abo == false && $aboTen == false) {
					$showFormular = false;
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Kein Abo vorhanden!</strong> Keine anmeldung möglich.
							</div>';
				}

				?>

				<p class="lead mt-3">Anmeldungen: </p><br>
				<hr class="my-1">
				<?php
				//decode array string
				$array = json_decode($training["member"], true);

				if (in_array($user["id"], $array)) {
					$showFormular = false;
				}

				//get users out of db
				$statement = $pdo->prepare("SELECT * FROM `users` WHERE id IN ('" . implode("','", $array) . "')");
				$statement->execute();
				$users = $statement->fetchAll();

				$count = 0;
				//check if id has a match, if so show name and create increasing number
				foreach ($users as $userid) {
					$count++;
					echo $count . ".  "	. $userid["vorname"] . " " . $userid["nachname"] . "<br>";
				}
				?>

				<!--start if and check if form check-in should show-->
				<?php if ($showFormular == true) { ?>
					<form action="views/internal-checkin.php?trainingid=<?php echo $training["id"]; ?>" method="post">
						<button class="btn btn-primary mt-5" type="submit" onclick="return msgBox();">Check-In</button>
					</form>
					<!--endif-->
				<?php } ?>
				<!--reset $showFormular Variable-->
				<?php $showFormular = true; ?>

			</div>
			<!--endforeach trainings-->
		<?php endforeach ?>
	</div>

	<?php
	include("templates/footer.inc.php")
	?>