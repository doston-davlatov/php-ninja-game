<?php

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Game link created successfully'
]);
exit;
