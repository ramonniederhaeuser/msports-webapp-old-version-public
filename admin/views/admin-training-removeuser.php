<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");


if(!empty($_POST)) {

  $useridtoremove = $_POST["useridtoremove"];
  $trainingid = $_GET["id"];

  //get Training Out of DB
  $statement = $pdo->prepare("SELECT * FROM `trainings` WHERE id =:id");
  $statement->bindParam(":id", $trainingid);
  $statement->execute();
  $training = $statement->fetch();
  //decrease <member_log+1
  $member_log = $training["member_log"];
  $member_log--;
  //save string to array
  $array = json_decode($training["member"]);
  //delete user with matched id from array
  $newarray = array_diff($array, array($useridtoremove));
  //Re-Index array
  $newarrayRe = array_values($newarray);
  //get array back to string
  $stringarray = json_encode($newarrayRe);
  //get string array and member_log back to DB
  $statement2 = $pdo->prepare("UPDATE trainings SET `member` =:member, `member_log` =:member_log WHERE id = :id");  
  $statement2->bindParam(":id", $trainingid);
  $statement2->bindParam(":member", $stringarray);
  $statement2->bindParam(":member_log", $member_log);
  $statement2->execute();

  //at least check if user has 10x abo and give him one back
  $statement3 = $pdo->prepare("SELECT * FROM `users` WHERE id =:id");
  $statement3->bindParam(":id", $useridtoremove);
  $statement3->execute();
  $usertocheck = $statement3->fetch();
  //get datenow and abo date and save it to variable
  $datenow = date("Y-m-d");
  $abodate = $usertocheck["abo_expiring_date"];
  //check if user to removed has 10x abo
  if ($abodate == NULL || $datenow > $abodate) {
    $increased10xabo = $usertocheck["10x_abo"];
    $increased10xabo++;
  }
  //get new 10x abo from user increased back to DB
  $statement4 = $pdo->prepare("UPDATE users SET `10x_abo` =:10x_abo WHERE id =:id");
  $statement4->bindParam(":id", $useridtoremove);
  $statement4->bindParam(":10x_abo", $increased10xabo);
  $statement4->execute();

  //get back to trainings page
  header("Location: ../admin-training-edit.php");
  die();
}

else {
  header("Location: ../admin-training-edit.php");
  die();
}

?>