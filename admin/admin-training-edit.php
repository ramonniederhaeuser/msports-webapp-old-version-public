<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<?php
$statement = $pdo->prepare("SELECT * FROM `trainings` ORDER BY DATE(date) ASC");
$statement->execute();
$trainings = $statement->fetchAll();
?>

<table class="table">
	<thead>
		<th>ID</th>
		<th>Infos</th>
		<th>Datum</th>
		<th>Zeit</th>
    <th>Max Teilnehmer</th>
		<th>Angemeldet</th>
    <th>Aktion</th>
	</thead>
	<tbody>
		<?php foreach($trainings AS $training): ?>
			<tr>
				<td><?php echo $training["id"]; ?></td>
				<td><?php echo $training["info"]; ?></td>
				<td><?php echo $training["date"]; ?></td>
				<td><?php echo $training["time"]; ?></td>
        <td><?php echo $training["max_member"]; ?></td>
				<td>
					<?php 
					//get array out of DB training and convert to array
					$array = json_decode($training["member"], true);
					//get users whcih are logged in out of db users
					$statement = $pdo->prepare("SELECT * FROM `users` WHERE id IN ('" . implode("','", $array) . "')");
					$statement->execute();
					$users = $statement->fetchAll();
					$count = 0; //counter for increasing number
					//check if id has a match, if so show name and create increasing number
					foreach($users as $userid): {
						$count++;
						echo $count . ".  "	. $userid["vorname"] . " " . $userid["nachname"];
					}?>
					<!--create form for every user to remove-->
					<form action="./views/admin-training-removeuser.php?id=<?php echo $training["id"] ?>" method="post">
						<input type="hidden" name="useridtoremove" value="<?php echo $userid["id"] ?>" />
						<button class="mb-2 small" type="submit">Nutzer entfernen</button>					
					</form>
					<?php endforeach ?>
					</td>
				<td>
				<!--form to delete and edit trainings-->
					<form action="./views/admin-training-edit-delete.php" method="post">
						<input type="hidden" name="id" value="<?php echo $training["id"]; ?>" />
						<button type="submit">Löschen</button>
					</form>
					<form action="admin-training-edit-edit.php?id=<?php echo $training["id"]; ?>" method="post">
						<button type="submit">Bearbeiten</button>
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
