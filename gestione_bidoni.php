<?php

  // connessione
  require_once "server/connection.php";

  // gestione degli eventi
  $richiestaDialogo = false;

  // ottenimento della lista delle varie locazioni
  $sql_loc = "SELECT pkID, Descrizione FROM tblLocazione;";
  $result_loc = $connessione->query($sql_loc);

  // ottenimento della lista delle varie tipologie di rifiuto
  $sql_tip = "SELECT DISTINCT TipoRifiuti FROM tblBidone;";
  $result_tip = $connessione->query($sql_tip);

  if(isset($_GET['selection'])) {

    if($_GET['selection']=='modify'){

      // modifica del bidone
      $richiestaDialogo = true;
      //print"<script>window.location = 'modify/Modify.php?page=Location&location=".$_GET['location']."'</script>";


    }else if($_GET['selection']=='delete'){

      // eliminazione del bidone
      print"<script>window.location = 'server/delete.php?tipo=bidone&id=".$_GET['id']."'</script>";


    }else if($_GET['selection']=='add'){

      // aggiunta del bidone
      print"<script>window.location = 'server/add.php?tipo=bidone&rifiuto=".$_GET['rifiuto']."&locazione=".$_GET['locazione']."'</script>";

    }

  }

  // ottenimento dei dati per la popolazione della tabella
  $sql = "SELECT tblBidone.pkID, TipoRifiuti, Descrizione FROM tblBidone INNER JOIN tblLocazione ON tblBidone.fkLocazione=tblLocazione.pkID;";
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
        <form action="gestione_bidoni.php" method="get">
          <input type="hidden" name="selection" value="add">
          <div class="input-group mb-3 mt-3">
            <label class="input-group-text" for="inputGroupSelect01">Tipologia del rifiuto</label>
            <select class="form-select" id="inputGroupSelect01" name="rifiuto">
              <option selected>Nessuna tipologia selezionata...</option>
              <?php

                // generazione della lista delle locazioni
                while ($tipologia = $result_tip->fetch_assoc()) {
                  print "<option value=\"".$tipologia['TipoRifiuti']."\">".$tipologia['TipoRifiuti']."</option>";
                }
               ?>
            </select>

          </div>

          <div class="input-group mb-3 mt-3">
            <label class="input-group-text" for="inputGroupSelect01">Locazione del bidone</label>
            <select class="form-select" id="inputGroupSelect01" name="locazione">
              <option selected>Nessuna locazione selezionata...</option>
              <?php

                // generazione della lista delle locazioni
                while ($locazione = $result_loc->fetch_assoc()) {
                  print "<option value=\"".$locazione['pkID']."\">".$locazione['Descrizione']."</option>";
                }
               ?>
            </select>
          </div>

          <div class="d-flex flex-row-reverse mb-3">
            <button type="button" class="btn btn-primary" onclick="this.form.submit()">Aggiungi un nuovo bidone</button>
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
              </tr>
            </thead>

            <tbody>

              <?php

                // popolazione della tabella
                while ($bidone = $result->fetch_assoc()) {
                  print "<tr>";

                  print "<th>".$bidone['pkID']."</th>"; // id

                  print "<th>";
                  print "<p>".$bidone['TipoRifiuti']."</p>"; // descrizione
                  print "<small class=\"text-muted\">Situato in ".$bidone['Descrizione']."</small>"; // posizione
                  print "</th>";

                  print '<th><a href="gestione_bidoni.php?selection=modify&id='.$bidone['pkID'].'&locazione='.$bidone['Descrizione'].'&tipo='.$bidone['TipoRifiuti'].'"><button type="button" class="btn btn-outline-primary">Modifica</button></a></th>';
                  print '<th><a href="gestione_bidoni.php?selection=delete&id='.$bidone['pkID'].'"><button type="button" class="btn btn-outline-danger">Elimina</button></a></th>';

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
            <h5 class="modal-title" id="exampleModalLongTitle">Modifica il bidone</h5>
          </div>
          <form action="server/modify.php" method="get">
            <div class="modal-body">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Nessuna locazione selezionata...</option>
                  <?php

                    // generazione della lista delle locazioni
                    while ($locazione = $result_loc->fetch_assoc()) {
                      print "<option value=\"".$locazione['pkID']."\">".$locazione['Descrizione']."</option>";
                    }
                  ?>
                </select>
                <select class="form-select" id="inputGroupSelect01" name="rifiuto">
                  <option selected>Nessuna tipologia selezionata...</option>
                  <?php

                    // generazione della lista delle locazioni
                    while ($tipologia = $result_tip->fetch_assoc()) {
                      print "<option value=\"".$tipologia['TipoRifiuti']."\">".$tipologia['TipoRifiuti']."</option>";
                    }
                  ?>
                </select>
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
