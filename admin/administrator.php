<?php

session_start();

if(isset($_SESSION['username']) && $_SESSION['role']=="admin"){
	
	echo "Welcome admin ";

	
	
}else{
	echo "You don't have the rights to access this page <a href='login.html'>Log in first</a>";
}






?>