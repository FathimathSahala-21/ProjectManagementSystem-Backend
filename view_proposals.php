<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
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
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Update the SQL query to order by Proposal_ID in descending order
//$sql = "SELECT Proposal_ID, Proposal_name, Proposal_Type, Proposal_Date, Proposal_exp_date, budget, viewed, remark FROM proposal ORDER BY Proposal_ID DESC";
$sql = "SELECT Proposal_ID, Proposal_name, Proposal_Type, Proposal_Date, Proposal_exp_date, budget, viewed, remark ,Client_name,Client_address
        FROM proposal 
        ORDER BY 
          CASE 
            WHEN remark = 'accepted' THEN 1 
            ELSE 0 
          END, 
          Proposal_ID DESC";

$result = $conn->query($sql);

$proposals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $proposals[] = $row;
    }
}

$conn->close();

echo json_encode($proposals);
?>

