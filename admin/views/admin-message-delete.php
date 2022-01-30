<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

if(!empty($_POST) && !empty($_POST["id"])) {
  $id = $_POST["id"];

  $statement = $pdo->prepare("DELETE FROM `messages` WHERE `id`=:id");
  $statement->bindParam(":id", $id, PDO::PARAM_STR);
  $statement->execute();

  header("Location: ../admin-messages.php");
  die();
}

?>