<?php

require '../db.php';

$action = "";

if( isset($_REQUEST["action"])) {
	$action =$_REQUEST["action"];
}

if($action=="Get_Table_Data_To_JSON"){

	if ($conn ){
		$query=$conn->prepare("SELECT LoanTypeCode , Description , Active FROM loantypes" );	
		$query->execute();
		$loantypes=$query->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($loantypes);
		echo $json;
	}
	$conn = null;
}else if($action=="addNewRecord"){
	if(isset($_REQUEST["LoanTypeCode"])) $LoanTypeCode =$_REQUEST["LoanTypeCode"];
	if(isset($_REQUEST["Description"])) $Description =$_REQUEST["Description"];
	if(isset($_REQUEST["Active"])) $Active =$_REQUEST["Active"];
	
	if($conn){

		$query = $conn->prepare("INSERT INTO loantypes (LoanTypeCode,Description,Active) VALUES (:LoanTypeCode, :Description, :Active)");
		$query->bindParam(':LoanTypeCode'	, $LoanTypeCode	, PDO::PARAM_STR);
		$query->bindParam(':Description'	, $Description	, PDO::PARAM_STR);
		$query->bindParam(':Active'			, $Active		, PDO::PARAM_STR);
		$query->execute();

		if($query->rowCount()>0)
			echo '{"type":"Success",
					"message":"Record Successfully Added",
					"rowcount":"'.$query->rowCount().'"}';
		else
			echo '{"type":"Error",
				"message":"Error occured",
				"rowcount":"'.$query->rowCount().'"}';
	}

	$conn = null;

}
elseif($action=="deleteRecord"){

	if( isset($_REQUEST["LoanTypeCode"])) {
		$LoanTypeCode =$_REQUEST["LoanTypeCode"];
	}

	if ($conn ){

		$query=$conn->prepare("SELECT count(*) as recordcount FROM loanschemes WHERE schemeCode = :LoanTypeCode" );	
		$query->bindParam(':LoanTypeCode',$LoanTypeCode, PDO::PARAM_STR);
		$query->execute();
		$LoanSchemeData=$query->fetchAll(PDO::FETCH_ASSOC);

			if($LoanSchemeData[0]["recordcount"] == 0){
				$query = $conn->prepare("DELETE FROM loantypes WHERE LoanTypeCode = :LoanTypeCode");
				$query->bindParam(':LoanTypeCode',$LoanTypeCode, PDO::PARAM_STR);
				$query->execute();
			
				if($query->rowCount()>0)
					echo '{"type":"SUCCESS","message":"Record Successfully Deleted.","rowcount":"'.$query->rowCount().'"}';
				else
					echo '{"type":"ERROR","message":"Error occured  while deleting record","rowcount":"'.$query->rowCount().'"}';
		
			}else{
				echo '{"type":"ERROR","message":"Error occured while deleting","rowcount":"'.$LoanSchemeData[0]["recordcount"].'"}';
		}
	}
	$conn = null;
}
elseif($action=="Get_record_details"){

	if(isset($_REQUEST["LoanTypeCode"]))	{
		$LoanTypeCode = $_REQUEST["LoanTypeCode"];
	}

	if($conn){
		$query=$conn->prepare("SELECT LoanTypeCode, Description, Active FROM loantypes WHERE LoanTypeCode = :LoanTypeCode" );	
		$query->bindParam(':LoanTypeCode',$LoanTypeCode, PDO::PARAM_STR);
		$query->execute();
		$LoanTypeData=$query->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($LoanTypeData);
		echo $json;
	}

	$conn =  null;
}


elseif($action=="Modify"){
	if(isset($_REQUEST["LoanTypeCode"])) $LoanTypeCode =$_REQUEST["LoanTypeCode"];
	if(isset($_REQUEST["Description"])) $Description =$_REQUEST["Description"];
	if(isset($_REQUEST["Active"])) $Active =$_REQUEST["Active"];

	if ($conn ){

		$query=$conn->prepare("UPDATE loantypes SET Description = :Description, Active = :Active WHERE LoanTypeCode = :LoanTypeCode" );	
		$query->bindParam(':LoanTypeCode',$LoanTypeCode, PDO::PARAM_STR);
		$query->bindParam(':Description',$Description, PDO::PARAM_STR);
		$query->bindParam(':Active',$Active, PDO::PARAM_STR);
		$query->execute();
		
		if($query->rowCount()>0)
			echo '{"type":"SUCCESS","message":"Record Successfully Modiied.","rowcount":"'.$query->rowCount().'"}';
		else
			echo '{"type":"Error","message":"Record was not modified.","rowcount":"'.$query->rowCount().'"}';
	}

	$conn = null;
}
// elseif($action=="reset_data"){

// }

?>   