<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Allow access from any origin (for CORS issues)
header("Access-Control-Allow-Headers: *"); // Allow all headers (for CORS issues)

$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "dinesh"; // Replace with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error)));
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(array("success" => false, "message" => "Username or password not provided."));
    exit();
}

$user = $data['username'];
$pass = $data['password'];

// Debugging: Log the received username and password
error_log("Received username: $user");
error_log("Received password: $pass");

$sql = "SELECT * FROM register WHERE Username = '$user' AND Password1 = '$pass'";
$result = $conn->query($sql);

if ($result === false) {
    // Debugging: Log the error message
    error_log("Query error: " . $conn->error);
    echo json_encode(array("success" => false, "message" => "Query error: " . $conn->error));
    exit();
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (strtolower($row['Username']) === 'admin') {
        echo json_encode(array("success" => true, "isAdmin" => true, "message" => "Login successful."));
    } else {
        echo json_encode(array("success" => true, "isAdmin" => false, "message" => "Login successful."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid credentials"));
}

$conn->close();
?>

