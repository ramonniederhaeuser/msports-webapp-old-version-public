<?php
session_start();
require_once("../shared/inc/config.inc.php");
require_once("../shared/inc/functions.inc.php");

include("templates/admin-header.inc.php")
?>

<!--search form-->
<div class="container mt-5">
  <form action="admin-abos.php" method="post">
    <input type="text" name="aboSearchBox" class="form-control" placeholder="suchbegriff *">
    <button class="btn btn-primary mt-2">Suchen</button>
  </form>
</div>
<?php
//post variable from search input field to var
$aboSearchInput = $_POST['aboSearchBox'];
//if null or empty string then load all users
if (empty($_POST) || $_POST['aboSearchBox'] == "") {
  $statement = $pdo->prepare("SELECT * FROM `users`");
  $statement->execute();
  $users = $statement->fetchAll();
}
//if not null or string !empty then filter
else {
  $statement2 = $pdo->prepare("SELECT * FROM `users` WHERE `vorname` =:aboSearchBox OR `nachname` =:aboSearchBox2");
  $statement2->bindParam(":aboSearchBox", $aboSearchInput);
  $statement2->bindParam(":aboSearchBox2", $aboSearchInput);
  $statement2->execute();
  $users = $statement2->fetchAll();
}
?>

<!--print site button-->
<div class="container">
  <a class="btn btn-warning mt-5 mb-5" href="javascript:self.print()">Seite ausdrucken</a>
</div>

<!--start foreach and create form for every instance-->
<?php
foreach ($users as $user) :
?>

  <div class="container border border-warning rounded mt-1">

    <form>

      <div class="form-group mt-4">
        <label for="inputID" class="font-weight-bold">User ID:</label>
        <input class="form-control" value="<?php echo $user["id"] ?>" type="text" id="inputID" name="vorname" readonly>
      </div>

      <div class="form-group">
        <label for="inputEmail" class="font-weight-bold">E-Mail:</label>
        <input class="form-control" value="<?php echo $user["email"] ?>" type="email" id="inputEmail" name="email" readonly>
      </div>

      <div class="form-group">
        <label for="inputVorname" class="font-weight-bold">Vorname:</label>
        <input class="form-control" value="<?php echo $user["vorname"] ?>" type="text" id="inputVorname" name="vorname" readonly>
      </div>

      <div class="form-group">
        <label for="inputNachname" class="font-weight-bold">Nachname:</label>
        <input class="form-control" value="<?php echo $user["nachname"] ?>" type="text" id="inputNachname" name="nachname" readonly>
      </div>

      <div class="form-group">
        <label for="inputNachname" class="font-weight-bold">Geburtsdatum:</label>
        <input class="form-control" value="<?php echo $user["geburtstag"] ?>" type="text" id="inputNachname" name="nachname" readonly>
      </div>

      <div class="form-group">
        <label for="inputCreated_at" class="font-weight-bold">Registriert am:</label>
        <input class="form-control" value="<?php echo $user["created_at"] ?>" type="text" id="inputCreated_at" name="created_at" readonly>
      </div>

      <div class="form-group">
        <label for="inputUpdated_at" class="font-weight-bold">Letzte änderung:</label>
        <input class="form-control" value="<?php echo $user["updated_at"] ?>" type="text" id="inputUpdated_at" name="updated_at" readonly>
      </div>

      <div class="form-group">
        <label for="inputAboExpiring" class="font-weight-bold">Abo Ablaufdatum:</label>
        <input class="form-control" value="<?php echo $user["abo_expiring_date"] ?>" type="text" id="inputAboExpiring" name="abo_expiring_date" readonly>
        <?php
        $expiringDate = $user["abo_expiring_date"];
        $dateNow = date("Y-m-d");
        //logic for checking days expired
        $origin = new DateTime($dateNow);
        $target = new DateTime($expiringDate);
        $interval = $origin->diff($target);

        //Check Abo expiring date and create alert
        if ($dateNow >= $expiringDate && !is_null($expiringDate)) {
          echo '<div class="alert alert-danger" role="alert">Abo seit ';
          echo ($interval->format('%a Tagen '));
          echo 'abgelaufen</div>';
        }
        if ($dateNow < $expiringDate) {
          echo '<div class="alert alert-success" role="alert">Abo aktuell, läuft in ';
          echo ($interval->format('%r%a Tagen '));
          echo 'ab</div>';
        }
        if (is_null($expiringDate)) {
          echo '<div class="alert alert-warning" role="alert">Kein Abo hinterlegt</div>';
        }
        ?>
      </div>

      <div class="form-group">
        <label for="input10xAbo" class="font-weight-bold">10er Abo:</label>
        <input class="form-control" value="<?php if (empty($user["10x_abo"]) || $user["10x_abo"] <= 0) {
                                              echo "Nein";
                                            } else {
                                              echo "Ja, noch " . $user["10x_abo"] . " Training übrig";
                                            } ?>" type="text" id="input10xAbo" name="10x_abo" readonly>
      </div>
    </form>
    <!--end form readonly-->

    <!--create new form, add 10x abo-->
    <form action="views/admin-10xabo.add.php?id=<?php echo $user["id"] ?>" method="post">
      <div class="form-group">
        <input value="<?php echo $user["10x_abo"] + 10 ?>" type="hidden" name="10x_abo">
      </div>
      <button type="submit" class="btn btn-warning">10er Abo hinzufügen</button>
    </form>

    <!--delete Button for 10x Abos-->
    <form action="views/admin-10xabo.delete.php?id=<?php echo $user["id"] ?>" method="post">
      <div class="form-group">
        <input value="0" type="hidden" name="10x_abo">
      </div>
      <button type="submit" class="btn btn-danger">10er Abo löschen</button>
    </form>

    <!--decrease 10x Abo -1-->
    <form action="views/admin-10xabo.delete1.php?id=<?php echo $user["id"] ?>" method="post">
      <div class="form-group">
        <input value="-1" type="hidden" name="10x_abo">
      </div>
      <button type="submit" class="btn btn-danger">10er Abo -1</button>
    </form>

    <!--create new form, add abo-->
    <form class="mt-3 mb-5" action="views/admin-abo.add.php?id=<?php echo $user["id"] ?>" method="post">
      <div class="form-group row container">
        <button type="submit" class="btn btn-primary mr-2">Abo hinzufügen: </button>
        <div>
          <input class="form-control" type="date" name="abo_expiring_date"></input>
        </div>
      </div>
    </form>

  </div>

  <!--endforeach-->
<?php endforeach ?>

<?php
include("templates/admin-footer.inc.php")
?>