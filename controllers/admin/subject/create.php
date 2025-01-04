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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code        = $_POST['code'];
    $description = $_POST['description'];
    $is_lab      = isset($_POST['is_lab']) ? 1 : 0;
    $department  = $_POST['department'];
    $units       = $_POST['units'] ?: null;
    $is_major    = isset($_POST['is_major']) ? 1 : 0;

    $sql = "INSERT INTO subjects (code, description, is_lab, department, units, is_major)
            VALUES (?, ?, ?, ?, ?, ?)";
    $db->query($sql, [$code, $description, $is_lab, $department, $units, $is_major]);

    header('Location: /admin/subjects');
    exit;
}

require 'views/admin/subject/create.view.php';
