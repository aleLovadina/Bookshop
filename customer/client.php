<html>
<head>
<title> Client </title>
<style>
td {
  text-align: center;
}
</style>
</head>

<body>
<?php

session_start();

if(isset($_SESSION['username']) && $_SESSION['role']=="user"){
	
	echo "Welcome ".$_SESSION['username']."<br/>";
	echo "<a href='../login/logout.php'>Logout</a>";
	
	
}else{
	die ("You cannot access this page, <a href='../login/login.html'>log in</a> first");
}
?>

<h1>Products:</h1>


<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bookshop" ;

$con = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
$con->set_charset("utf8");
if($con->connect_error){
		die('An error was encountered when connecting to '.$dbName);
}

$query = "SELECT * FROM  products";
	
//echo $query. "<br/>";

$res = $con -> query($query);
if(!$res){
	die("An error was encountered when reading the products table");
}

echo "<table border='1'>";
echo "<tr><th>Title</th><th>Author</th><th>Cover</th><th>Price</th><th>Availability</th><th><a href='cart.php'>Cart</a></th></tr>";
while($row = $res -> fetch_array()){
	echo "<tr>";
	echo "<td>".$row['title']."</td>";
	echo "<td>".$row['author']."</td>";
	echo "<td><img src='".$row['cover']."' heigth='100px' width='100px'></td>";
	echo "<td>$".$row['price']."</td>";
	echo "<td>".$row['stock']."</td>";
	
	echo "<td><a href='cart.php?prodId=".$row['productId']."'>Add to cart</a></td>";
	
	echo "</tr>";
}
echo "</table>";
$res ->free();
$con->close();


?>
</body>
</html>