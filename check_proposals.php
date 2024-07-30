<?php
// Set headers for CORS
/*header("Access-Control-Allow-Origin: *"); // Adjust this as needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinesh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// SQL query to fetch new proposals count
$sql = "SELECT COUNT(*) as new_proposals FROM proposal WHERE viewed = 0";
$result = $conn->query($sql);

// Initialize new_proposals count
$new_proposals = 0;

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_proposals = $row['new_proposals'];
    }
    $result->free();
} else {
    die(json_encode(['error' => 'Query failed: ' . $conn->error]));
}

// Update proposals to mark as viewed
$update_sql = "UPDATE proposal SET viewed = 1 WHERE viewed = 0";
$conn->query($update_sql);

// Close the database connection
$conn->close();

// Return the JSON response
echo json_encode(['new_proposals' => $new_proposals]);
?>*/


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinesh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$sql = "SELECT COUNT(*) as new_proposals FROM proposal WHERE viewed = 0";
$result = $conn->query($sql);

$new_proposals = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $new_proposals = $row['new_proposals'];
}

$conn->close();

echo json_encode(['new_proposals' => $new_proposals]);
?>








