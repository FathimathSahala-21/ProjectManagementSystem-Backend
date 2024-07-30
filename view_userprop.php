<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

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

$sql = "SELECT Proposal_ID, Proposal_name, Proposal_Type, Proposal_Date, Proposal_exp_date, budget ,Client_name,Client_address, remark FROM proposal ORDER BY Proposal_ID DESC";
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