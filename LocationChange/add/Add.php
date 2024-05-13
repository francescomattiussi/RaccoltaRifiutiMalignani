
<!-- --------------------------------------- INSTAURAZIONE CONNESSIONE --------------------------------------------------- -->
<?php
  include "../../server/connection.php";

  
  
//------------------------------------- Add Location ---------------------------------------------------------------
  if(isset($_GET['descrizione'])){
    $sql = "INSERT INTO tblLocazione values (null,'".$_GET['descrizione']."');";
    $result = $connessione->query($sql);
    //header("Location: ../EditLocation.php");
    print"<script>window.location = '../EditLocation.php'</script>";
  }

//------------------------------------- Add Bidone ---------------------------------------------------------------
  if(isset($_GET['tipoRifiuti'])){
    $sql = "INSERT INTO tblBidone values (null,'".$_GET['tipoRifiuti']."',".$_GET['fkLocazione'].");";
    $result = $connessione->query($sql);
    print"<script>window.location = '../EditBidone.php'</script>";
  }
?>

<html>
  <head>
    <title>Rifiuti</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Background Image -->
    <style>
      body {background-image: url('../../Multimedia/image.jpg');background-repeat: no-repeat; background-size: cover;}
    </style>
  </head>
  <body>

<!-- ----------------------------------- Navbar ------------------------------------------------ -->
    <?php

    //Inserimento delle variabili di reindirizzamento navbar
      $_SESSION['navbar_home']=     '../../index.php';
      $_SESSION['navbar_stats']=    '../../Statistiche/indexStats.php';
      $_SESSION['navbar_emptying']= '../../Emptying/client.php';
      $_SESSION['navbar_location']= '../indexLocation.php';
      $_SESSION['navbar_login']=    '../../Multimedia/login/login.php';
      $_SESSION['navbar_aboutUs']=  '../../Multimedia/aboutUs.php';

    //Include navbar.php
      include "../../Multimedia/navbar.php";
    ?><br><br><?php
//-------------------------------------- Location o Bidone ---------------------------------------------------------
        if(isset($_GET['page'])){
          if($_GET['page']=='Location'){
            $_SESSION['add']='Location';
          }else if($_GET['page']=='Bidone'){
            $_SESSION['add']='Bidone';
          }
        }
        if($_SESSION['add']=='Location'){
          require "location.php";
        }else if($_SESSION['add']=='Bidone'){
          require "bidone.php";
        }
      ?>
    </div>
  </body>
</html>