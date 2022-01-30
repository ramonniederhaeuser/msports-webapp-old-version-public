<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

try {
  if(!empty($_POST)) {

  $statement = $pdo->prepare("UPDATE trainings SET `info` =:info, 
                                               `date` =:date, 
                                               `time` =:time,
                                               `max_member` =:maxMember 
                                                WHERE id = :id");  

  $statement->bindParam(":id", $_POST['id']);
  $statement->bindParam(":info", $_POST['info']);
  $statement->bindParam(":date", $_POST['date']);
  $statement->bindParam(":time", $_POST['time']);
  $statement->bindParam(":maxMember", $_POST['maxMember']);

  $statement->execute();
  }
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  die();
}
header("Location: ../admin-training-edit.php");
die();


?>