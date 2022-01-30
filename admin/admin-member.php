<?php
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<?php
$statement = $pdo->prepare("SELECT * FROM `users`");
$statement->execute();
$users = $statement->fetchAll();
?>

<!-- create Mail List -->
<?php
$mailingList = '';
foreach ($users as $us) {
	$mailingList = $mailingList . ',' . $us["email"];
}
?>


<a href="mailto:<?php echo $mailingList ?>" class="btn btn-primary m-3">Mail an alle</a>

<table class="table">
	<thead>
		<th>ID</th>
		<th>Vorname</th>
		<th>Nachname</th>
		<th>E-Mail</th>
		<th>Registriert am</th>
		<th>Geändert am</th>
		<th>Aktion</th>
	</thead>
	<tbody>
		<?php foreach ($users as $user) : ?>
			<tr>
				<td><?php echo $user["id"]; ?></td>
				<td><?php echo $user["vorname"]; ?></td>
				<td><?php echo $user["nachname"]; ?></td>
				<td><a href="mailto:<?php echo $user["email"] ?>"><?php echo $user["email"]; ?></a></td>
				<td><?php echo $user["created_at"]; ?></td>
				<td><?php echo $user["updated_at"]; ?></td>
				<td>
					<form action="./views/admin-member-delete.php" method="post">
						<input type="hidden" name="id" value="<?php echo $user["id"]; ?>" />
						<button type="submit">Löschen</button>
					</form>
					<form action="admin-member-edit.php?id=<?php echo $user["id"]; ?>" method="post">
						<input type="hidden" name="id" value="<?php echo $user["id"]; ?>" />
						<button type="submit">Bearbeiten</button>
					</form>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
include("templates/admin-footer.inc.php")
?>