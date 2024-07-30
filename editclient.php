<?php
/*
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

// Handle PUT request for updating project
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true); // Decode JSON data
    $id = $data['Client_ID'];
    $name = $data['Client_Name'];
    $email = $data['Email'];
    $address1 = $data['Address1'];
    $contact = $data['Contact'];

    $sql = "UPDATE client SET Client_Name=?, Email=?, Address1=?, Contact=? WHERE Client_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $address1, $contact, $id);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Client updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating client";
    }

    echo json_encode($response);
}

$conn->close();
?>
*/




header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

// Handle PUT request for updating client
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true); // Decode JSON data
    $id = $data['Client_ID'];
    $name = $data['Client_Name'];
    $email = $data['Email'];
    $address1 = $data['Address1'];
    $contact = $data['Contact'];


    $sql = "UPDATE client SET Client_Name=?, Email=?, Address1=?, Contact=? WHERE Client_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $address1, $contact, $id);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Client updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating client";
    }

    echo json_encode($response);
}

$conn->close();
?>
