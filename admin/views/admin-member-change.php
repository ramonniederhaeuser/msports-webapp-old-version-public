<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

$id = $_GET["id"];

$statement = $pdo->prepare("SELECT * FROM `users` WHERE `id` =:id");
$statement->bindParam(":id" , $id);
$statement->execute();
$user = $statement->fetch();

if ($user["vorname"] == $_POST['vorname'] &&
    $user["nachname"] == $_POST['nachname'] &&
    $user["email"] == $_POST['email']) {
      $notice = "Keine änderung festgestellt!";
      header("Location: ../admin-notice.php?notice=$notice");
      die();
}
else {
  try {
    if(!empty($_POST)) {

    $statement = $pdo->prepare("UPDATE users SET `vorname` =:vorname, 
                                                 `nachname` =:nachname, 
                                                 `email` =:email,
                                                 `updated_at` =NOW() 
                                                  WHERE id = :id");  

    $statement->bindParam(":id", $id);
    $statement->bindParam(":vorname", $_POST['vorname']);
    $statement->bindParam(":nachname", $_POST['nachname']);
    $statement->bindParam(":email", $_POST['email']);

    $statement->execute();
    }
  }
  catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    die();
  }
  header("Location: ../admin-member.php");
  die();
}
?>
