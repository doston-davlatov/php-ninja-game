<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login/');
    exit;
}

include "../config.php";
$db = new Database();

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$game = $db->select('games', '*', 'link = ?', [$link], 's');
if (!isset($game[0]['id'])) {
    header('Location: ../');
    exit;
}
$game_id = $game[0]['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/game.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Black Ninja</title>
    <script>const game_id = <?= json_encode($game_id); ?>;</script>
</head>

<body>
    <div class="container">
        <button class="leaderboard-button" id="leaderboard-button">All Scores</button>
        <div class="score-modal" id="score-modal">
            <div class="score-modal-content">
                <button class="close-modal" id="close-modal">×</button>
                <h2>Leaderboard</h2>
                <table class="score-table">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Score</th>
                            <th>Time (s)</th>
                        </tr>
                    </thead>
                    <tbody id="score-table-body"></tbody>
                </table>
            </div>
        </div>
        <div class="result">
            <div id="score"></div>
            <div id="time"></div>
        </div>
        <canvas id="game" width="375" height="375"></canvas>
        <div id="introduction">Tayoqni cho'zish uchun sichqonchani bosib turing</div>
        <div id="perfect">Ajoyib</div>
        <button id="restart">RESTART</button>
    </div>

    <script src="../src/js/game.js"></script>
</body>

</html>