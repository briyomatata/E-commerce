<?php

 if($_SERVER['REQUEST_METHOD']=='POST'){

 include 'connection.php';
 
 
 $email = $_POST['email'];
 $password = $_POST['password'];
 
 $Sql_Query = "select * from users where email = '$email' and password = '$password' ";
 
 $check = mysqli_fetch_array(mysqli_query($conn,$Sql_Query));
 
 if(isset($check)){
 
 echo "Login Successful";
 }
 else{
 echo "Invalid Username or Password Please Try Again";
 }
 
 }else{
 echo "Check Again";
 }
// mysqli_close($conn);

?>