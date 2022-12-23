<html>
<title>
BookShop
</title>

<body>
<center><h1> Benvenuto in Libreria OnLine </h1></center>
<br>
<p align="right"><a href="../login/login.html" target="_new">Login/Registrati</a></p>

<h2>Filtra</h2>
<form name="filtro" method="get" action="#">  <!--homepage.php-->

titolo:<input type="text" name="titolo">
<input type="submit" value="cerca">

</form>

<?php
//filtro
if (isset($_REQUEST['titolo']))
	$titolo=$_REQUEST['titolo'];
else
	$titolo=false;

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bookshop" ;

$con = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
$con->set_charset("utf8");
if($con->connect_error){
		die('Errore di connessione a '.$dbName);
}
//filtro
if ($titolo)
	$query = "SELECT * FROM  prodotto WHERE titolo like '%$titolo%'";
else
	$query = "SELECT * FROM  prodotto";
	
echo $query. "<br/>";

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
	
	
	echo "</tr>";
}
echo "</table>";
$res ->free();
$con->close();
?>

</body>
</html>