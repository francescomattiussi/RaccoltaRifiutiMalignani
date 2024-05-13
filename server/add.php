<?php

  // connessione
  require_once "connection.php";

  // aggiunta locazione
  if($_GET['tipo'] == 'locazione' && isset($_GET['descrizione'])){
    $sql = "INSERT INTO tblLocazione values (null,'".$_GET['descrizione']."')";
    $result = $connessione->query($sql);

    print"<script>window.location = '../gestione_locazioni.php'</script>";

  } else if ($_GET['tipo'] == 'bidone' && isset($_GET['rifiuto']) && isset($_GET['locazione'])){

    // aggiunta del bidone
    $sql = "INSERT INTO tblBidone values (null,'".$_GET['rifiuto']."', '".$_GET['locazione']."')";
    $result = $connessione->query($sql);

    print"<script>window.location = '../gestione_bidoni.php'</script>";
  }

 ?>
