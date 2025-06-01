<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ./login/');
    exit;
}

include "../config.php";
$db = new Database();

$user_id = $_SESSION['user']['id'];

$games = $db->select(
    'games',
    '*',
    'user_id = ? ORDER BY created_at DESC',
    [$user_id],
    'i'
);

echo json_encode([
    'success' => true,
    'message' => 'Games fetched successfully!',
    'data' => $games
]);
exit;
