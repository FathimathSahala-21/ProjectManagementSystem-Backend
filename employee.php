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

    $designation = $data['designation'];
    $email = $data['email'];
    $contact=$data['contact'];

    // Insert client details into the client table
    $sql = "INSERT INTO employee (Name1,Designation, Email,ContactNo) VALUES ( ?,?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $designation, $email,$contact);
    
    if ($stmt->execute()) {
        echo json_encode(array("success" => true, "message" => "Employee  added successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error adding employee"));
    }

    $stmt->close();


}

elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch project details from the project table
    $sql = "SELECT EmployeeID, Name1,Designation, Email,ContactNo FROM employee";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employees = array();
        while($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        echo json_encode($employees);
    }
 else {
    echo json_encode(array("success" => false, "message" => "Error adding employee"));
}


}

$conn->close();
?>





