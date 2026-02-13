<?php
// Database connection helper
// Included by every endpoint — sets JSON header and provides $conn

header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = 'DestinyV1sion!';
$db   = 'mobileapps_2026B_nana_yirenkyi';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'Database connection failed: ' . $conn->connect_error
    ]);
    exit;
}
