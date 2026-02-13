<?php
// Read All Contacts
// Method: GET
// Returns: {"success": true, "data": [{...}, ...]}

require_once __DIR__ . '/../db.php';

$sql    = "SELECT id, name, phone, email, created_at FROM contacts ORDER BY id ASC";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Query failed: ' . $conn->error]);
    exit;
}

$contacts = [];
while ($row = $result->fetch_assoc()) {
    $row['id'] = (int) $row['id'];
    $contacts[] = $row;
}

echo json_encode(['success' => true, 'data' => $contacts]);

$conn->close();
