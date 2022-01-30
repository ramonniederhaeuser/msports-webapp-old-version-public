<?php 
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

include("templates/header.inc.php")
?>

<!-- Main jumbotron for a primary marketing message or call to action -->

  <div class="container mt-3">
    <h1 class="mb-4 text-center">Willkommen bei Msports</h1>
    <hr class="my-3">

    <div class="container">
      <form class="form-group mt-3" action="login.php" method="post">
        <input class="form-control mt-3" type="email" name="email" placeholder="E-Mail *" required>
        <input class="form-control mt-3" type="password" name="passwort" placeholder="Passwort *" required>
        <button class="btn btn-outline-primary mt-4" type="submit">Login</button>
      </form>
      <a href="register.php">Registrieren</a>
    </div>
 
<?php 
include("templates/footer.inc.php")
?>
