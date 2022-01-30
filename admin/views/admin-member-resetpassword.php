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

    //Hash Password
    $passwort_hash = password_hash($_POST['passwort'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare("UPDATE users SET `passwort` =:passwort, 
                                                 `updated_at` =NOW() 
                                                  WHERE id = :id");  

    $statement->bindParam(":id", $id);
    $statement->bindParam(":passwort", $passwort_hash);

    $statement->execute();
    }
  }
  catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    die();
  }
  $notice = "Passwort erfolgreich zurückgesetzt zu 1234!";
  header("Location: ../admin-notice.php?notice=$notice");
  die();

?>