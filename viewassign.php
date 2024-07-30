<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

// Replace with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinesh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the assign table
$sql = "SELECT proj_type, proj_name, emp_desig, emp_name FROM assign";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Store results in an array
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  
  // Return data as JSON
  echo json_encode($data);
} else {
  echo "0 results";
}

$conn->close();
?>
