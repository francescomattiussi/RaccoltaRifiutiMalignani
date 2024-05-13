<?php

  // connessione
  require_once "connection.php";

  // dove slider_bidone è la percentuale e bidone_selezionato è l'id del bidone
  if (!empty($_POST['slider_bidone']) && !empty($_POST['bidone_selezionato'])) {

    $bidoniSvuotati = 0;

    foreach (array_combine($_POST['bidone_selezionato'], $_POST['slider_bidone']) as $bidone_selezionato => $percentuale) {

      // assembla il record da registrare
      date_default_timezone_set("Europe/Rome");
      $data = "'".date("Y-m-d h:i:s")."'";
      $id = $_SESSION['id']; // id dell'utente in sessione

      $query = "INSERT INTO tblSvuotamento VALUES (NULL, $data, $percentuale, $bidone_selezionato, $id)";
      //echo $query;
      $risultato = mysqli_query($connessione, $query);
      $bidoniSvuotati = $bidoniSvuotati + 1;

      header("Location: ../index.php?successo=".$bidoniSvuotati);
    }

  }

 ?>
