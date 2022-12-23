<?php
session_start();

if (isset($_SESSION['username'])&&($_SESSION['ruolo']=="user"))
	
		echo "benvenuto cliente ".$_SESSION['username'];
	
else 
	die ("Accesso negato...");





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
		die('Errore di connessione a '.$dbName);
}
$con->autocommit(false);
$con->begin_transaction();
$errore=false;
//inserimento ordine

$sql="INSERT INTO ordine(username) VALUES ('".$_SESSION['username']."')";
//echo $sql."<br/>";
$result = $con->query($sql);
if($result){
	//ordine inserito
	
	$id = $con ->insert_id; //id ordine
	
	foreach ($_SESSION['car'] as $prod => $qta){
		$sql = "INSERT INTO dettaglio_ordine (nordine, idprodotto, ncopie) ";
		$sql.="VALUES($id, $prod, $qta)";
		//echo $sql."<br/>";
		$result = $con->query($sql);
		if($result){
			//dettaglio inserito
			
			//aggiorno giacenza
			$sql ="UPDATE prodotto SET giacenza = giacenza - $qta ";
			$sql .="WHERE idProdotto=$prod AND giacenza>=$qta";
			
			//echo $sql."<br/>";
			$result = $con->query($sql);
			if($result){
				//tutto ok sintassi! no check
				if($con->affected_rows>0){
					//ho modificato
					unset($_SESSION['car'][$prod]);
				}else{
					//echo "errore aggiornamento giacenza $prod";
					$sql="SELECT titolo FROM prodotto WHERE idProdotto=$prod";
					$result = $con->query($sql);
					$row=$result->fetch_array();
					$title=$row['titolo'];
					echo "No products left for $title ---- ";
					$errore=true;
					break;
				}
			}else{
				//echo "errore aggiornamento giacenza $prod";
				$sql="SELECT titolo FROM prodotto WHERE idProdotto=$prod";
				$result = $con->query($sql);
				$row=$result->fetch_array();
				$title=$row['titolo'];
				echo "No products left for $title ---- ";
				//echo "</br>";
				$errore=true;
				break;
			}
		}else{
			echo "errore inserimento dettaglio ordine prodotto $prod";
			$errore=true;
			break;
		}
	}
	
	
}else{
	echo "errore query";
	$errore=true;
}
if($errore==false){
	$con->commit();
	echo "Order has been succesfully placed!</br>";
	
}else{
	$con->rollback();
	echo "Failed to place orders. Please retry later</br>";
}

?>
</br>
<a href="cliente.php">Continua gli acquisti</a>