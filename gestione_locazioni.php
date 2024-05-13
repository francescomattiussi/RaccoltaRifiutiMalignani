<?php

  // connessione
  require_once "server/connection.php";

  // gestione degli eventi
  $richiestaDialogo = false;

  if(isset($_GET['selection'])) {

    if($_GET['selection']=='modify'){

      // modifica della locazione
      $richiestaDialogo = true;
      //print"<script>window.location = 'modify/Modify.php?page=Location&location=".$_GET['location']."'</script>";


    }else if($_GET['selection']=='delete'){

      // eliminazione della locazione
      print"<script>window.location = 'server/delete.php?tipo=locazione&id=".$_GET['id']."'</script>";


    }else if($_GET['selection']=='add'){

      // aggiunta della locazione
      print"<script>window.location = 'server/add.php?tipo=locazione&descrizione=".$_GET['descrizione']."'</script>";

    }

  }

  // ottenimento dei dati per la popolazione della tabella
  $sql = "SELECT * FROM tblLocazione;";
  $result = $connessione->query($sql);
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
    <?php include "navbar.php";

    if ($accessoSessione == false && $accessoCookie == false) {
      print "<script>window.location = 'login.php'</script>";
    }
    ?>

    <div class="container-md d-flex justify-content-center mx-auto my-3 flex-column">
      <div class="border border-1 rounded px-3">
        <form action="gestione_locazioni.php" method="get">
          <div class="input-group mb-3 mt-3">
            <input type="hidden" name="selection" value="add">
            <input type="text" name="descrizione" class="form-control" placeholder="Inserisci una nuova locazione" aria-label="Inserisci una nuova locazione" aria-describedby="button-addon2">
            <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="this.form.submit()">Inserisci</button>
          </div>
        </form>
      </div>
    </div>

    <div class="container-md d-flex justify-content-center mx-auto my-3 flex-column">
      <div class="border border-1 rounded px-3">
        <div class="table-responsive">
          <table class="table table-responsive-md table-bordered mt-3">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col" class="w-100">Descrizione</th>
                <th scope="col">Azioni</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody>

              <?php

                // popolazione della tabella
                while ($locazione = $result->fetch_assoc()) {
                  print "<tr>";

                  print "<th>".$locazione['pkID']."</th>"; // id
                  print "<th>".$locazione['Descrizione']."</th>"; // descrizione

                  print '<th><a href="gestione_locazioni.php?selection=modify&id='.$locazione['pkID'].'&descrizione='.$locazione['Descrizione'].'"><button type="button" class="btn btn-outline-primary">Modifica</button></a></th>';
                  print '<th><a href="gestione_locazioni.php?selection=delete&id='.$locazione['pkID'].'"><button type="button" class="btn btn-outline-danger">Elimina</button></a></th>';
                  print '<th><a href="https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl=http://www.camminidigitali.it/index.php?puntiRaccolta='.$locazione['pkID'].'" download="'.$locazione['pkID'].'.png"><button type="button" class="btn btn-outline-secondary text-nowrap">Genera QR</button></a></th>';

                  print "</tr>";
                }
               ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modifica la locazione</h5>
          </div>
          <form action="server/modify.php" method="get">
            <div class="modal-body">
              <input type="text" class="form-control" name="descrizione"
              <?php
                if ($richiestaDialogo == true) {
                  print 'value="'.$_GET['descrizione'].'" ';
                }
               ?>
               placeholder="Inserisci una nuova descrizione">
               <input type="hidden" name="tipo" value="locazione">
               <input type="hidden" name="id" value="<?php print $_GET['id']; ?>">
            </div>
            <div class="modal-footer">
              <a href="gestione_locazioni.php"><button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button></a>
              <button type="button" class="btn btn-primary" onclick="this.form.submit()">Salva modifiche</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php
      if ($richiestaDialogo == true) {

        // viene aperta la finestra di modifica
        print '<script>
                jQuery(document).ready(function () {
                  jQuery(\'#exampleModalCenter\').modal(\'toggle\');
                });
              </script>';
      }
     ?>
  </body>
</html>
