<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

try {
if(!empty($_POST)) {

  if (!empty($_POST['challengeVideoLink'])) {
    $videoLink = "https://www.youtube.com/embed/" . $_POST['challengeVideoLink'];
  }
  else {
    $videoLink = NULL;
  }

  $statement = $pdo->prepare("INSERT INTO `challenges` (`info`, `evaluation`, `videolink`) VALUE(:info, :evaluation, :videolink) ");  

  $statement->bindParam(":info", $_POST['challengeInfo'], PDO::PARAM_STR);
  $statement->bindParam(":evaluation", $_POST['challengeRadios'], PDO::PARAM_STR);
  $statement->bindParam(":videolink", $videoLink, PDO::PARAM_STR);

  $statement->execute();
}
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  die();
}


  header("Location: ../challenge.php");
  die();


?>