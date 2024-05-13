
<!-- --------------------------------------- INSTAURAZIONE CONNESSIONE --------------------------------------------------- -->
<?php require_once "../server/connection.php";?>

<!-- ---------------------------------- Gestione della scelta ----------------------------------------------------- -->    
<?php
  if(isset($_GET['selection'])){

      //----Modifica-------------------------------------
    if($_GET['selection']=='modify'){
      print"<script>window.location = 'Modify/Modify.php?page=Bidone&bidone=".$_GET['bidone']."'</script>";

      //----Elimina-------------------------------------
    }else if($_GET['selection']=='delete'){
        //Eliminazione Svuotamenti
      $sql = "DELETE FROM tblSvuotamento WHERE fkBidone=".$_GET['bidone'].";";
      $result = $connessione->query($sql);
        //Eliminazione Bidone
      $sql = "DELETE FROM tblBidone WHERE pkID=".$_GET['bidone'].";";
      $result = $connessione->query($sql);

      //----Aggiungi-------------------------------------
    }else if($_GET['selection']=='add'){
      print"<script>window.location = 'add/Add.php?page=Bidone'</script>";
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
          <th scope="col">Numero Identificativo</th><th scope="col">Tipo Rifiuti</th><th scope="col">Locazione</th>
          <th scope="col"></th><th scope="col"></th>
        </tr></thead>

          <!-- Righe in mezzo ------------------------------------------------------------------- -->
        <?php
          $sql = "SELECT tblBidone.pkID, TipoRifiuti, Descrizione FROM tblBidone INNER JOIN tblLocazione ON tblBidone.fkLocazione=tblLocazione.pkID";
          $result = $connessione->query($sql);
          while($row = $result->fetch_assoc()){
              //Codice e Descrizione
            print "<tr><th scope='row'>".$row['pkID']."</th><td>".$row['TipoRifiuti']."</td><td>".$row['Descrizione']."</td><td>";
              //Modifica
            print "<a href='EditBidone.php?selection=modify&bidone=".$row['pkID']."' class='d-grid gap-2 col-6 mx-auto'>";
            print "<button type='button' class='btn btn-secondary btn-lg'>Modifica</button></a>";
            print "</td><td>";
              //Elimina
            print "<a href='EditBidone.php?selection=delete&bidone=".$row['pkID']."' class='d-grid gap-2 col-6 mx-auto'>";
            print "<button type='button' class='btn btn-danger btn-lg'>Elimina</button></a>";
            print "</td></tr>";
          }
        ?>

          <!-- Ultima Riga --------------------------------------------------------------------- -->
        <tr>
          <td></td><td></td><td></td><td></td><td>
            <a href='EditBidone.php?selection=add' class='d-grid gap-2 col-6 mx-auto'>
              <button type='button' class='btn btn-secondary btn-lg'>Aggiungi</button>
            </a>
          </td>
        </tr>


      </table>
    </div

  </body>
</html>