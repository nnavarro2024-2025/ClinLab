<?php

$servername = "localhost";
$username = "root"; 
$password = "";    
$dbname = "account";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$blood_type = $_POST['blood-type'] ?? '';
$student_name = $_POST['blood-type-student-name'] ?? '';
$age = $_POST['blood-type-student-age'] ?? '';
$gender = $_POST['blood-type-student-gender'] ?? '';
$course_year = $_POST['blood-type-course-year'] ?? '';
$student_id = $_POST['blood-type-student-id'] ?? '';
$department = $_POST['blood-type-student-department'] ?? '';
$date = $_POST['blood-type-date'] ?? '';
$lab_number = $_POST['blood-type-lab-number'] ?? '';
$physician = $_POST['blood-type-physician'] ?? '';

$sql = "INSERT INTO blood_type_reports (student_name, age, gender, course_year, student_id, department, date, lab_number, physician, blood_type) 
VALUES ('$student_name', '$age', '$gender', '$course_year', '$student_id', '$department', '$date', '$lab_number', '$physician', '$blood_type')";


if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Blood type report recorded successfully!');
        setTimeout(function() {
            window.location.href = '../View_record/View_record.html';
        }, 0);
    </script>";
} else {
    echo "<script>
        alert('Failed to Record Student Blood type report.');
        window.history.back();
    </script>";
}
$conn->close();
?>
