<?php include "../connection.php";?>

<html>
	<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->

    <!-- Custom styles for this template-->
    <link href="../../Statistiche/css/sb-admin-2.min.css" rel="stylesheet">

	</head>

	<body class="bg-gradient-primary">
		
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
    ?>
    <div class="container">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-7">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
								</div>
								<form class="user" method="post">
<!-- nome -->
									<div class="form-group row">
										<div class="col-sm-6 mb-3 mb-sm-0">
											<input type="text" name="nome" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" required>
										</div>
<!-- cognome -->
										<div class="col-sm-6">
											<input type="text" name="cognome" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" required>
										</div>
									</div>
<!-- email -->
									<div class="form-group">
										<input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" required>
									</div>
<!-- password 1 -->
									<div class="form-group row">
										<div class="col-sm-6 mb-3 mb-sm-0">
											<input type="password" name="password_1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
										</div>
<!-- password 2 -->
										<div class="col-sm-6">
											<input type="password" name="password_2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" required>
										</div>
									</div>
									<input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
								</form>
								<hr>
								<div class="text-center">
									<a class="small" href="forgot-password.html">Forgot Password?</a>
								</div>
								<div class="text-center">
									<a class="small" href="login.html">Already have an account? Login!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
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

	if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password_1']) && isset($_POST['password_2'])){
		$nome    = $_POST['nome'];
		$cognome = $_POST['cognome'];
		$mail    = $_POST['email'];

		if($_POST['password_1'] == $_POST['password_2']){
			$password = $_POST['password_1'];
			$query = "insert into tblUtenti values(null, \"$nome $cognome\", \"$password\", \"$mail\", \"$nome\", \"$cognome\", null, \"user\")";
			$result = mysqli_query($connessione, $query);    
		}
// fare l'alert
		else print"Le password inserite non corrispondono";
		print"<script>window.location = '../../index.php'</script>";

// evitare ridondanza degli account
	}

?>