<?php
    require_once "../server/connection.php";

    $bidoni = [];
    $locazioni = [];
    $percentuali = [];

    $colori = [];

    $label_loc = [];
    $colore_loc = [];

    $query = "select TipoRifiuti, fkLocazione, Descrizione from tblBidone inner join tblLocazione on tblBidone.fkLocazione = tblLocazione.pkID order by fkLocazione";
    $risultato_bid = mysqli_query($connessione, $query);
    $locazione_cached = "";

    while ($bidone = mysqli_fetch_array($risultato_bid, MYSQLI_ASSOC)) {
        array_push($bidoni, $bidone);


        if ($bidone["fkLocazione"] !== $locazione_cached) {
          $colore = getColor($bidone["fkLocazione"]);
          array_push($colore_loc, $colore);
          array_push($label_loc, $bidone["fkLocazione"]);

          $locazione_cached == $bidone["fkLocazione"];
        }

    }

    var_dump($label_loc);

    $query = "select * from tblLocazione";
    $risultato_loc = mysqli_query($connessione, $query);
    while ($locazione = mysqli_fetch_array($risultato_loc, MYSQLI_ASSOC)) {
        array_push($locazioni, $locazione);

    }

    foreach ($bidoni as $bidone) {
        $tipo = $bidone['TipoRifiuti'];
        $IDbidone = $bidone['pkID'];

      // Input data avvenuto
        if (isset($_POST['da']) && isset($_POST['a'])) {
          $da = $_POST['da'];
          $a = $_POST['a'];
          $query = "
            select sum(Percentuale) from tblSvuotamento
            inner join tblBidone on tblSvuotamento.fkBidone = tblBidone.pkID
            where tblBidone.pkID='".$IDbidone."' and tblSvuotamento.DataEOra between '".$da."' and '".$a."'";
      // Input data non avvenuto
        }else{
          $query = "
            select sum(Percentuale) from tblSvuotamento
            inner join tblBidone on tblSvuotamento.fkBidone = tblBidone.pkID
            where tblBidone.pkID='".$IDbidone."'";
        }

      //Percentuale
        $risultato = mysqli_query($connessione, $query);
        $percentuale = mysqli_fetch_array($risultato, MYSQLI_ASSOC);
      //Array Push
        if ($risultato->num_rows !== 0) {
          array_push($percentuali, $percentuale['sum(Percentuale)']);
        } else {
          array_push($percentuali, 0);
        }
    }

    function getColor($num) {
      $hash = md5('color' . $num); // modify 'color' to get a different palette
      return array(
        hexdec(substr($hash, 0, 2)), // r
        hexdec(substr($hash, 2, 2)), // g
        hexdec(substr($hash, 4, 2))); //b
      }
 ?>

 <html>
   <head>
     <title>Grafico svuotamenti per bidone</title>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
   </head>

   <body>

     <canvas id="barChart" class="p-3 mb-5 bg-white rounded"></canvas>

     <script>
       var ctxB = document.getElementById("barChart").getContext('2d');

     //Inizio Grafico
       var myBarChart = new Chart(ctxB, {
         type: 'bar',
         data:
         {

     //Tipo Bidoni
           labels:
           [<?php
             $elementi = count($bidoni)-1;

             for ($count = 0; $count < $elementi; $count++) {
               echo '"'.$bidoni[$count]['TipoRifiuti'].'", ';
             }
             echo '"'.$bidoni[$count]['TipoRifiuti'].'"';
           ?>],

     //Percentuali
           datasets: [
           <?php
              foreach (array_merge($label_loc, $colore_loc) as $label => $colore) {
                print "{";
                print "label: '".$label."',";

                print "data: [";
                $count_bid = 0;

                foreach ($bidoni as $bidone) {
                  if ($bidone["fkLocazione"] == $label_loc) {
                    print "'".$percentuali[$count_bid]."', ";
                  } else {
                    print "'', ";
                  }

                  $count_bid = $count_bid + 1;
                }

                print "], ";

                print "backgroundColor: rgba(".$colore[0].", ".$colore[1].", ".$colore[2].", 1), ";
                print "backgroundColor: rgba(".$colore[0].", ".$colore[1].", ".$colore[2].", 0.5),";
                print "borderWidth: 1";

                print "}, ";
              }
            ?>]
       });

     </script>
   </body>
 </html>
