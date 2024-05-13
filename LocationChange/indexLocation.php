
<!-- --------------------------------------- INSTAURAZIONE CONNESSIONE --------------------------------------------------- -->
<?php require_once "../server/connection.php";

// ----------------------------------------------------------- CONTROLLO LOGIN ----------------------------------------------
if(!isset($_SESSION['login'])){
  header("Location: ../Multimedia/login/login.php");
  // print "hey";
}

?>

<html>
  <head>
    <title>Rifiuti</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Background Image -->
    <style>
      body {background-image: url('../Multimedia/image.jpg');background-repeat: no-repeat; background-size: cover;}
    </style>
  </head>
  <body>


<!-- ----------------------------------- Navbar ------------------------------------------------ -->
<?php

//Inserimento delle variabili di reindirizzamento navbar
  $_SESSION['navbar_home']=     '../index.php';
  $_SESSION['navbar_stats']=    '../Statistiche/indexStats.php';
  $_SESSION['navbar_emptying']= '../Emptying/indexEmptying.php';
  $_SESSION['navbar_location']= 'indexLocation.php';
  $_SESSION['navbar_login']=    '../Multimedia/login/login.php';
  $_SESSION['navbar_aboutUs']=  '../Multimedia/aboutUs.php';

//Include navbar.php
  include "../Multimedia/navbar.php";
?>

<!-- --------------------------------------- Choice ------------------------------------------------------------ -->

    <br><br>
    
    <a href="EditLocation.php" class="d-grid gap-2 col-6 mx-auto">
      <button type="button" class="btn btn-primary btn-lg">Modifica/Elimina Locazione</button>
    </a><br>

    <a href="EditBidone.php" class="d-grid gap-2 col-6 mx-auto">
      <button type="button" class="btn btn-secondary btn-lg">Modifica/Elimina Bidone</button>
    </a>
    


  </body>
</html>