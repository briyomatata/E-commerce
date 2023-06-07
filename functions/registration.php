<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

include 'connection.php';



 $username = $_POST['username'];
 $email = $_POST['email'];
 $mobile = $_POST['mobile'];
 $password = $_POST['password'];

 $CheckSQL = "SELECT * FROM users WHERE email='$email'";
 
 $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));
 
 if(isset($check)){

 echo 'Email Already Exist';

 }
else{ 
$Sql_Query = "INSERT INTO users (username,email,mobile,password) values ('$username','$email','$mobile','$password')";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Registration is Successfull';
}



 }
}
?>