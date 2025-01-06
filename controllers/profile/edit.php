<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');
$userId = $_SESSION['user_id'];

$user = $db->query("SELECT * FROM users WHERE id = ?", [$userId])->fetch();
if (!$user) {
    http_response_code(404);
    echo "User not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword     = $_POST['old_password'] ?? '';
    $newPassword     = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (!password_verify($oldPassword, $user['password'])) {
        $error = "Incorrect old password.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "New passwords do not match.";
    } else {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $db->query("UPDATE users SET password = ? WHERE id = ?", [$hashed, $userId]);
        header('Location: /profile/edit?success=1');
        exit;
    }
}

require 'views/profile/edit.view.php';
