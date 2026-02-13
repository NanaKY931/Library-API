<?php
// Create a New Contact
// Method: POST
// Body: name=...&phone=... (optional: email=...)
// Returns: {"success": true, "data": {"id": <new_id>}}

require_once __DIR__ . '/../db.php';

$name  = isset($_POST['name'])  ? trim($_POST['name'])  : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : null;

if ($name === '' || $phone === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'name and phone are required']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO contacts (name, phone, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $phone, $email);

if ($stmt->execute()) {
    $newId = (int) $stmt->insert_id;
    echo json_encode(['success' => true, 'data' => ['id' => $newId]]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Insert failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
