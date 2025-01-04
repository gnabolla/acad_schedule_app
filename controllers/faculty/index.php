<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "Forbidden";
    exit;
}

require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

// Example: join users table to see username if user_id is linked
$sql = "
    SELECT f.*, u.username
    FROM faculties f
    LEFT JOIN users u ON f.user_id = u.id
    ORDER BY f.id DESC
";
$faculties = $db->query($sql)->fetchAll();

require 'views/faculty/index.view.php';
