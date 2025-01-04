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
    header('Location: /admin/semesters');
    exit;
}

// Fetch existing record
$semester = $db->query("SELECT * FROM semesters WHERE id = ?", [$id])->fetch();
if (!$semester) {
    echo "Record not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sy_id       = $_POST['sy_id'];
    $semester_no = $_POST['semester_no'];
    $label       = $_POST['label'];
    $start_date  = $_POST['start_date'];
    $end_date    = $_POST['end_date'];

    $sql = "UPDATE semesters
            SET sy_id=?, semester_no=?, label=?, start_date=?, end_date=?
            WHERE id=?";
    $db->query($sql, [$sy_id, $semester_no, $label, $start_date, $end_date, $id]);

    header('Location: /admin/semesters');
    exit;
}

require 'views/admin/semester/edit.view.php';
