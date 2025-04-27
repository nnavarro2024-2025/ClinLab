<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$gender = $_POST['gender'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$course_year = $_POST['course_year'] ?? '';
$student_id = $_POST['student_id'] ?? '';
$department = $_POST['department'] ?? '';
$password = $_POST['password'] ?? '';


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO accounts (
    first_name, last_name, gender, email, phone, course_year, 
    student_id, department, password
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?
)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssss",
    $first_name, $last_name, $gender, $email, $phone, 
    $course_year, $student_id, $department, $hashed_password
);


if ($stmt->execute()) {
    echo "<script>
        alert('New account created successfully!');
        setTimeout(function() {
            window.location.href = '../Account/Add_Account.html';
        }, 0);
    </script>";
} else {
    echo "<script>
        alert('Error: " . addslashes($stmt->error) . "');
        window.history.back();
    </script>";
}


$stmt->close();
$conn->close();
?>