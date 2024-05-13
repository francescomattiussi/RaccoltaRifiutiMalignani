<!-- --------------------------------------- INSTAURAZIONE CONNESSIONE --------------------------------------------------- -->
<?php 
  require_once "../server/connection.php";
?>
<!-- ---------------------------------- Gestione della scelta ----------------------------------------------------- -->    
<?php
  if(isset($_GET['selection'])) {

      //----Modifica-------------------------------------
    if($_GET['selection']=='modify'){
      //header("location: modify/Modify.php?page=Location&location=".$_GET['location']);
      print"<script>window.location = 'modify/Modify.php?page=Location&location=".$_GET['location']."'</script>";

      //----Elimina-------------------------------------
    }else if($_GET['selection']=='delete'){
      $sql = "DELETE FROM tblLocazione WHERE pkID=".$_GET['location'].";";
      $result = $connessione->query($sql);

      //----Aggiungi-------------------------------------
    }else if($_GET['selection']=='add'){
      //header("Location: add/Add.php?page=Location");
      print"<script>window.location = 'add/Add.php?page=Location'</script>";

    } else if($_GET['selection']=='qr'){
      // genera qr
      include('phpqrcode/qrlib.php');
      $location = $_GET['location'];

      $url = "http://localhost/05-rifiuti/visualizzaLocazione.php?codice=".$location;
      $cartella = "../codici/";
      $file_name = $location.'.png';
      $file_name = $cartella.$file_name;
      QRcode::png($url, $file_name);
    }
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

<!-- --------------------------------------- Tabella ------------------------------------------------------------ -->
    
    <div class="container-fluid w-75 p-3">
      <br><br>
      <table class="table table-primary">

          <!-- Prima Riga ----------------------------------------------------------------------- -->
        <thead><tr class="table-secondary">
          <th scope="col">Numero Identificativo</th><th scope="col">Descrizione</th>
          <th scope="col">Azioni</th><th scope="col"></th><th scope="col"></th>
        </tr></thead>

          <!-- Righe in mezzo ------------------------------------------------------------------- -->
        <?php
          $sql = "SELECT * FROM tblLocazione;";
          $result = $connessione->query($sql);
          while($row = $result->fetch_assoc()){
              //Codice e Descrizione
            print "<tr><th scope='row'>".$row['pkID']."</th><td>".$row['Descrizione']."</td><td>";
              //Modifica
            print "<a href='EditLocation.php?selection=modify&location=".$row['pkID']."' class='d-grid gap-2 col-6 mx-auto'>";
            print "<button type='button' class='btn btn-secondary btn-lg'>Modifica</button></a>";
            print "</td><td>";
              //Elimina
            print "<a href='EditLocation.php?selection=delete&location=".$row['pkID']."' class='d-grid gap-2 col-6 mx-auto'>";
            print "<button type='button' class='btn btn-danger btn-lg'>Elimina</button></a>";
            print "</td><td>";

            // genera qr
            print "<a href='EditLocation.php?selection=qr&location=".$row['pkID']."' class='d-grid gap-2 col-6 mx-auto'>";
            print "<button type='button' class='btn btn-secondary btn-lg'>Genera QR</button></a>";
            print "</td></tr>";
          }
        ?>

          <!-- Ultima Riga --------------------------------------------------------------------- -->
        <tr>
          <td></td><td></td><td></td><td>
            <a href='EditLocation.php?selection=add' class='d-grid gap-2 col-6 mx-auto'>
              <button type='button' class='btn btn-secondary btn-lg'>Aggiungi</button>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>