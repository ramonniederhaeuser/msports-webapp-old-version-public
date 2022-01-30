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

    $statement = $pdo->prepare("UPDATE users SET `updated_at` =NOW(),
                                                 `10x_abo` =:10x_abo
                                                  WHERE id = :id");  

    $statement->bindParam(":id", $id);
    $statement->bindParam(":10x_abo", $_POST['10x_abo']);

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