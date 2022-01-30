<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

//check user and get his ID
$user = check_user();
//get variable trainingid
$challengeId = $_GET['challengeid'];
//get post data
$challengeResult = $_POST['challengeResult'];
$challengeResultMin = $_POST['challengeResultMin'];
$challengeResultSek = $_POST['challengeResultSek'];

//if result is single
if ($challengeResult) {
  try {
    //get Data out of DB training and compare
    $statement = $pdo->prepare("SELECT * FROM `challenges` WHERE `id` =:challengeid");
    $statement->bindParam(":challengeid", $challengeId);
    $statement->execute();
    $challengeEntry = $statement->fetch();

    //get member string and convert to array
    $member = json_decode($challengeEntry['member']);
    //check if array is empty, false = create empty array
    if(empty($member)) {
      $member = [];
    }

    //save user id and result to array
    $userArray = array($user['id'], $challengeResult);

    //merge array with new user and result and store it to string
    $newEntry = json_encode(array_merge($userArray, $member));
    
    //write changes Back to DB trainings
    $statement2 = $pdo->prepare("UPDATE `challenges` SET `member` =:newEntry  WHERE `id` =:id");
    
    $statement2->bindParam(":id", $challengeId);
    $statement2->bindParam(":newEntry", $newEntry);

    $statement2->execute();
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  die();
}


header("Location: ../challenges.php");
die();
}
//if result is in min/sek
else {
  try {
    //calculate min/sek
    $challengeResult =  $challengeResultMin + ($challengeResultSek/60);

    //get Data out of DB training and compare
    $statement = $pdo->prepare("SELECT * FROM `challenges` WHERE `id` =:challengeid");
    $statement->bindParam(":challengeid", $challengeId);
    $statement->execute();
    $challengeEntry = $statement->fetch();

    //get member string and convert to array
    $member = json_decode($challengeEntry['member']);
    //check if array is empty, false = create empty array
    if(empty($member)) {
      $member = [];
    }

    //save user id and result to array
    $userArray = array($user['id'], $challengeResult);

    //merge array with new user and result and store it to string
    $newEntry = json_encode(array_merge($userArray, $member));
    
    //write changes Back to DB trainings
    $statement2 = $pdo->prepare("UPDATE `challenges` SET `member` =:newEntry  WHERE `id` =:id");
    
    $statement2->bindParam(":id", $challengeId);
    $statement2->bindParam(":newEntry", $newEntry);

    $statement2->execute();
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  die();
}


header("Location: ../challenges.php");
die();
}
?>