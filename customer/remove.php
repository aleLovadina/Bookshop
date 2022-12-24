<?php
session_start();

if (isset($_SESSION['username'])&&($_SESSION['role']=="user")){
	
	
}else {
	die ("Error");
}
if (isset($_GET['prodId'])){
	$prodId=$_GET['prodId'];
	
	if (isset($_SESSION['car'][$prodId])){
		
		unset($_SESSION['car'][$prodId]);
	}
	else {
		echo "no product has been found";
	}
}

header ("Location: cart.php");

?>