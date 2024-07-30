<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

header('Content-Type: application/json');

$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type === 'project_types') {
    $sql = "SELECT DISTINCT Project_type FROM project";
    $result = $conn->query($sql);

    $projectTypes = [];
    while ($row = $result->fetch_assoc()) {
        $projectTypes[] = $row;
    }

    echo json_encode($projectTypes);

} elseif ($type === 'project_names' && isset($_GET['project_type'])) {
    $projectType = $_GET['project_type'];
    $sql = "SELECT Project_name FROM project WHERE Project_type='$projectType'";
    $result = $conn->query($sql);

    $projectNames = [];
    while ($row = $result->fetch_assoc()) {
        $projectNames[] = $row;
    }

    echo json_encode($projectNames);

} elseif ($type === 'designations') {
    $sql = "SELECT DISTINCT Designation FROM employee";
    $result = $conn->query($sql);

    $designations = [];
    while ($row = $result->fetch_assoc()) {
        $designations[] = $row;
    }

    echo json_encode($designations);

} elseif ($type === 'employee_names' && isset($_GET['designation'])) {
    $designation = $_GET['designation'];
    $sql = "SELECT Name1 FROM employee WHERE Designation='$designation'";
    $result = $conn->query($sql);

    $employeeNames = [];
    while ($row = $result->fetch_assoc()) {
        $employeeNames[] = $row;
    }

    echo json_encode($employeeNames);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $projectType = $data['projectType'];
    $projectName = $data['projectName'];
    $employeeAssignments = $data['employeeAssignments'];

    // Fetch Project_ID from project table
    $sql = "SELECT Project_ID FROM project WHERE Project_name='$projectName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $projectId = $row['Project_ID'];

    foreach ($employeeAssignments as $assignment) {
        $designation = $assignment['designation'];
        foreach ($assignment['employees'] as $employeeName) {
            // Fetch EmployeeID from employee table
            $sql = "SELECT EmployeeID FROM employee WHERE Name1='$employeeName' AND Designation='$designation'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $employeeId = $row['EmployeeID'];

            // Insert into assign table
            $sql = "INSERT INTO assign (Proj_ID, proj_type, proj_name, emp_desig, emp_name, Emp_ID) VALUES ('$projectId', '$projectType', '$projectName', '$designation', '$employeeName', '$employeeId')";
            if (!$conn->query($sql)) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
                exit;
            }
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
}

$conn->close();
?>
