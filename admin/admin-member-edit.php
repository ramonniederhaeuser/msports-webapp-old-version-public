<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php");

$id = $_GET["id"];

$statement = $pdo->prepare("SELECT * FROM `users` WHERE `id` =:id");
$statement->bindParam(":id" , $id);
$statement->execute();
$user = $statement->fetch();

?>

<div class="container">

  <form action="views/admin-member-change.php?id=<?php echo $id?>" method="post">

    <div class="form-group">
      <label for="inputVorname">Vorname:</label>
      <input value="<?php echo $user["vorname"] ?>" type="text" id="inputVorname" size="40" maxlength="250" name="vorname" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="inputNachname">Nachname:</label>
      <input value="<?php echo $user["nachname"] ?>" type="text" id="inputNachname" size="40" maxlength="250" name="nachname" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="inputEmail">E-Mail:</label>
      <input value="<?php echo $user["email"] ?>" type="email" id="inputEmail" size="40" maxlength="250" name="email" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-lg btn-primary btn-block">Änderungen Speichern</button>
  </form>

  <br><br>

  <form action="views/admin-member-resetpassword.php?id=<?php echo $id?>" method="post">
    <input value="1234" type="hidden" name="passwort" class="form-control">
    <button type="submit" class="btn btn-lg btn-primary btn-block">Passwort zurücksetzen</button>
  </form>
  
</div>
<?php 
include("templates/admin-footer.inc.php")
?>