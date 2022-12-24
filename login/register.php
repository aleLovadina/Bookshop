<?php
//user registration


$username=$_POST["username"];
$password=$_POST["password"];
$password1=$_POST["password1"];
$name=$_POST["name"];
$last_name=$_POST["last"];
$address=$_POST["address"];
$email=$_POST["email"];
$role="user";
//checking submitted data
if($username=="" || $password=="" || $password1=="" || $password!=$password1){
	echo "Please check your credentials and try again";
}else{
	
	$mysqli=new mysqli("localhost", "root", "", "bookshop");
	if ($mysqli->connect_errno){
		die ("Error encountered when connecting to the database");
	}
	
	$sql="INSERT INTO users(username,password, name, last_name, address, email, role) VALUES ('$username','$password','$name','$last_name','$address','$email','$role')";
	
	$result=$mysqli->query($sql);
	if($result){
		echo "You have created a new account!";
		echo "</br>";
		echo "<a href='login.html'>Go back to login page</a>";
	}else{
		echo "Something went wrong :(";
		echo "</br>";
		echo "<a href='register.html'>Create an account</a>";
	}
	$mysqli->close();
	
	
	
	
	
	
	
	
	
	
	
	
}






?>