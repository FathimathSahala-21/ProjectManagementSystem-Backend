
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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['designation'])) {
        // Fetch employees based on the selected designation
        $designation = $_GET['designation'];
        $sql = "SELECT Name1 FROM employee WHERE designation = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $designation);
        $stmt->execute();
        $result = $stmt->get_result();

        $employees = array();
        while($row = $result->fetch_assoc()) {
            $employees[] = $row['Name1'];
        }

        echo json_encode($employees);
    } else {
        // Fetch unique designations
        $sql = "SELECT DISTINCT designation FROM employee";
        $result = $conn->query($sql);

        $designations = array();
        while($row = $result->fetch_assoc()) {
            $designations[] = $row['designation'];
        }

        echo json_encode($designations);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $designation = $data['designation'];
    $employee = $data['employee'];
    $password = $data['password'];

    // Fetch Employee IDs with the selected designation
    $sql_insert = "INSERT INTO register (Username, Password1, Designation) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sss", $employee, $password, $designation);
    $stmt_insert->execute();

    echo json_encode(array("message" => "User(s) created successfully"));
}

$conn->close();
?>