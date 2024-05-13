<?php

  // connessione
  require_once "connection.php";

  // aggiunta locazione
  if($_GET['tipo'] == 'locazione' && isset($_GET['descrizione']) && isset($_GET['id'])){
    $sql = "UPDATE tblLocazione SET Descrizione='".$_GET['descrizione']."' WHERE pkID=".$_GET['id'].";";
    $result = $connessione->query($sql);

    print"<script>window.location = '../gestione_locazioni.php'</script>";
  }

 ?>
