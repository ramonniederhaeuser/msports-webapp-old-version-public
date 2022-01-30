<?php 
session_start();
require_once("../../shared/inc/config.inc.php");
require_once("../../shared/inc/functions.inc.php");

$id = $_GET["id"];

$statement = $pdo->prepare("SELECT * FROM `users` WHERE `id` =:id");
$statement->bindParam(":id" , $id);
$statement->execute();
$user = $statement->fetch();

  try {
    if(!empty($_POST)) {

      if (empty($_POST['abo_expiring_date'])) {
        header("Location: ../admin-abos.php");
      }

    $statement = $pdo->prepare("UPDATE users SET `updated_at` =NOW(),
                                                 `abo_expiring_date` =:abo_expiring_date
                                                  WHERE id = :id");  

    $statement->bindParam(":id", $id);
    $statement->bindParam(":abo_expiring_date", $_POST['abo_expiring_date']);

    $statement->execute();
    }
  }
  catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    die();
  }
  header("Location: ../admin-abos.php");
  die();
?>