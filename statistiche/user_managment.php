<?php require_once "../server/connection.php";?>

<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Raccolta Rifiuti</title>

<!-- Custom fonts for this template-->
<link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

<!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- ----------------------------------- Navbar ------------------------------------------------ -->
    <?php

    //Inserimento delle variabili di reindirizzamento navbar
    $_SESSION['navbar_home']=     '../index.php';
    $_SESSION['navbar_stats']=    'indexStats.php';
    $_SESSION['navbar_emptying']= '../Emptying/indexEmptying.php';
    $_SESSION['navbar_location']= '../LocationChange/indexLocation.php';
    $_SESSION['navbar_login']=    '../Multimedia/login/login.php';
    $_SESSION['navbar_aboutUs']=  '../Multimedia/aboutUs.php';

    //Include navbar.php
    include "../Multimedia/navbar.php";
    ?>

<!-- Page Wrapper -->
    <div id="wrapper">

<!-- Sidebar -->
        <ul class="navbar-nav bg-primary bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexStats.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <?php
                    if(!isset($_SESSION['login'])){
                        print"<div class=\"sidebar-brand-text mx-3\">Visitors Login</div>";
                    }
                    elseif($_SESSION['login'] == "admin"){
                        print"<div class=\"sidebar-brand-text mx-3\">Admin permissions</div>";
                    }
                    elseif($_SESSION['login'] == "user"){
                        print"<div class=\"sidebar-brand-text mx-3\">Guest Login</div>";
                    }
                ?>
            </a>

<!-- Divider -->
            <hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="indexStats.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

<!-- Divider -->
            <hr class="sidebar-divider">

<!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

<!-- Nav Item - Pages Collapse Menu -->
            <?php
            if(isset($_SESSION['login']) && $_SESSION['login'] == "admin")
            {
                print"
                <li class=\"nav-item\">
                <a class=\"nav-link collapsed\" href=\"user_managment.php\" data-toggle=\"collapse\" data-target=\"#collapseTwo\" aria-expanded=\"true\" aria-controls=\"collapseTwo\">
                    <i class=\"fas fa-fw fa-cog\"></i>
                    <span>Gestione Utenti</span>
                </a>
                    <div id=\"collapseTwo\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
                        <div class=\"bg-white py-2 collapse-inner rounded\">
                            <h6 class=\"collapse-header\">Custom Components:</h6>
                            <a class=\"collapse-item\" href=\"buttons.html\">Buttons</a>
                            <a class=\"collapse-item\" href=\"cards.html\">Cards</a>
                        </div>
                    </div>
                </li>
                ";
            }            
            ?>

<!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

<!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

        </ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
            <div id="content">

<!-- Begin Page Content -->
                <div class="container-fluid">

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
<!-- Content Row -->
                    <div class="row">

<!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4" style="width: 150%;">

<!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">User Managment</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        Elenco Utenti
                                    </div>
                                    <p>

<!-- tabella per il displaying degli utenti -->
                                    <?php
                                    
                                        $query = "select * from tblUtenti";
                                        // $query .= " order by Username";
                                        $result = mysqli_query($connessione, $query);
                                        
                                        print"<table class=\"table\"><th><td>Nome</td><td>Cognome</td><td>Utente</td><td>Password</td><td>E-Mail</td><td>Codice - Mac</td><td>Ruolo</td></th>";
                                        
                                        $i=0;
                                        while($riga = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            $i++;
                                            print"<tr>";
                                        
                                            foreach($riga as $key => $value){

                                                // si va a censurare tutti i valori che non poosso conoscere come mac o password
                                                if(($key == "Password") || ($key == "Mac_code")){
                                                    print"<td>******</td>";
                                                }

                                                elseif($key == "Username"){
                                                    $nome = $value;
                                                    print "<td>".$value."</td>";
                                                }
                                                
                                                // faccio la possibilitià di modificare i ruoli degli utenti
                                                elseif($key == "ruolo"){
                                                    include "role_managment.php";
                                                }
                                                else{
                                                    print "<td>".$value."</td>";
                                                }

                                            }

                                            print"</tr>";
                                        
                                        }
                                        print "</table>"
                                    
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
<!-- /.container-fluid -->

            </div>
<!-- End of Main Content -->
        </div>
<!-- End of Content Wrapper -->

    </div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

<!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>