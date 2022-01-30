<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<?php
$statement = $pdo->prepare("SELECT * FROM `messages`");
$statement->execute();
$messages = $statement->fetchAll();
?>

<table class="table">
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Telefonnummer</th>
		<th>Nachricht</th>
		<th>Empfangen am</th>
		<th>Aktion</th>
	</thead>
	<tbody>
		<?php foreach($messages AS $message): ?>
			<tr>
				<td><?php echo $message["id"]; ?></td>
				<td><?php echo $message["name"]; ?></td>
				<td><a href="mailto:<?php echo $message["email"] ?>"><?php echo $message["email"]; ?></a></td>
				<td><?php echo $message["phone"]; ?></td>
        <td><?php echo $message["message"]; ?></td>
				<td><?php echo $message["timestamp"]; ?></td>
        <td>
					<form action="./views/admin-message-delete.php" method="post">
						<input type="hidden" name="id" value="<?php echo $message["id"]; ?>" />
						<button type="submit">Löschen</button>
					</form>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>


<?php 
include("templates/admin-footer.inc.php")
?>