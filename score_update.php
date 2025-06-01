<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user_name = $_SESSION['user']['name'];
    $score = (int) $_POST['score'] ?? 0;
    $played_seconds = (int) $_POST['played_seconds'] ?? 0;

    $text = "Name: {$user_name} Score: {$score}, Played_seconds: {$played_seconds}\n";

    file_put_contents("scores.txt", $text, FILE_APPEND);

    echo json_encode([
        "status" => "success",
        "message" => "Score saved!",
        "data" => [
            "name" => $user_name,
            "score" => $score,
            "played_seconds" => $played_seconds
        ]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Only POST method allowed"
    ]);
}