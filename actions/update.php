<?php
// Update an Existing Contact
// Method: POST
// Body: id=...&name=...&phone=... (optional: email=...)
// Returns: {"success": true} or {"success": false, "error": "..."}

require_once __DIR__ . '/../db.php';

$id    = isset($_POST['id'])    ? (int) $_POST['id']       : 0;
$name  = isset($_POST['name'])  ? trim($_POST['name'])     : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone'])    : '';
$email = isset($_POST['email']) ? trim($_POST['email'])    : null;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'id is required']);
    exit;
}

if ($name === '' || $phone === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'name and phone are required']);
    exit;
}

$stmt = $conn->prepare("UPDATE contacts SET name = ?, phone = ?, email = ? WHERE id = ?");
$stmt->bind_param("sssi", $name, $phone, $email, $id);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    // Check if the row actually exists
    $check = $conn->prepare("SELECT id FROM contacts WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'not found']);
    } else {
        // Row exists but nothing changed (same data submitted)
        echo json_encode(['success' => true]);
    }
    $check->close();
} else {
    echo json_encode(['success' => true]);
}

$stmt->close();
$conn->close();
