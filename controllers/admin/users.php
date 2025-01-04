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

// Get all users
$users = $db->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
require 'views/admin/users.view.php';
