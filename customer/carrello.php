<?php
session_start();

if (isset($_SESSION['username'])&&($_SESSION['ruolo']=="user"))
	
		echo "Welcome ".$_SESSION['username'];
	
else 
	die ("Accesso negato...");

echo "<h3> Cart </h3>";

if (isset($_GET['idprod'])){
	
	$idprod=$_GET['idprod'];
	
	if (isset($_SESSION['car'][$idprod])){
		
		$_SESSION['car'][$idprod]++;
	}
	else {
		$_SESSION['car'][$idprod]=1;
	}
	
}


if (isset($_SESSION['car'])){
	echo "<table border='1'>";
	echo "<tr><th>Product ID</th><th>Added Quantity</th>";
	
	foreach ($_SESSION['car'] as $prod => $qta){
		
		echo "<tr>";
		echo "<td>" . $prod."</td>";
		echo "<td>" . $qta."</td>";
		echo "<td> <a href='remove.php?idprod=".$prod."'>Remove product</a></td>";
		echo "</br>";
		echo "</tr>";	
	}
	echo"</table>";
}		



?>
</br>
<a href="cliente.php">Continua gli acquisti</a>
-----
<a href="ordine.php">Conferma ordine</a>