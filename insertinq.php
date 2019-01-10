<?php
include "db.php"; 

$name = $_POST['name'];
$nicno = $_POST['nicno'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$loantype = $_POST['loantype'];
$amount = $_POST['amount'];
$period = $_POST['period'];
$other = $_POST['other'];
$date = $_POST['date'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$count = mysqli_num_rows($sql);
//do a nested if to check the username and email then go to password to see if the user exists
if(isset($_post['name']) && (isset($_POST['nicno']))){
    $sql="SELECT * FROM inquiry where usrname='$username' and nicno='$nicno'";
    $result = mysqli_query($conn, $sql);
    // while($row=mysqli_fetch_array($result,mysqli_assoc){

    // }
    $sql = "INSERT INTO inquiry (name,nicno,email,mobile,loantype,amount,period,other,date) values
    ('$name','$nicno','$email','$mobile','$loantype','$amount','$period','$other','$date')";
}
  
if(mysqli_query($conn,$sql)){
	echo "New inquiry was created successfully";
	} else{		
	echo "Error: " .$sql."<br>".mysqli_error($connection);	
	}



// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
// header("location:login.php");

$conn->close();
?>