<!-- --------------------------------------- INSTAURAZIONE CONNESSIONE --------------------------------------------------- -->
<?php
  require_once "../server/connection.php";
?>

<!-- ---------------------------------- Eliminazione ----------------------------------------------------- -->
<?php
  if(isset($_GET['selection'])){
    if($_GET['selection']=='delete'){
      $sql = "DELETE FROM tblSvuotamento WHERE pkID=".$_GET['id'].";";
      $result = $connessione->query($sql);
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
  $_SESSION['navbar_stats']=    'indexStats.php';
  $_SESSION['navbar_emptying']= '../Emptying/indexEmptying.php';
  $_SESSION['navbar_location']= '../LocationChange/indexLocation.php';
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
          <th scope="col">Numero Identificativo</th><th scope="col">Data e Ora</th>
          <th scope="col">Percentuale</th><th scope="col">Bidone</th>
          <th scope="col">Locazione</th><th scope="col">Utente</th>
          <th scope="col"></th>
        </tr></thead>

          <!-- Righe in mezzo ------------------------------------------------------------------- -->
        <?php
          $sql = "SELECT tblSvuotamento.pkID as ID, DataEOra, Percentuale, TipoRifiuti, Descrizione, nome  FROM tblSvuotamento
            INNER Join tblUtenti ON tblSvuotamento.fkUtente = tblUtenti.pkID
            INNER Join tblBidone ON tblSvuotamento.fkBidone = tblBidone.pkID
            INNER Join tblLocazione ON tblBidone.fkLocazione = tblLocazione.pkID
            ORDER BY DataEOra;";
          $result = $connessione->query($sql);
          while($row = $result->fetch_assoc()){
              //Colonne Svuotamento
            print "<tr><th scope='row'>".$row['ID']."</th><td>".$row['DataEOra']."</td><td>".
              $row['Percentuale']."</td><td>".$row['TipoRifiuti']."</td><td>".$row['Descrizione']."</td><td>".$row['nome']."</td><td>";
              //Elimina
            print "<a href='graficoSvuotamenti.php?selection=delete&id=".$row['ID']."' class='d-grid gap-2 col-6 mx-auto'>";
            print "<button type='button' class='btn btn-danger btn-lg'>Elimina</button></a>";
            print "</td></tr>";
          }
        ?>
      </table>
    </div>
  </body>
</html>
