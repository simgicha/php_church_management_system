<?php
ob_start();
include('connect-db.php');

// username and password sent from form
$myusername=$_POST['username'];
$mypassword=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
//$myusername = mysqli_real_escape_string($myusername);
//$mypassword = mysqli_real_escape_string($mypassword);

$sql="SELECT * FROM users WHERE username='$myusername' and password='$mypassword'";

$result=mysqli_query($connection,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
session_start();
// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
$_SESSION['myusername']=$myusername;
header("location: home.php");
}
else {
$msg = "Wrong Username or Password. Please try again";
header("location:index.php?msg=$msg");
echo mysqli_error();
}
ob_end_flush();
?>

