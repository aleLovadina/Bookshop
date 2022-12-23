<?php
session_start();

if(isset($_SESSION["user"])){
	
	$utente=$_SESSION["user"];
	echo "benvenuto $utente";
	
	echo "<br><a href='logout.php'>logout</a>";
	
	
	











}

else{
	echo "utente non autorizzato";

}


?>