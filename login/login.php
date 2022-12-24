<?php
session_start();
//getting data from login page
$username=$_POST['username'];
$password=$_POST['password'];

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bookshop" ;

$con = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
$con->set_charset("utf8");
if($con->connect_error){
		die('Error encountered when connecting to '.$dbName);
}


$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";




$res=$con->query($sql);
if(!$res){
	die ("Error encountered when reading the users table");
}
$num=$con->affected_rows;
if($num!=0){ //user has been validated
	$row=$res->fetch_array();
	$_SESSION['username']=$username;
	$role=$row['role'];
	$_SESSION['role']=$role;
	
	if($role=="admin"){
		header("Location: ../admin/administrator.php");
	}else{
		header("Location: ../customer/client.php");
	}
}else{
	echo "User not found -- <a href='login.html'>Go back to login page</a>";
}


?>