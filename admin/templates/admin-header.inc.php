<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
   <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/index.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">

    <title>Admin Bereich</title>

  </head>

<body class="bg-light">

<nav class="navbar navbar-light bg-light mb-4">
  <a class="btn btn-outline-transparent col-12" href="index.php">
    <img class="img-fluid" width="150" src="../../img/Icon192.png" alt="Company-Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a id="uhr"></a>
  <a id="datum"><?php echo date("d.m.Y"); ?></a>
  <a class="navbar-brand" href="index.php">Admin Bereich</a>

  <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><a class="dropdown-item" href="index.php">Startseite</a></li>  
      <li class="nav-item active"><a class="dropdown-item" href="admin-member.php">Benutzereinträge</a></li>  
      <li class="nav-item active"><a class="dropdown-item" href="admin-training.php">Training erstellen</a></li>  
      <li class="nav-item active"><a class="dropdown-item" href="admin-training-edit.php">Trainings</a></li>  
      <li class="nav-item active"><a class="dropdown-item" href="admin-abos.php">Abos</a></li>  
      <li class="nav-item active"><a class="dropdown-item" href="admin-messages.php">Kontaktanfragen</a></li>
      <li class="nav-item active"><a class="dropdown-item" href="challenge.php">Challenge erstellen</a></li>
      <li class="nav-item active"><a class="dropdown-item" href="challenge-results.php">Challenges Ergebnisse</a></li>    
    </ul>
  </div>
</nav>

  