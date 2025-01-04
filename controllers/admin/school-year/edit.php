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
    header('Location: /admin/school-years');
    exit;
}

// Fetch existing record
$sy = $db->query("SELECT * FROM school_years WHERE id = ?", [$id])->fetch();
if (!$sy) {
    echo "Record not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    $sql = "UPDATE school_years
            SET name=?, start_date=?, end_date=?
            WHERE id=?";
    $db->query($sql, [$name, $start_date, $end_date, $id]);
    header('Location: /admin/school-years');
    exit;
}

require 'views/admin/school-year/edit.view.php';
