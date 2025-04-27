<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'] ?? '';
error_log("Search Term: $search"); 

if (empty($search)) {
    echo json_encode([]);
    exit;
}

$search = $conn->real_escape_string($search);


$sql = "SELECT first_name, last_name, course_year, student_id, department 
        FROM accounts 
        WHERE first_name LIKE ? OR last_name LIKE ? OR student_id LIKE ?";

error_log("SQL Query: $sql"); 


if (!$stmt = $conn->prepare($sql)) {
    echo json_encode(["error" => "Failed to prepare the query"]);
    exit;
}

$search_param = "%$search%";
$stmt->bind_param("sss", $search_param, $search_param, $search_param);


if (!$stmt->execute()) {
    echo json_encode(["error" => "Query execution failed: " . $stmt->error]);
    exit;
}

$result = $stmt->get_result();
$accounts = [];

while ($row = $result->fetch_assoc()) {
    $accounts[] = $row;
}

echo json_encode($accounts);


$stmt->close();
$conn->close();

?>
