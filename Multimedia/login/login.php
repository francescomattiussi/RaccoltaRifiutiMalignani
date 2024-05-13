<?php
include "../../server/connection.php";
  
//LOGOUT
if(isset($_GET["logout"]) && $_GET["logout"] == TRUE){
  $_SESSION['login'] = null;
  $_SESSION['nome'] = null;
  $_SESSION['id'] = null;
  header("location: ../../index.php");
}else{

  
// il server dovrà cercare sempre tra gli utenti se l'indirizzo mac corrisponde a quello esistente in caso contrario chiederà di fare il login

  $MAC = $_SERVER['REMOTE_ADDR']; // indirizzo IP
 
  $_SESSION['mac'] = $MAC;

  $log = "no_log";

  // controllo se c'è già connessione da MAC address
  $query = "select * from tblUtenti where Mac_code = \"$MAC\"";
  $result = mysqli_query($connessione, $query);
 
// controllo se il mac del disposistivo connesso è registrato sul database
  if($riga = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      $log = $riga['ruolo'];
  
      $_SESSION['login'] = $log;
      $_SESSION['nome'] = $riga["nome"];
      $_SESSION['id'] = $riga["pkID"];
      print"<script>window.location = '../../index.php'</script>";
    
  }
  print "<script>window.location = 'login_pt2.php'</script>";

}
?>