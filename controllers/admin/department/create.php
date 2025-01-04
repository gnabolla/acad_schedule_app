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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = $_POST['name'];
    $description = $_POST['description'] ?? null;
    $sql = "INSERT INTO departments (name, description) VALUES (?, ?)";
    $db->query($sql, [$name, $description]);
    header('Location: /admin/departments');
    exit;
}

require 'views/admin/department/create.view.php';
