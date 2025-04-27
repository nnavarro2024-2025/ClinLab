<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? ''; 

if (empty($id)) {
    echo json_encode(["error" => "ID is required"]);
    exit;
}


$id = $conn->real_escape_string($id);


$sql = "DELETE FROM accounts WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Failed to delete account"]);
}

$stmt->close();
$conn->close();
?>