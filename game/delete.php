<?php

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Game link deleted successfully'
]);
exit;
