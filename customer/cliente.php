<head>
<link rel="stylesheet" href="..\homepage\style.css">
<?php

session_start();

if(isset($_SESSION['username']) && $_SESSION['ruolo']=="user"){
	
	echo "Welcome ".$_SESSION['username'];
	
	
	
}else{
	die ("accesso negato");
}
?>
<div id="title">
<p class="alignRight">
<h1>Products:</h1>
</p>
<p class="alignLeft">
<a href="carrello.php">vai al carrello</a><br/>
<a href="../login/logout.php">logout</a><br/>
</p>
</div>

<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bookshop" ;

$con = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
$con->set_charset("utf8");
if($con->connect_error){
		die('Errore di connessione a '.$dbName);
}

$query = "SELECT * FROM  prodotto";
	
//echo $query. "<br/>";

$res = $con -> query($query);
if(!$res){
	die("Errore lettura tabella prodotto");
}

echo "<table border='1'>";
echo "<tr><th>Titolo</th><th>Autore</th><th>Fotografia</th><th>Prezzo</th><th>Quantit&agrave; disponibile</th></tr>";
while($row = $res -> fetch_array()){
	echo "<tr>";
	echo "<td>".$row['titolo']."</td>";
	echo "<td>".$row['autore']."</td>";
	echo "<td><img src='".$row['fotografia']."' heigth='100px' width='100px'></td>";
	echo "<td>".$row['prezzo']."</td>";
	echo "<td>".$row['giacenza']."</td>";
	
	echo "<td><a href='carrello.php?idprod=".$row['idProdotto']."'>aggiungi al carrello</a></td>";
	
	echo "</tr>";
}
echo "</table>";
$res ->free();
$con->close();


?>