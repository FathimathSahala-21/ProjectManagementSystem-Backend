 <?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    http_response_code(200);
    exit();
}



// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinesh"; // Replace with your database name

// Get POST data
$data = json_decode(file_get_contents("php://input"));

if (!$data || empty($data->newPassword) || empty($data->confirmPassword) || empty($data->loggedInUser)) {
    echo json_encode(array("message" => "Missing parameters"));
    http_response_code(400);
    exit();
}

$newPassword = $data->newPassword;
$confirmPassword = $data->confirmPassword;
$loggedInUser = $data->loggedInUser;

// Validate passwords
if ($newPassword !== $confirmPassword) {
    echo json_encode(array("message" => "Passwords do not match"));
    http_response_code(400);
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update query
$sql = "UPDATE register SET Password1 = ? WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $newPassword, $loggedInUser);

if ($stmt->execute()) {
    echo json_encode(array("message" => "Password updated successfully"));
} else {
    echo json_encode(array("message" => "Error updating password: " . $conn->error));
    http_response_code(500);
}

$stmt->close();
$conn->close();
?>
