<?php
// Read One Contact by ID
// Method: GET
// Params: ?id=<int>
// Returns: {"success": true, "data": {...}} or {"success": false, "error": "not found"}

require_once __DIR__ . '/../db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'id is required and must be numeric']);
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT id, name, phone, email, created_at FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'not found']);
    exit;
}

$contact = $result->fetch_assoc();
$contact['id'] = (int) $contact['id'];

echo json_encode(['success' => true, 'data' => $contact]);

$stmt->close();
$conn->close();
