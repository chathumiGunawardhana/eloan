<?php
// "include db.php";

// $username= $_POST['username'];
// $password=$_POST['password'];

// if(isset($_POST['submit'])){
// 	if($username == null || strlen($username)<1){
// 		echo"Username is required.";
// 	}
// 	if($password == null || strlen($password)<1){
// 			echo"Password is required.";
// 		}
// }
?> 
<?php
session_start();
include "db.php";

if(isset($_POST['username']) && (isset($_POST['password']))){
    $username=$_POST['username']; 
    $password=$_POST['password'];
    $modifiedpw=md5($_POST['password']);

    $sql="SELECT * FROM users WHERE username='$username' and password='$password'";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    //echo $count;
    if ($count>0){
        $row=mysqli_fetch_row($result);
        //printr($row);
        $_SESSION['userID']=$row[1];
        $msg="login successful........";
        header('location:index.php?msg='.$msg);
    }else{
        echo" User name or password incorret";
    }   
}

// header("location:checkusernameandpwd.php");
    
    
?>
<?php
//remember me
// session_start();
// require 'db.php';

// $db=mysql_select_db("$dbname",$conn) or die ("Couldnt select database");

// $submit=$_POST['submit'];
// $username=$_POST['username'];
// $password=$_POST['password'];
// $rememberme=$_POST['rememberme'];

// $result=mysqli_query( "SELECT * FROM users WHERE usrname='$username' and password='$password'");
?>
