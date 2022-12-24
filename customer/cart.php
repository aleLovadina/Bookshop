<head>
<title> Cart </title>
<style>
td {
  text-align: center;
}
</style>
</head>

<body>
<?php
session_start();

if (isset($_SESSION['username'])&&($_SESSION['role']=="user"))
	
		echo $_SESSION['username']."'s cart";
	
else 
	die ("You cannot access this page, <a href='../login/login.html'>log in</a> first");

echo "<h3> Cart:</h3>";

if (isset($_GET['prodId'])){
	
	$prodId=$_GET['prodId'];
	
	if (isset($_SESSION['car'][$prodId])){
		
		$_SESSION['car'][$prodId]++;
	}
	else {
		$_SESSION['car'][$prodId]=1;
	}
	
}


if (isset($_SESSION['car'])){
	echo "<table border='1'>";
	echo "<tr><th>Product ID</th><th>Added Quantity</th>";
	
	foreach ($_SESSION['car'] as $prod => $qt){
		
		echo "<tr>";
		echo "<td>" . $prod."</td>";
		echo "<td>" . $qt."</td>";
		echo "<td> <a href='remove.php?prodId=".$prod."'>Remove product</a></td>";
		echo "</br>";
		echo "</tr>";	
	}
	echo"</table>";
}		



?>
</br>
<a href="client.php">Continue shopping</a>
-----
<a href="order.php">Buy now</a>
</body>
</html>