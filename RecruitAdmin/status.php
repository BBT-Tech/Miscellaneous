<?php
session_start();

header('Content-Type: application/json');

echo json_encode([
    'ojbk' => isset($_SESSION['name']),
    'name' => $_SESSION['name']
]);
