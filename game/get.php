<?php
header('Content-Type: application/json');

echo json_encode([
    'success' => true,
    'message' => 'Games fetched successfully!',
    'data' => [
        [
            'id' => 1,
            'user_id' => 1,
            'player_number' => 5,
            'link' => 'https://example.com/game',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'user_id' => 2,
            'player_number' => 10,
            'link' => 'https://example.com/game2',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ]
]);
exit;
