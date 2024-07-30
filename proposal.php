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
    $date2 = $data['date2'];
    $budget = $data['budget'];
    $clientname= $data['clientname'];
    $clientaddress=$data['clientaddress'];
    $existing=$data['existing'];
    // Insert client details into the client table
    $sql = "INSERT INTO proposal (Proposal_name,Proposal_Type, Proposal_Date, Proposal_exp_date , budget,Client_name,Client_address,existing) VALUES ( ?, ?, ?, ?, ?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $type1, $date1, $date2, $budget,$clientname,$clientaddress,$existing);
    
    if ($stmt->execute()) {
        echo json_encode(array("success" => true, "message" => "Proposal added successfully"));
    }
    else {
        echo json_encode(array("success" => false, "message" => "Error adding proposal"));
    }
    $stmt->close();
}
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch project details from the project table
        $sql = "SELECT Proposal_ID, Proposal_name, Proposal_Type, Proposal_Date, Proposal_exp_date , budget,Client_name,Client_address FROM proposal";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $projects = array();
            while($row = $result->fetch_assoc()) {
                $projects[] = $row;
            }
            echo json_encode($projects);
        }
     else {
        echo json_encode(array("success" => false, "message" => "Error adding proposal"));
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
$dbname = "dinesh2";

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
    $date2 = $data['date2'];
    $budget = $data['budget'];
    $clientname= $data['clientname'];
    $clientaddress=$data['clientaddress'];
    $existing=$data['existing'];

    // Insert client details into the client table
    $sql = "INSERT INTO proposal (Proposal_name,Proposal_Type, Proposal_Date, Proposal_exp_date , budget,Client_name,Client_address,existing ) VALUES ( ?, ?, ?, ?, ?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $type1, $date1, $date2, $budget,$clientname,$clientaddress,$existing);
    
    if ($stmt->execute()) {
        echo json_encode(array("success" => true, "message" => "Proposal added successfully"));
    }
    else {
        echo json_encode(array("success" => false, "message" => "Error adding proposal"));
    }
    $stmt->close();
}
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch project details from the project table
        $sql = "SELECT Proposal_ID, Proposal_name, Proposal_Type, Proposal_Date, Proposal_exp_date , budget FROM proposal";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $projects = array();
            while($row = $result->fetch_assoc()) {
                $projects[] = $row;
            }
            echo json_encode($projects);
        }
     else {
        echo json_encode(array("success" => false, "message" => "Error adding proposal"));
    }

    
}

$conn->close();
?>
