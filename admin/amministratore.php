<?php

session_start();

if(isset($_SESSION['username']) && $_SESSION['ruolo']=="admin"){
	
	echo "benvenuto admin".$_SESSION['username'];
	
	
	
}else{
	echo "accesso negato <a href='login.html'>Torna alla pagina di login</a>";
}






?>