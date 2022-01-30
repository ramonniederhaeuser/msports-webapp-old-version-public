<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

try {
if(!empty($_POST)) {
  $statement = $pdo->prepare("INSERT INTO `trainings` (`info`, `date`, `time`, `max_member`) VALUE(:info, :date, :time, :maxMember) ");  

  $statement->bindParam(":info", $_POST['info'], PDO::PARAM_STR);
  $statement->bindParam(":date", $_POST['date'], PDO::PARAM_STR);
  $statement->bindParam(":time", $_POST['time'], PDO::PARAM_STR);
  $statement->bindParam(":maxMember", $_POST['maxMember'], PDO::PARAM_STR);

  $statement->execute();
}
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  die();
}


  header("Location: ../admin-training.php");
  die();


?>