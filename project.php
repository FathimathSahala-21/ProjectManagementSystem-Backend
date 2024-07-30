<?php
/*header('Content-Type: application/json');
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
    $type1 = $data['type1'];
    $date1 = $data['date1'];

    // Check if project name already exists
    $sql = "SELECT Project_name FROM project WHERE Project_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(array("success" => false, "message" => "Project name already exists"));
    } else {
        // Insert project details into the project table
        $sql = "INSERT INTO project (Project_name, Project_type, Project_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $type1, $date1);
        
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Project added successfully"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error adding project"));
        }
    }
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $sql = "SELECT Project_name FROM project WHERE Project_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            echo json_encode(array("exists" => true));
        } else {
            echo json_encode(array("exists" => false));
        }
        $stmt->close();
    } else {
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
}

$conn->close();
?>*/

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
    $type1 = $data['type1'];
    $date1 = $data['date1'];

    // Check if project name already exists
    $sql = "SELECT Project_name FROM project WHERE Project_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(array("success" => false, "message" => "Project name already exists"));
    } else {
        // Insert project details into the project table
        $sql = "INSERT INTO project (Project_name, Project_type, Project_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $type1, $date1);
        
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Project added successfully"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error adding project"));
        }
    }
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $sql = "SELECT Project_name FROM project WHERE Project_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            echo json_encode(array("exists" => true));
        } else {
            echo json_encode(array("exists" => false));
        }
        $stmt->close();
    } else {
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
}

$conn->close();
?>