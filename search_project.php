<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// Database credentials

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
// Fetch project names from the project table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type']) && $_GET['type'] === 'names') {
    $sql = "SELECT Project_ID, Project_name FROM project";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $projects = array();
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        echo json_encode($projects);
    } else {
        echo json_encode(array());
    }
}
$conn->close();
?>
