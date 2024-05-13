<?php

    $selezione = $_GET['grafico'];

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

    <div class="container-md d-flex justify-content-center mx-auto my-3 flex-column">

      <div class="container text-center">
        <div class="row">
          <div class="col">
            <div class="alert alert-primary" role="alert">
              A simple primary alert—check it out!
            </div>
          </div>
          <div class="col">
            <div class="alert alert-primary" role="alert">
              A simple primary alert—check it out!
            </div>
          </div>
          <div class="col">
            <div class="alert alert-primary" role="alert">
              A simple primary alert—check it out!
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link <?php if ($selezione == "bidoni") print "active" ?>" aria-current="true" href="stats.php?grafico=bidoni">Svuotamenti</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if ($selezione == "utenti") print "active" ?>" href="stats.php?grafico=utenti">Svuotamenti degli utenti</a>
                  </li>
                </ul>
              </div>
                <?php include "grafico.php"?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="card mx-auto my-3">
              <div class="card-header text-center">
                Utenti registrati
              </div>

              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td colspan="2">Larry the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col">
            2 of 2
          </div>
        </div>
      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
