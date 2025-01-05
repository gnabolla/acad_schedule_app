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

// 1) Fetch department list for dropdown
$departments = $db->query("SELECT id, name FROM departments ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $department_id = $_POST['department_id'] ?? null;  // new
    $name          = $_POST['name'] ?? '';
    $description   = $_POST['description'] ?? null;

    $sql = "INSERT INTO programs (department_id, name, description)
            VALUES (?, ?, ?)";
    $db->query($sql, [$department_id, $name, $description]);

    header('Location: /admin/programs');
    exit;
}

// 2) Pass the $departments array to the view
require 'views/admin/program/create.view.php';
