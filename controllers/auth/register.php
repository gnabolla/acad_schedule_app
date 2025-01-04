<?php
session_start();
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role']; // 'faculty' or 'student'
    
    // Basic check for duplicates
    $check = "SELECT id FROM users WHERE username = ?";
    $exists = $db->query($check, [$username])->fetch();
    if ($exists) {
        $error = "Username is already taken.";
        require 'views/auth/register.view.php';
        exit;
    }

    // Insert user with status = 'pending'
    $sql = "INSERT INTO users (username, password, role, status) VALUES (?, ?, ?, 'pending')";
    $db->query($sql, [$username, $password, $role]);

    header('Location: /login');
    exit;
} else {
    require 'views/auth/register.view.php';
}
