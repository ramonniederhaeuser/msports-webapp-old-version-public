<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<div class="container mt-5">
  <form action="./views/admin-training-create.php" method="post">
    <div class="form-group">
      <label for="InputInfo1">Infos:</label>
      <textarea name="info" type="text" class="form-control" id="InputInfo1" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="InputDate1">Datum:</label>
      <input name="date" type="date" class="form-control" id="InputDate1" required>
    </div>
    <div class="form-group">
      <label for="InputTime1">Uhrzeit:</label>
      <input name="time" type="time" class="form-control" id="InputTime1" required>
    </div>
    <div class="form-group">
      <label for="InputMaxMember1">Maximale Teilnehmerzahl:</label>
      <input name="maxMember" type="number" class="form-control" id="InputMaxMember1" required>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
  </form>
</div>

<?php 
include("templates/admin-footer.inc.php")
?>