<html>
<title>
BookShop
</title>

<body>
<center><h1> Welcome to the Online Bookshop </h1></center>
<br>
<p align="right"><a href="../login/login.html" target="_new">Login / Sign up</a></p>

<h2>Filter:</h2>
<form name="filter" method="get" action="#">  <!--homepage.php-->

By title: <input type="text" name="title">
<input type="submit" value="search">

</form>

<?php
//filtro
if (isset($_REQUEST['title']))
	$title=$_REQUEST['title'];
else
	$title=false;

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bookshop" ;

$con = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
$con->set_charset("utf8");
if($con->connect_error){
		die('An error was encountered when connecting to '.$dbName);
}
//filtro
if ($title)
	$query = "SELECT * FROM  products WHERE title like '%$title%'";
else
	$query = "SELECT * FROM  products";
	
//echo $query. "<br/>";

$res = $con -> query($query);
if(!$res){
	die("An error was encountered when reading the products table");
}
$num=$con->affected_rows;
if($num!=0){
	echo "<table border='1'>";
	echo "<tr><th>Title</th><th>Author</th><th>Cover</th><th>Price</th><th>Availability</th></tr>";
	while($row = $res -> fetch_array()){
		echo "<tr>";
		echo "<td>".$row['title']."</td>";
		echo "<td>".$row['author']."</td>";
		echo "<td><img src='".$row['cover']."' heigth='100px' width='100px'></td>";
		echo "<td>".$row['price']."</td>";
		echo "<td>".$row['stock']."</td>";
		
		echo "</tr>";
	}
echo "</table>";
}else{
	echo "No results";
}


$res ->free();
$con->close();
?>

</body>
</html>