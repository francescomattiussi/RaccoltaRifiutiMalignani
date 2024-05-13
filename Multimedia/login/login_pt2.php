<?php 
  require_once "../../server/connection.php";
  die(print_r($connessione,TRUE));
?>


<html>
	<head>

		<title>Raccolta Rifiuti Malignani</title>

	<!-- Custom fonts for this template-->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
  <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Background Image -->
    <style>
      body {background-image: url('../image.jpg');background-repeat: no-repeat; background-size: cover;}
    </style>
	</head>
	<body>

<!-- ----------------------------------- Navbar ------------------------------------------------ -->
    <?php

//Inserimento delle variabili di reindirizzamento navbar
      $_SESSION['navbar_home']=     '../../index.php';
      $_SESSION['navbar_stats']=    '../../Statistiche/indexStats.php';
      $_SESSION['navbar_emptying']= '../../Emptying/client.php';
      $_SESSION['navbar_location']= '../../LocationChange/indexLocation.php';
      $_SESSION['navbar_login']=    'login.php';
      $_SESSION['navbar_aboutUs']=  '../aboutUs.php';

//Include navbar.php
      include "../navbar.php";
      include "../connection.php";
    ?>
    
    <br><br>
		<div class="gx-5 container w-75">
      <div class="card text-dark bg-light mb-3 shadow border-2 border-dark"><br>

<!-- ---------------------------------------- LOGIN --------------------------------------------------------- -->

        <h1 class="text-center h4 text-gray-900 mb-4">Login</h1>

        <form action="" method="POST" class="container">

              <!-- mail -->
          <label class="form-label" for="exampleInputEmail">Inserisci Email</label>
          <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
              
              <!-- password --><br>
          <label class="form-label" for="exampleInputPassword">Inserisci Password</label>
          <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
              
              <!-- Remember Me --><br>
          <input type="checkbox" class="custom-control custom-checkbox small custom-control-input" id="customCheck" name="keep_logged" value="keep">
          <label class="custom-control-label" for="customCheck">Remember Me</label><br>
              
              <!-- Submit --><br>
          <button type="submit" class="d-grid gap-2 col-6 mx-auto btn btn-primary">Login</button>
        </form>
        <hr>
              <!-- Forgot Password e Register -->
        <a class="text-center small" href="forgot-password.html">Forgot Password?</a><br>
        <a class="text-center small" href="register.php">Create an Account!</a><br>
      </div>
		</div>

    <!-- Bootstrap core JavaScript-->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
		<script src="js/sb-admin-2.min.js"></script>

	</body>		
</html>

<?php

if(isset($_POST['password']) && isset($_POST['email'])){
    $mac = $_SESSION['mac'];
    // print"<script>alert(\"$mac\")</script>";
    $password = $_POST['password'];
		$email = $_POST['email'];

		$query = "select * from tblUtenti;";
		$result = mysqli_query($connessione, $query);

		while($riga = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			if(($riga['mail'] == $email) && ($riga['password'] = $password)){
        $_SESSION['id'] = $riga['pkID'];
        $_SESSION['nome'] = $riga['nome'];
				$_SESSION['login'] = $riga['ruolo'];
			}
		}

		if(isset($_POST['keep_logged'])){
			$query = "update tblUtenti set Mac_code = \"$mac\" where mail = \"$email\" and password = \"$password\"";
			$result = mysqli_query($connessione, $query);
      //print"<script>alert('".$query."')</script>";
		}
		print "<script>window.location = '../../index.php'</script>";
	}
?>