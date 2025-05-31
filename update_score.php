<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $score = $_POST['played_seconds'] ?? 0;
    $score = $_POST['score'] ?? 0;

    $datetime = date("Y-m-d H:i:s");
    $user_name = $_SESSION['user']['name'];

    $text = "Name: {$user_name} Score: {$score},\n Time: {$datetime}\n";

    file_put_contents("scores.txt", $text, FILE_APPEND);

    echo json_encode(["status" => "success", "message" => "Score saved!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Only POST method allowed"]);
}