<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "dinesh"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'];

if ($type === 'project_types') {
  $sql = "SELECT DISTINCT Project_type FROM project";
} elseif ($type === 'project_names' && isset($_GET['project_type'])) {
  $project_type = $conn->real_escape_string($_GET['project_type']);
  $sql = "SELECT Project_name FROM project WHERE Project_type = '$project_type'";
} elseif ($type === 'designations') {
  $sql = "SELECT DISTINCT Designation FROM employee";
} elseif ($type === 'employee_names' && isset($_GET['designation'])) {
  $designation = $conn->real_escape_string($_GET['designation']);
  $sql = "SELECT Name1 FROM employee WHERE Designation = '$designation'";
} else {
  echo json_encode([]);
  exit;
}

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

echo json_encode($data);

$conn->close();
?>
