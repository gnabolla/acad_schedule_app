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

$program = $db->query("SELECT * FROM programs WHERE id = ?", [$id])->fetch();
if (!$program) {
    echo "Record not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = $_POST['name'];
    $description = $_POST['description'] ?? null;
    $sql = "UPDATE programs SET name=?, description=? WHERE id=?";
    $db->query($sql, [$name, $description, $id]);
    header('Location: /admin/programs');
    exit;
}

require 'views/admin/program/edit.view.php';
