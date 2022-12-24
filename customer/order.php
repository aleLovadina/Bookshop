<?php
session_start();

if (isset($_SESSION['username'])&&($_SESSION['role']=="user")){

}else{
	die ("You don't have the rights to access this page");
}
		
	






?>
<h1>Order Summary</h1>
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
$con->autocommit(false);
$con->begin_transaction();
$error=false;
//insert order

$sql="INSERT INTO orders(username) VALUES ('".$_SESSION['username']."')";
//echo $sql."<br/>";
$result = $con->query($sql);
if($result){
	//order has been saved
	
	$id = $con ->insert_id; //orderID creation
	
	foreach ($_SESSION['car'] as $prod => $qt){
		$sql = "INSERT INTO order_details (orderNum, productId, copiesNum) ";
		$sql.="VALUES($id, $prod, $qt)";
		//echo $sql."<br/>";
		$result = $con->query($sql);
		if($result){
			//details have been saved
			
			//stock update
			$sql ="UPDATE products SET stock = stock - $qt ";
			$sql .="WHERE productId=$prod AND stock>=$qt";
			
			//echo $sql."<br/>";
			$result = $con->query($sql);
			if($result){
				
				if($con->affected_rows>0){
					//modified
					unset($_SESSION['car'][$prod]);
				}else{
					//echo "An error occurred when updating availability for $prod";
					$sql="SELECT title FROM products WHERE productId=$prod";
					$result = $con->query($sql);
					$row=$result->fetch_array();
					$title=$row['title'];
					echo "No products left for $title ---- ";
					$error=true;
					break;
				}
			}else{
				//echo "An error occurred when updating availability for $prod";
				$sql="SELECT titolo FROM products WHERE productId=$prod";
				$result = $con->query($sql);
				$row=$result->fetch_array();
				$title=$row['title'];
				echo "No products left for $title ---- ";
				//echo "</br>";
				$error=true;
				break;
			}
		}else{
			echo "An error has occurred when inserting order details for $prod";
			$error=true;
			break;
		}
	}
	
	
}else{
	echo "Query error";
	$error=true;
}
if($error==false){
	$con->commit();
	echo "Order has been succesfully placed!</br>";
	
}else{
	$con->rollback();
	echo "Failed to place orders. Please try again later</br>";
}

?>
</br>
<a href="client.php">Continue shopping</a>