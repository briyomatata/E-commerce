<?php

include 'connection.php';

$st_check =$conn->prepare("select distinct category from goods");
$st_check->execute();
$rs=$st_check->get_result();
$arr=array();
while($row = $rs->fetch_assoc())
{
    array_push($arr, $row);
}

echo json_encode($arr);






?>