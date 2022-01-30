<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<div class="container text-center mt-5">
  
  <?php
    $error_msg = $_GET["notice"];
  ?>

  <div class="alert alert-warning" role="alert">
    <?php echo $error_msg; ?>
  </div>
  <a href="index.php">Zurück zur Startseite</a>
</div>

<?php 
include("templates/admin-footer.inc.php")
?>