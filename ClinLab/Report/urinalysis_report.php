<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$color = $_POST['color'] ?? '';
$clarity = $_POST['clarity'] ?? '';
$ph = is_numeric($_POST['ph']) ? $_POST['ph'] : null;
$glucose = $_POST['glucose'] ?? '';
$specific_gravity = $_POST['specific-gravity'] ?? '';
$albumin = $_POST['albumin'] ?? '';
$pus_result = $_POST['pus-result'] ?? '';
$rbc_result = $_POST['rbc-result'] ?? '';
$renal_cell = $_POST['renal-cell'] ?? '';
$epithelial_cell = $_POST['epithelial-cell'] ?? '';
$mucus_thread = $_POST['mucus-thread'] ?? '';
$bacteria = $_POST['bacteria'] ?? '';
$yeast_cells = $_POST['yeast-cells'] ?? '';
$amorphous = $_POST['amorphous'] ?? '';
$coarse_granular_cast = $_POST['coarse-granular-cast'] ?? '';
$fine_granular_cast = $_POST['fine-granular-cast'] ?? '';
$hyaline_cast = $_POST['hyaline-cast'] ?? '';
$uric_acid = $_POST['uric-acid'] ?? '';
$calcium_oxalate = $_POST['calcium-oxalate'] ?? '';
$triple_phosphate = $_POST['triple-phosphate'] ?? '';
$others = $_POST['others'] ?? '';
$name = $_POST['urinalysis-rep-student-name'] ?? '';
$age = is_numeric($_POST['urinalysis-rep-student-age']) ? $_POST['urinalysis-rep-student-age'] : null;
$gender = $_POST['gender'] ?? '';
$course_year = $_POST['urinalysis-rep-course-year'] ?? ''; 
$student_id = $_POST['urinalysis-rep-student-id'] ?? '';
$department = $_POST['urinalysis-rep-student-department'] ?? '';
$date = $_POST['urinalysis-rep-date'] ?? '';
$lab_number = $_POST['urinalysis-rep-lab-number'] ?? '';
$physician = $_POST['urinalysis-rep-physician'] ?? '';

$sql = "INSERT INTO urinalysis_report (
    color, clarity, ph, glucose, specific_gravity, albumin, pus_result, rbc_result, renal_cell, 
    epithelial_cell, mucus_thread, bacteria, yeast_cells, amorphous, coarse_granular_cast, 
    fine_granular_cast, hyaline_cast, uric_acid, calcium_oxalate, triple_phosphate, others, 
    name, age, gender, course_year, student_id, department, date, lab_number, physician
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";


$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssssssssssssssssssssssss",
    $color, $clarity, $ph, $glucose, $specific_gravity, $albumin, $pus_result, $rbc_result, 
    $renal_cell, $epithelial_cell, $mucus_thread, $bacteria, $yeast_cells, $amorphous, 
    $coarse_granular_cast, $fine_granular_cast, $hyaline_cast, $uric_acid, $calcium_oxalate, 
    $triple_phosphate, $others, $name, $age, $gender, $course_year, $student_id, $department, 
    $date, $lab_number, $physician
);


if ($stmt->execute()) {
    echo "<script>
        alert('Record inserted successfully!');
        setTimeout(function() {
            window.location.href = '../View_record/View_record.html';
        }, 0);
    </script>";
} else {
    echo "<script>
        alert('Failed to Record Student information.');
        window.history.back();
    </script>";
}


// Close connection
$stmt->close();
$conn->close();
?>
