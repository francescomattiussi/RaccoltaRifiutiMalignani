<?php include "../server/connection.php"; ?>
<html>
  <head>
    <title>Rifiuti</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Background Image -->
    <style>
      body {background-image: url('image.jpg');background-repeat: no-repeat; background-size: cover;}
      .container-testo {

      }
    </style>
  </head>
  <body>

<!-- ----------------------------------- Navbar ------------------------------------------------ -->
    <?php

//Inserimento delle variabili di reindirizzamento navbar
      $_SESSION['navbar_home']=     '../index.php';
      $_SESSION['navbar_stats']=    '../Statistiche/indexStats.php';
      $_SESSION['navbar_emptying']= '../Emptying/indexEmptying.php';
      $_SESSION['navbar_location']= '../LocationChange/indexLocation.php';
      $_SESSION['navbar_login']=    'login/login.php';
      $_SESSION['navbar_aboutUs']=  'aboutUs.php';

//Include navbar.php
      include "navbar.php";
    ?>

    <br>
    <br>
    <div class="gx-5 container w-75">
      <div class="card text-dark bg-light mb-3 px-3 py-3 shadow ">
        <br>
        <h1 class="text-center h4 text-gray-900 mb-4">About Us</h1>
        <br>
        <p>Questo sito si presenta con lo scopo di gestire la raccolta dei rifiuti all’interno della scuola. Permette, quindi, di:</p>
        <ul>
          <li>Registrare lo svuotamento di ciascun bidone presente nell’istituto. Per comodità dell’utente, ogni zona sarà fornita di un codice QR che, una volta scansionato, rimanderà alla rispettiva pagina della zona con elencati i rispettivi bidoni. Da lì si potranno selezionare i cestini svuotati e indicare per ciascuno la percentuale di rifiuti presente in esso. Alla fine del processo, lo svuotamento verrà registrato in un apposito database.</li>
          <li>Modificare o eliminare, per ciascuna zona, i bidoni presenti.</li>
          <li>Quindi modificare i dati in ciascuna zona</li>
          <li>Visualizzare i dati raccolti. Attraverso una pagina apposita, si potranno visualizzare i dati ottenuti per mezzo di vari grafici per rendere più comprensibile la lettura delle variazioni. I grafici comprenderanno, quindi:</li>
          <ul>
            <li>Un grafico sull’affluenza, che illustra le probabilità di riempimento in base alla fascia oraria selezionata</li>
            <li>Un grafico a istogramma che illustra le differenze tra l’anno precedente e quello corrente</li>
            <li>Inoltre, sarà presente una tabella oraria degli svuotamenti</li>
          </ul>
        </ul>
        <p>Le operazioni di inserimento dei dati, modifica dei bidoni e modifica dei dettagli delle locazioni sono protette da login, sarà quindi necessario essere provvisti delle credenziali e dei relativi permessi. Un utente con privilegi standard potrà registare lo svuotamento dei bidoni, mentre un utente con privilegi d'amministratore potrà accedere alle opzioni di modifica ed eliminazione delle zone, e quindi dei relativi bidoni. La possibilità di visualizzare i dati raccolti, quindi i grafici, è invece permessa a chiunque, senza bisogno di effettuare l’accesso.</p>
        <p><i>Questo sito è stato realizzato da Ray Guzzo, Nicholas Comino e Francesco Mattiussi della 4TEL D</i></p>
      </div>
    </div>
  </body>
</html>

