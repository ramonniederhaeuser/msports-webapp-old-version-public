<?php

//Database variables

//Localhost

// $db_host = 'localhost';
// $db_name = 'msports';
// $db_user = 'admin';
// $db_password = 'admin1admin2';

//ofunibuz

$db_host = '**';
$db_name = '**';
$db_user = '**';
$db_password = '**';

try {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  //set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //create table for user login
  $sql = "CREATE TABLE IF NOT EXISTS `users` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
    `email` VARCHAR(255) NOT NULL ,
    `passwort` VARCHAR(255) NOT NULL ,
    `vorname` VARCHAR(255) NOT NULL DEFAULT '' ,
    `nachname` VARCHAR(255) NOT NULL DEFAULT '' ,
    `geburtstag` DATE NULL,
    `geschlecht` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `abo_expiring_date` DATE NULL ,
    `10x_abo` INT NULL ,
    PRIMARY KEY (`id`), UNIQUE (`email`)
  ) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

  //use exec () because no results are returned
  $pdo->exec($sql);

  //create table for trainings
  $sql2 = "CREATE TABLE IF NOT EXISTS `trainings` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
    `info` TEXT NOT NULL ,
    `date` DATE NOT NULL ,
    `time` TIME NOT NULL ,
    `max_member` INT(255) NOT NULL ,
    `member_log` INT(255) NULL ,
    `member` VARCHAR(1023) NULL ,
    PRIMARY KEY (`id`) 
  ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  //use exec () because no results are returned
  $pdo->exec($sql2);

  //create table for challenges
  $sql2 = "CREATE TABLE IF NOT EXISTS `challenges` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
    `info` TEXT NULL ,
    `member` VARCHAR(1023) NULL ,
    `evaluation` VARCHAR(1023) NOT NULL ,
    `videolink` VARCHAR(1023) NULL ,
    PRIMARY KEY (`id`) 
  ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  //use exec () because no results are returned
  $pdo->exec($sql2);

  //create table for challenge Ranking
  $sql3 = "CREATE TABLE IF NOT EXISTS `challengeRankings` ( 
    `id` INT NOT NULL,
    `resultsMen` VARCHAR(1023) NULL ,
    `resultsWomen` VARCHAR(1023) NULL ,
    PRIMARY KEY (`id`) 
  ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  //use exec () because no results are returned
  $pdo->exec($sql3);



  //auomatic delete old trainings
  $sql4 = "DELETE FROM `trainings` WHERE `date` < DATE_SUB(NOW(), INTERVAL 1 DAY)";
  $pdo->exec($sql4);
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
