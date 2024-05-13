<?php

  session_start();

  // connessione
  require_once "server/connection.php";

  $erroreLogin = false;


  if(isset($_POST['password']) && isset($_POST['email'])){

    $password = $_POST['password'];
		$email = $_POST['email'];

		$query = "select * from tblUtenti;";
		$result = mysqli_query($connessione, $query);

		while ($riga = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			if (($riga['mail'] == $email) && ($riga['password'] = $password)) {

        // corrispondenza con l'account, salvataggio dei dati in sessione
        $_SESSION['id'] = $riga['pkID'];
        $_SESSION['nome'] = $riga['nome'];
				$_SESSION['ruolo'] = $riga['ruolo'];

        if(isset($_POST['ricordami'])){

          // se l'opzione per ricordare l'accesso dell'utente è stata aselezionata, verrà creato un cookie dalla durata di un mese
          setcookie("user_id", $riga['pkID'], time() + (86400 * 30), "/");
          setcookie("user_name", $riga['nome'], time() + (86400 * 30), "/");
    		}

        print "<script>window.location = 'index.php'</script>";
        die();
			} else {
        $erroreLogin = true;
      }
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

    <?php include "navbar.php" ?>

    <div class="container-md d-flex justify-content-center flex-column mx-auto my-3">
      <div class="card mx-auto" style="width: 18rem;">
        <div class="card-header text-center">
          Accedi
        </div>
        <div class="card-body">

          <?php
            if ($erroreLogin == true) {
              print '<div class="alert alert-danger" role="alert">Credenziali errate, riprova</div>';
            }
           ?>

          <form action="login.php" method="post">
            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Indirizzo mail" required>

            <input type="password" name="password" class="form-control form-control-user mt-3" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Password" required>

            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" name="ricordami" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Ricordami
              </label>
            </div>

            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-primary mt-3 mx-auto" onclick="this.form.submit()">Accedi</button>
            </div>
          </form>
        </div>
        <div class="card-footer text-muted text-center">
          Non possiedi un account? <br> <a href="#" class="primary-link">Creane uno cliccando qua</a>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
