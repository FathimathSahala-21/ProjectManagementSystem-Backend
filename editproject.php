<?php
/*header('Content-Type: application/json');
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
    $id = $data['Project_ID'];
    $name = $data['Project_name'];
    $type = $data['Project_type'];
    $date = $data['Project_date'];

    $sql = "UPDATE project SET Project_name=?, Project_type=?, Project_date=? WHERE Project_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $type, $date, $id);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Project updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating project";
    }

    echo json_encode($response);
}

$conn->close();
?>
*/




header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, OPTIONS");
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
    $id = $data['Project_ID'];
    $name = $data['Project_name'];
    $type = $data['Project_type'];
    $date = $data['Project_date'];

    // Validate date format (YYYY-MM-DD)
    $date_valid = preg_match("/^\d{4}-\d{2}-\d{2}$/", $date);

    if (!$date_valid) {
        echo json_encode(array("success" => false, "message" => "Invalid date format"));
        exit;
    }

    // Check if Project_name already exists
    $check_sql = "SELECT COUNT(*) AS count FROM project WHERE Project_name = ? AND Project_ID != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $name, $id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();

    if ($check_row['count'] > 0) {
        echo json_encode(array("success" => false, "message" => "Project name already exists"));
        exit;
    }

    $sql = "UPDATE project SET Project_name=?, Project_type=?, Project_date=? WHERE Project_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $type, $date, $id);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Project updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating project";
    }

    echo json_encode($response);
}

// Handle GET request for fetching projects
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch project details from the project table
    $sql = "SELECT Project_ID, Project_name, Project_type, Project_date FROM project";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $projects = array();
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        echo json_encode($projects);
    } else {
        echo json_encode(array("success" => false, "message" => "No projects found"));
    }
}

$conn->close();
?>
