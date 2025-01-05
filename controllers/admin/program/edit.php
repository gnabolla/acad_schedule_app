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
if (!$id) {
    header('Location: /admin/programs');
    exit;
}

// 1) Fetch the program record
$program = $db->query("SELECT * FROM programs WHERE id = ?", [$id])->fetch();
if (!$program) {
    echo "Record not found.";
    exit;
}

// 2) Fetch all departments for the dropdown
$departments = $db->query("SELECT id, name FROM departments ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $department_id = $_POST['department_id'] ?? null;  // new
    $name          = $_POST['name'] ?? '';
    $description   = $_POST['description'] ?? null;

    $sql = "UPDATE programs
            SET department_id = ?, name = ?, description = ?
            WHERE id = ?";
    $db->query($sql, [$department_id, $name, $description, $id]);

    header('Location: /admin/programs');
    exit;
}

require 'views/admin/program/edit.view.php';
