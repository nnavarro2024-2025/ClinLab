<?php
header('Content-Type: application/json');

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    http_response_code(400);
    echo json_encode(['error' => 'No student ID provided.']);
    exit;
}

$student_id = trim($_GET['id']);

try {
    $pdo = new PDO('mysql:host=localhost;dbname=account;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT student_id, first_name, last_name, gender, email, phone, course_year, department FROM accounts WHERE student_id = ?");
    $stmt->execute([$student_id]);

    $account = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($account) {
        echo json_encode($account);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Account not found.']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
