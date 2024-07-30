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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $address = $data['address'];
    $email = $data['email'];
    $contact = $data['contact'];

    // Insert client details into the client table
    $sql = "INSERT INTO client (Client_Name, Address1, Email, Contact) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $address, $email, $contact);
    
    if ($stmt->execute()) {
        echo json_encode(array("success" => true, "message" => "Client added successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error adding client"));
    }

    $stmt->close();
}

elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch project details from the project table
    $sql = "SELECT Client_ID, Client_Name, Email, Address1, Contact FROM client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $clients = array();
        while($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }
        echo json_encode($clients);
    }
 else {
    echo json_encode(array("success" => false, "message" => "Error adding client"));
}
}

$conn->close();
?>