<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

// Check if user already has faculty record
$userId = $_SESSION['user_id'];
$existing = $db->query("SELECT * FROM faculties WHERE user_id = ?", [$userId])->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname  = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname   = $_POST['lastname'];

    if ($existing) {
        // Update existing
        $sql = "UPDATE faculties SET firstname=?, middlename=?, lastname=? WHERE user_id=?";
        $db->query($sql, [$firstname, $middlename, $lastname, $userId]);
    } else {
        // Insert new
        $sql = "INSERT INTO faculties (user_id, firstname, middlename, lastname) VALUES (?, ?, ?, ?)";
        $db->query($sql, [$userId, $firstname, $middlename, $lastname]);
    }
    header('Location: /');
    exit;
} else {
    require 'views/profile/complete.view.php';
}
