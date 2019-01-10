<?php

require '../db.php';

if ($conn ){
	$query=$conn->prepare("SELECT * FROM user_groups");
	$query->execute();
	$UserGroups=$query->fetchAll(PDO::FETCH_ASSOC);

	$json=json_encode($UserGroups);
	
	echo $json;
}
$conn=null;
 
?>   