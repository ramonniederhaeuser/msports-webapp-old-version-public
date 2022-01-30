<?php 
session_start();
session_destroy();
unset($_SESSION['userid']);

//Remove Cookies
setcookie("identifier","",time()-(3600*24*365)); 
setcookie("securitytoken","",time()-(3600*24*365)); 

require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

include("templates/header.inc.php");
?>

<div class="container main-container mt-5 text-center">
Der Logout war erfolgreich <a href="index.php">Zurück zur Startseite</a>.
</div>
<?php 
include("templates/footer.inc.php")
?>