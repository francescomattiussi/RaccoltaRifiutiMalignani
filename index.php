<?php

  // connessione
  require_once "server/connection.php";

  // individuazione locazione
  $bidoniPerPunto = [];
  $nominativo = [];
  $parametroPunto = "";

  mysqli_select_db($connessione, "DBrifiuti");
  $queryPunti = "select * from tblLocazione";
  $risultatoPunti = mysqli_query($connessione, $queryPunti);

  // individuazione dei bidoni per il punto selezionato
  if (isset($_GET['puntiRaccolta']) && $_GET['puntiRaccolta'] != "null") {

    $parametroPunto = $_GET['puntiRaccolta'];
    $query = "select * from tblBidone where fkLocazione=".$_GET['puntiRaccolta'];
    $risultato = mysqli_query($connessione, $query);

    while ($riga = mysqli_fetch_array($risultato, MYSQLI_ASSOC)) {
      $bidone = [$riga['pkID'], $riga['TipoRifiuti'], $riga['fkLocazione']];
      array_push($bidoniPerPunto, $bidone);
    }
  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestione Rifiuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php

    include "navbar.php";

    if ($accessoSessione == false && $accessoCookie == false) {
      print "<script>window.location = 'login.php'</script>";
    }

    ?>

    <div class="container-md d-flex justify-content-center mx-auto my-3 flex-column">
      <form action="index.php" method="get">
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Seleziona una locazione</label>
            <select class="form-select" id="inputGroupSelect01" onchange="this.form.submit()" name="puntiRaccolta">
              <option selected>Nessun punto selezionato...</option>
              <?php
                while ($bidone = mysqli_fetch_array($risultatoPunti, MYSQLI_ASSOC)) {
                  if ($parametroPunto == $bidone['pkID']) {
                    print '<option value="'.$bidone['pkID'].'" selected>'.$bidone['Descrizione'].'</option>';
                  } else {
                    print '<option value="'.$bidone['pkID'].'">'.$bidone['Descrizione'].'</option>';
                  }

                }
               ?>
            </select>
        </div>
      </form>

      <?php
        if (isset($_GET['successo'])) {
          print '<div class="alert alert-success" role="alert">Svuotamento eseguito con successo!</div>';
        }
       ?>

      <?php
        if (isset($_GET['puntiRaccolta'])) {
          print '<div class="container border border-1 rounded">';
          print '<form action="server/svuotamento.php" method="post">';
          print '<div class="row">';

          foreach ($bidoniPerPunto as $bidone) {
            print '<div class="col-sm-6 mt-3">';
            print '<div class="card">';
            print '<div class="card-body">';

            print '<h5 class="card-title">'.$bidone[1].'</h5>'; // nome del bidone
            print '<h6 class="card-subtitle mb-2 text-muted">ID: '.$bidone[0].'</h6>'; // id del bidone
            print '<label for="customRange2" class="form-label">% svuotamento</label>';
            print '<input type="range" class="form-range" min="0" max="100" id="customRange2" name="slider_bidone[]">'; // slider del bidone
            print '<input type="hidden" name="bidone_selezionato[]" value="'.$bidone[0].'">'; // id del bidone da passare

            print '</div>';
            print '</div>';
            print '</div>';

          }

          print '</div>';

          print '<div class="d-flex justify-content-center my-3">';
          print '<button type="button" class="btn btn-primary" onclick="this.form.submit()">Registra svuotamento</button>';
          print '</div>';

          print '</form>';
          print '</div>';
        }
      ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
