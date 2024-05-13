<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestione Rifiuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php include "navbar.php" ?>

    <div class="container-md d-flex justify-content-center mx-auto my-3 flex-column">

      <div class="border border-1 rounded p-3">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
