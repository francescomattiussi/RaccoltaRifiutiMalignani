<?php
  require_once "../server/connection.php";

  $bidoni = [];
  $da = "";
  $a = "";

// --------------------------------- Ottenimento Bidoni ------------------------------------------
    $query = "select * from tblBidone";
    $risultato = mysqli_query($connessione, $query);
    while ($bidone = mysqli_fetch_array($risultato, MYSQLI_ASSOC)) {
        array_push($bidoni, $bidone);

    }


    $percentuali = [];


// -------------------------------- Rilevazione Percentuali ----------------------------------------
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

?>

<!-- ----------------------------------------------------- INPUT --------------------------------------------------------------- -->


<html>
  <head>
    <title>Rifiuti</title>
  <!-- Css, Javascript e Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </head>
<!-- Inizio Html -->
  <body>
      <!-- ------------------- Form ----------------------------------------------------------------- -->
      <!-- <form action="grafico.php" method="post" name="periodo"> -->
        <!-- <div class="mb-3"> -->
          <!--
            <label for="da" class="form-label">Inserire data di partenza </label>
            <input class="form-control" type="datetime-local" id="da" name="da" value="<?php if ($da != "") echo $da; ?>">

            <label for="da" class="form-label">Inserire data di arrivo </label>
            <input class="form-control" type="datetime-local" id="a" name="a" value="<?php if ($da != "") echo $a; ?>"><br> -->

            <!-- <button type="submit" class="d-grid gap-2 col-6 mx-auto btn btn-primary">Cerca</button> -->
            <!-- </div> -->
            <!-- </form> -->
          <!-- </div> -->

    <canvas id="barChart" class="p-3 mb-5 bg-white rounded"></canvas>

  <!-- ------------------- Javascript ----------------------------------------------------------- -->
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
          datasets:
          [{
            label: 'volumi raccolti',
            data: [<?php
              $elementi = count($bidoni)-1;
              for ($count = 0; $count < $elementi; $count++) {
                echo '"'.$percentuali[$count].'", ';
              }
              echo '"'.$percentuali[$count].'"';
            ?>],

    //impostazioni di base
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {scales: {yAxes: [{ticks: {beginAtZero: true}}]}}
      });

    </script>
  </body>
</html>
