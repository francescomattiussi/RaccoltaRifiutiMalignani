
<!-- --------------------------------------- INSTAURAZIONE CONNESSIONE --------------------------------------------------- -->
<?php
  include "../../server/connection.php";

//------------------------------------- Modify Location ---------------------------------------------------------------
  if(isset($_GET['descrizione'])){
    $sql = "UPDATE tblLocazione SET Descrizione='".$_GET['descrizione']."' WHERE pkID=".$_GET['location'].";";
    $result = $connessione->query($sql);
    //header("location: ../EditLocation.php");
    print"<script>window.location = '../EditLocation.php'</script>";
  }
//------------------------------------- Modify Bidone ---------------------------------------------------------------
  if(isset($_GET['fkLocazione'])){
    $sql = "UPDATE tblBidone SET tipoRifiuti='".$_GET['tipoRifiuti']."', fkLocazione=".$_GET['fkLocazione']." WHERE pkID=".$_GET['bidone'].";";
    $result = $connessione->query($sql);
    //header("location: ../EditBidone.php");
    print"<script>window.location = '../EditBidone.php'</script>";
  }

  // acquisizione dettagli bidone selezionato, se l'elemento da modificare è un bidone

  if (isset($_GET['bidone'])) {
    $idBidone = $_GET['bidone'];

    $query = "SELECT tblBidone.TipoRifiuti, tblLocazione.Descrizione FROM tblBidone INNER JOIN tblLocazione ON tblBidone.fkLocazione=tblLocazione.pkID WHERE tblBidone.pkID = $idBidone";
    $dettagliBidone = $connessione->query($query)->fetch_assoc();

    $tipologia = $dettagliBidone['TipoRifiuti'];
    $punto = $dettagliBidone['Descrizione'];
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
    ?>

<!-- -------------------------------------- Location o Bidone ------------------------------------- -->
    <div class="container"><br><br>
      <?php
        if(isset($_GET['page'])){
          if($_GET['page']=='Location'){
            $_SESSION['add']='Location';
            $_SESSION['location']=$_GET['location'];
          }else if($_GET['page']=='Bidone'){
            $_SESSION['add']='Bidone';
            $_SESSION['bidone']=$_GET['bidone'];
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