<?php
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
    $EmployeeID = $data['EmployeeID'];
    $Name1 = $data['Name1'];
    $Designation = $data['Designation'];
    $Email=$data['Email'];
    $ContactNo = $data['ContactNo'];

    $sql = "UPDATE employee SET  Name1=?, Designation=?,Email=?,ContactNo=? WHERE EmployeeID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $Name1, $Designation, $Email,$ContactNo, $EmployeeID);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Employee updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating Employee";
    }

    echo json_encode($response);
}

$conn->close();
?>
