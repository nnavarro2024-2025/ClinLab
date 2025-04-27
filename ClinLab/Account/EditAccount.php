<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


$student_id = $_POST['student_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$course_year = $_POST['course_year'];
$department = $_POST['department'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


if ($password !== $confirm_password) {
    echo "<script>
        alert('Passwords do not match.');
        window.history.back();
    </script>";
    exit;
}


$pdo = new PDO("mysql:host=localhost;dbname=account", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (!empty($password)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
} else {

    $stmt = $pdo->prepare("SELECT password FROM accounts WHERE student_id = ?");
    $stmt->execute([$student_id]);
    $current_password = $stmt->fetchColumn();
    $password = $current_password;
}


$query = "UPDATE accounts SET first_name = ?, last_name = ?, gender = ?, email = ?, phone = ?, course_year = ?, department = ?, password = ? WHERE student_id = ?";
$stmt = $pdo->prepare($query);
$result = $stmt->execute([$first_name, $last_name, $gender, $email, $phone, $course_year, $department, $password, $student_id]);

if ($result) {
    echo "<script>
        alert('Account updated successfully.');
        setTimeout(function() {
            window.location.href = '../View_record/View_record.html';
        }, 0);
    </script>";
} else {
    echo "<script>
        alert('Failed to update account.');
        window.history.back();
    </script>";
}
?>
