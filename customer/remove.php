<?php
session_start();

if (isset($_SESSION['username'])&&($_SESSION['ruolo']=="user")){
	
	
}else {
	die ("Error");
}
if (isset($_GET['idprod'])){
	$idprod=$_GET['idprod'];
	
	if (isset($_SESSION['car'][$idprod])){
		
		unset($_SESSION['car'][$idprod]);
	}
	else {
		echo "no product has been found";
	}
}

header ("Location: carrello.php");

?>