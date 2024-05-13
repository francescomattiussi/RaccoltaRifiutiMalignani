<?php
  session_start();
  
  require_once "config.inc";
  
  $connessione = mysqli_connect($host_name,$user_name,$password);
  $database = mysqli_select_db($connessione, $database);

  if ($connessione->connect_error) {
    die("Connection failed: ".$connessione->connect_error);
  }

  date_default_timezone_set("Europe/Rome");
?>
