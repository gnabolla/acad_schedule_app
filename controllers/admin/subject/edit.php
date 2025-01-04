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

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /admin/subjects');
    exit;
}

$subject = $db->query("SELECT * FROM subjects WHERE id = ?", [$id])->fetch();
if (!$subject) {
    echo "Record not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code        = $_POST['code'];
    $description = $_POST['description'];
    $is_lab      = isset($_POST['is_lab']) ? 1 : 0;
    $department  = $_POST['department'];
    $units       = $_POST['units'] ?: null;
    $is_major    = isset($_POST['is_major']) ? 1 : 0;

    $sql = "UPDATE subjects
            SET code=?, description=?, is_lab=?, department=?, units=?, is_major=?
            WHERE id=?";
    $db->query($sql, [$code, $description, $is_lab, $department, $units, $is_major, $id]);

    header('Location: /admin/subjects');
    exit;
}

require 'views/admin/subject/edit.view.php';
