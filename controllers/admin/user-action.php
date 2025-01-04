<?php
session_start();
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

// Check if admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "Forbidden";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $action = $_POST['action']; // 'approve' or 'reject'
    
    if ($action === 'approve') {
        $db->query("UPDATE users SET status='active' WHERE id = ?", [$userId]);
    } elseif ($action === 'reject') {
        $db->query("UPDATE users SET status='rejected' WHERE id = ?", [$userId]);
    }
}
header("Location: /admin/users");
exit;
