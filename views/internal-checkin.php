<?php 
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

//check user and get his ID
$user = check_user();
//get variable trainingid
$trainingid = $_GET['trainingid'];

try {
    //get Data out of DB training and compare
    $statement = $pdo->prepare("SELECT * FROM `trainings` WHERE `id` =:trainingid");
    $statement->bindParam(":trainingid", $trainingid);
    $statement->execute();
    $newlogin = $statement->fetch();

    $max_member = $newlogin['max_member'];
    $member_log = $newlogin['member_log'];

    //store value if NULL, member_log
    if ($member_log == NULL) {
      $member_log = 0;
    }

    //check if maxmember is reached and stop
    if ($member_log >= $max_member) {
      header("Location: ../internal.php");
      die();
    }

    //increment member_log + 1
    $member_log++;

    //check if user has 10x Abo, if True decrease -1 and write back to DB users
    if (!empty($user['10x_abo']) || $user['10x_abo'] > 0) {
      $aboTen = $user['10x_abo'];
      $aboTen--;
      $statement3 = $pdo->prepare("UPDATE `users` SET `10x_abo` =:10x_abo,
                                                      `updated_at` =NOW() 
                                                       WHERE id = :id");

      $statement3->bindParam(":id", $user["id"]);
      $statement3->bindParam(":10x_abo", $aboTen);
      
      $statement3->execute();
    }


    //get member array and convert to string
    $member = json_decode($newlogin['member']);
    //check if array is empty, false = create empty array
    if(empty($member)) {
      $member = [];
    }

    //merge array with new user and store it to string
    $newmember = json_encode(array_merge(array($user["id"]), $member));

    
    //write changes Back to DB trainings
    $statement2 = $pdo->prepare("UPDATE `trainings` SET `id` =:id,
                                                        `max_member` =:maxMember,
                                                        `member_log` =:memberLog,
                                                        `member` =:newmember  WHERE `id` =:id");
    
    $statement2->bindParam(":id", $trainingid, PDO::PARAM_STR);
    $statement2->bindParam(":maxMember", $max_member, PDO::PARAM_INT);
    $statement2->bindParam(":memberLog", $member_log, PDO::PARAM_INT);
    $statement2->bindParam(":newmember", $newmember, PDO::PARAM_STR);

    $statement2->execute();
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  die();
}


header("Location: ../internal.php");
die();
?>
