<?php
// Delete a Contact
// Method: POST
// Body: id=...
// Returns: {"success": true} or {"success": false, "error": "..."}

require_once __DIR__ . '/../db.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'id is required']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'not found']);
} else {
    echo json_encode(['success' => true]);
}

$stmt->close();
$conn->close();
