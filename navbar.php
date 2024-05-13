<?php
   // connessione
  require_once "server/connection.php";

  session_start();

  $accessoSessione = false;
  $accessoCookie = false;

  $id = "";
  $nome = "";


  // controllo dell'accesso in sessione
  if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $accessoSessione = true;
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];

  } else if (isset($_COOKIE['user_id'])) {
    $accessoCookie = true;
    $id = $_COOKIE['user_id'];
    $nome = $_COOKIE['user_name'];
  }

  // procedura di logout
  if (isset($_GET['logout'])) {

    // eliminazione dei dati in sessione
    $_SESSION['id'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['ruolo'] = "";

    // eliminazione dei cookie
    setcookie("user_id", "", time() - 3600, "/");
    setcookie("user_name", "", time() - 3600, "/");

    print "<script>window.location = '../index.php'</script>";
  }
 ?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="contenuti/logo.png" alt="" height="24" class="d-inline-block align-text-top">
      Raccolta Rifiuti
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Svuota un cestino</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestione
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="gestione_bidoni.php">Gestione dei bidoni</a></li>
            <li><a class="dropdown-item" href="gestione_locazioni.php">Gestione delle locazioni</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="statistiche/indexStats.php">Statistiche</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">A proposito</a>
        </li>

      </ul>
      <div class="d-flex">
        <?php

          // se almeno una delle due opzioni di accesso è presente
          if ($accessoSessione == true || $accessoCookie == true) {
            print '<div class="input-group">';

            print '<input type="text" class="form-control" placeholder="Ciao, '.$nome.'" aria-describedby="button-addon2" readonly>';
            print '<a href="navbar.php?logout=logout"><button class="btn btn-outline-secondary" type="button" id="button-addon2">Esci</button></a>';

            print '</div>';
          } else {
            print '<a href="../login.php"><button class="btn btn-outline-secondary">Accedi</button></a>';
          }
         ?>
      </div>
    </div>
  </div>
</nav>
