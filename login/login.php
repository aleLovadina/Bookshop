<?php
session_start();
//recupero dati passati dal form
$username=$_POST['username'];
$password=$_POST['password'];

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bookshop" ;

$con = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
$con->set_charset("utf8");
if($con->connect_error){
		die('Errore di connessione a '.$dbName);
}
echo "collegamento con bookshop";

$sql="SELECT * FROM utente WHERE username='$username' AND password='$password'";
echo $sql;

echo "</br>";

$res=$con->query($sql);
if(!$res){
	die ("errore sql");
}
$num=$con->affected_rows;
if($num!=0){ //utente validato
	$row=$res->fetch_array();
	$_SESSION['username']=$username;
	$ruolo=$row['ruolo'];
	$_SESSION['ruolo']=$ruolo;
	echo $ruolo;
	if($ruolo=="admin"){
		header("Location: ../admin/amministratore.php");
	}else{
		echo "sium";
		header("Location: ../customer/cliente.php");
	}
}else{
	echo "utente non esistente <a href='login.html'>Torna alla pagina di login</a>";
}


?>