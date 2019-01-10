<?php

require '../db.php';

if ($conn ){
	$query=$conn->prepare("SELECT * FROM loantypes");
	$query->execute();
	$LoanTypes=$query->fetchAll(PDO::FETCH_ASSOC);

	$json=json_encode($LoanTypes);
	
	echo $json;
}
$conn=null;
 
?>   