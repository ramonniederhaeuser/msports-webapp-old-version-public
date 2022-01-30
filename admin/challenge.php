<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<div class="container mt-5">
  <form action="./views/challenge-create.php" method="post">

    <div class="form-group mt-4">
      <label for="challengeInfo1">Beschreibung der Challenge:</label>
      <textarea name="challengeInfo" type="text" class="form-control" id="challengeInfo1" rows="4"></textarea>
    </div>

    <div class="form-group mt-4">
      <label for="challengeVideoLink1">Video ID (optional):</label>
      <input name="challengeVideoLink" type="text" class="form-control" id="challengeVideoLink1"></input>
    </div>

    <label class="mt-4">Wie soll die Challenge ausgewertet werden?</label>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="challengeRadios" id="maxTimeRadio1" value="maxTime" checked>
      <label class="form-check-label" for="maxTimeRadio1">
        Gesamtzeit
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="challengeRadios" id="roundCountRadio1" value="roundCount">
      <label class="form-check-label" for="roundCountRadio1">
        Runden
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="challengeRadios" id="distanceRadio1" value="distance">
      <label class="form-check-label" for="distanceRadio1">
        Distanz
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="challengeRadios" id="maxRepetitionRadio1" value="maxRepetition">
      <label class="form-check-label" for="maxRepetitionRadio1">
        Gesamtanzahl wiederholungen
      </label>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Speichern</button>
  </form>
</div>

<?php 
include("templates/admin-footer.inc.php")
?>