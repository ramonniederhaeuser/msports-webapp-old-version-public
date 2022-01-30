<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

if(!empty($_POST) && !empty($_POST["id"])) {

  $id = $_POST["id"];
  $resultsMen = $_POST["rankingMen"];
  $resultsWomen = $_POST["rankingWomen"];


  $statement = $pdo->prepare("DELETE FROM `challenges` WHERE `id`=:id");
  $statement->bindParam(":id", $id, PDO::PARAM_STR);
  $statement->execute();

  $statement2 = $pdo->prepare("INSERT INTO `challengeRankings`(`id`, `resultsMen`, `resultsWomen`) VALUES (:id, :resultsMen, :resultsWomen)");
  $statement2->bindParam(":id", $id, PDO::PARAM_STR);
  $statement2->bindParam(":resultsMen", $resultsMen, PDO::PARAM_STR);
  $statement2->bindParam(":resultsWomen", $resultsWomen, PDO::PARAM_STR);
  $statement2->execute();

  header("Location: ../challenge-results.php");
  die();
}

?>