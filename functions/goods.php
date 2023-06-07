<?php


require_once 'connection.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from database
$sql = "SELECT * FROM goods";
$result = mysqli_query($conn, $sql);

// Create array for storing fetched data
$data = array();

// Check if data exists
if (!$result || mysqli_num_rows($result) > 0) {
    // Loop through data and store in array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// Send response in JSON format
header('Content-Type: application/json');
echo json_encode($data);

// Close database connection
mysqli_close($conn);





?>