<?php

  // connessione
  require_once "connection.php";

  // eliminazione locazione
  if($_GET['tipo'] == 'locazione' && isset($_GET['id'])){
    $sql = "DELETE FROM tblLocazione WHERE pkID=".$_GET['id'].";";
    $result = $connessione->query($sql);

    print"<script>window.location = '../gestione_locazioni.php'</script>";
  }

 ?>
