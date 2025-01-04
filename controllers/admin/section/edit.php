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
    header('Location: /admin/sections');
    exit;
}

// Fetch existing record
$sec = $db->query("SELECT * FROM sections WHERE id = ?", [$id])->fetch();
if (!$sec) {
    echo "Record not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $program       = $_POST['program'];
    $year_level    = $_POST['year_level'];
    $section       = $_POST['section'];
    $department    = $_POST['department'] ?: null;
    $semester_id   = $_POST['semester_id'];
    $curriculum_id = $_POST['curriculum_id'];
    $archived      = isset($_POST['archived']) ? 1 : 0;

    $sql = "UPDATE sections
            SET program=?, year_level=?, section=?, department=?, semester_id=?, curriculum_id=?, archived=?
            WHERE id=?";
    $db->query($sql, [$program, $year_level, $section, $department, $semester_id, $curriculum_id, $archived, $id]);

    header('Location: /admin/sections');
    exit;
}

require 'views/admin/section/edit.view.php';
