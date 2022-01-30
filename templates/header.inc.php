<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
   <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./css/index.min.css">

    <!--webmanifest-->
    <link rel="manifest" href="manifest.json">
    <!--IOS support-->
    <link rel="apple-touch-icon" href="./img/Icon100.png">
    <meta name="apple-mobile-webb-app-status-bar" content="olive">
    <!--theme color, wanted from lighthouse-->
    <meta name="theme-color" content="olive">

    <title>Msports Web App</title>

  </head>

<body class="bg-light">

  <div class="container">
    <nav class="navbar navbar-light bg-light justify-content-center">
      <a class="btn btn-outline-transparent col-12" href="index.php">
        <img class="img-fluid" width="150" src="img/Icon192.png" alt="Company-Logo">
      </a>
      <a class="btn btn-outline-transparent disabled col-4" id="uhr"></a>
      <button class="navbar-toggler mx-2" id="toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="btn btn-outline-transparent disabled col-4" id="datum"><?php echo date("d.m.Y"); ?></a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if(!is_checked_in()): ?>
        <ul class="navbar-nav mr-auto mt-3 bg-light text-center">
          <li class="nav-item active"><a href="index.php">Home</a></li>
          <li class="nav-item active"><a href="register.php">Registrieren</a></li>
        </ul>
      </div>
      <?php else: ?>
      <ul class="navbar-nav mr-auto mt-3 bg-light text-center">     
        <li class="nav-item active"><a class="nav-link" href="internal.php">Trainings</a></li>  
        <li class="nav-item active"><a class="nav-link" href="challenges.php">Challenges</a></li>
        <li class="nav-item active"><a class="nav-link" href="rankings.php">Ranglisten</a></li>
        <li class="nav-item active"><a class="nav-link" href="totalrankings.php">Gesamtrangliste</a></li>
        <li class="nav-item active"><a class="nav-link" href="abodata.php">Abo Daten</a></li>     
        <li class="nav-item active"><a class="nav-link" href="settings.php">Einstellungen</a></li>
        <li class="nav-item active"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul> 
      <?php endif; ?>
    </nav>
  </div>

  <!--start toggler event ends in footer section-->
  <div id="toggleEvent">
  