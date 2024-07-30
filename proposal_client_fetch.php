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
    // Handle POST request to add a new client
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate incoming data
    if (isset($data['name'], $data['address'], $data['email'], $data['contact'])) {
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
    } else {
        echo json_encode(array("success" => false, "message" => "Missing required fields"));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET request to fetch clients matching a query
    $query = isset($_GET['query']) ? $_GET['query'] : '';
    
    // Validate and sanitize query parameter
    $likeQuery = "%".mysqli_real_escape_string($conn, $query)."%";

    // Select clients from the database
    $sql = "SELECT Client_Name FROM client WHERE Client_Name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $clients = array();
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row['Client_Name'];
        }
        echo json_encode($clients);
    } else {
        echo json_encode(array("success" => false, "message" => "No clients found"));
    }

    $stmt->close();
}

$conn->close();
?>