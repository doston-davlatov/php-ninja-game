<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode([
        'success' => false,
        'message' => 'You must be logged in to delete a game.'
    ]);
    exit;
}

include "../config.php";
$db = new Database();

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Only POST method is allowed'
    ]);
    exit;
}

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode([
        'success' => false,
        'message' => 'ID is required.'
    ]);
    exit;
}

$deleted = $db->delete('games', 'id = ? AND user_id = ?', [$id, $user_id], 'ii');

if ($deleted) {
    echo json_encode([
        'success' => true,
        'message' => 'Game link deleted successfully.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to delete game. Please try again.'
    ]);
}
exit;
