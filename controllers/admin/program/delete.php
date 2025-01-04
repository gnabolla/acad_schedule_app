<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "Forbidden";
    exit;
}
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database']);

$id = $_GET['id'] ?? null;
if ($id) {
    $db->query("DELETE FROM programs WHERE id = ?", [$id]);
}
header('Location: /admin/programs');
exit;
