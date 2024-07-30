<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinesh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the proposal ID from the request
$data = json_decode(file_get_contents('php://input'), true);
$proposalId = $data['id'] ?? null;

if ($proposalId === null) {
    die(json_encode(['success' => false, 'message' => 'Invalid proposal ID']));
}

// Update the remark field for the specified proposal
$sql = "UPDATE proposal SET remark = 'accepted' WHERE Proposal_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $proposalId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating proposal: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
