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
    $program       = $_POST['program'];
    $year_level    = $_POST['year_level'];
    $section       = $_POST['section'];
    $department    = $_POST['department'] ?: null;
    $semester_id   = $_POST['semester_id'];
    $curriculum_id = $_POST['curriculum_id'];
    
    // If you're handling archived as checkbox (default 0 if not checked)
    $archived      = isset($_POST['archived']) ? 1 : 0;

    $sql = "INSERT INTO sections 
            (program, year_level, section, department, semester_id, curriculum_id, archived)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $db->query($sql, [$program, $year_level, $section, $department, $semester_id, $curriculum_id, $archived]);

    header('Location: /admin/sections');
    exit;
}

require 'views/admin/section/create.view.php';
