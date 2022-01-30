<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php");

$id = $_GET["id"];

$statement = $pdo->prepare("SELECT * FROM `trainings` WHERE `id` =:id");
$statement->bindParam(":id" , $id);
$statement->execute();
$training = $statement->fetch();

?>

<h1 class="text-center mt-5">Training bearbeiten:</h1>

<div class="container mt-5">
  <form action="./views/admin-training-change.php" method="post">
    <div class="form-group">
      <label for="InputID1">Trainings ID:</label>
      <input name="id" type="text" class="form-control" id="InputID1" readonly value="<?php echo $training["id"] ?>"></input>
    </div>
    <div class="form-group">
      <label for="InputInfo1">Infos:</label>
      <textarea name="info" type="text" class="form-control" id="InputInfo1" rows="3"><?php echo $training["info"] ?></textarea>
    </div>
    <div class="form-group">
      <label for="InputDate1">Datum:</label>
      <input name="date" type="date" class="form-control" id="InputDate1" required value="<?php echo $training["date"] ?>">
    </div>
    <div class="form-group">
      <label for="InputTime1">Uhrzeit:</label>
      <input name="time" type="time" class="form-control" id="InputTime1" required value="<?php echo $training["time"] ?>">
    </div>
    <div class="form-group">
      <label for="InputMaxMember1">Maximale Teilnehmerzahl:</label>
      <input name="maxMember" type="number" class="form-control" id="InputMaxMember1" required value="<?php echo $training["max_member"] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
  </form>
</div>

<?php 
include("templates/admin-footer.inc.php")
?>