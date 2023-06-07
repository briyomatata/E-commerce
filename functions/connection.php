<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "shop";


//creating database connection
$conn = mysqli_connect($host, $username, $password, $database);

//checking the connection
if(!$conn){
    die("Connection Failed: ". mysqli_connect_error());
}
// else{
//     echo "Connection Successfull";
// }

?>