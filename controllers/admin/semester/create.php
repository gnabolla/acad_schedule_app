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
    $sy_id       = $_POST['sy_id'];
    $semester_no = $_POST['semester_no'];
    $label       = $_POST['label'];
    $start_date  = $_POST['start_date'];
    $end_date    = $_POST['end_date'];

    $sql = "INSERT INTO semesters (sy_id, semester_no, label, start_date, end_date)
            VALUES (?, ?, ?, ?, ?)";
    $db->query($sql, [$sy_id, $semester_no, $label, $start_date, $end_date]);

    header('Location: /admin/semesters');
    exit;
}

require 'views/admin/semester/create.view.php';
