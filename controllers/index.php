<?php
session_start();
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

if (!isset($_SESSION['user_id'])) {
    require 'views/index.view.php';
    exit;
}

$user = $db->query("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch();
if ($user) {
    $_SESSION['status'] = $user['status'];
}

if ($_SESSION['status'] === 'pending') {
    require 'views/pending.view.php';
    exit;
} elseif ($_SESSION['status'] === 'active') {
    require 'views/index.view.php';
    exit;
} else {
    // Fallback in case 'rejected' or something else sneaks through
    session_destroy();
    header('Location: /login');
    exit;
}
