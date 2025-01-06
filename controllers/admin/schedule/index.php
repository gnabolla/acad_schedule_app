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

// Gather filters
$faculty_id   = $_GET['faculty_id']   ?? '';
$room_id      = $_GET['room_id']      ?? '';
$section_id   = $_GET['section_id']   ?? '';
$subject_id   = $_GET['subject_id']   ?? '';
$program_id   = $_GET['program_id']   ?? '';
$department_id= $_GET['department_id']?? '';
$semester_id  = $_GET['semester_id']  ?? '';
$school_year_id = $_GET['school_year_id'] ?? '';

$whereClauses = [];
$params       = [];

if ($faculty_id) {
    $whereClauses[] = 's.faculty_id = ?';
    $params[]       = $faculty_id;
}
if ($room_id) {
    $whereClauses[] = 's.room_id = ?';
    $params[]       = $room_id;
}
if ($section_id) {
    $whereClauses[] = 's.section_id = ?';
    $params[]       = $section_id;
}
if ($subject_id) {
    $whereClauses[] = 's.subject_id = ?';
    $params[]       = $subject_id;
}
if ($semester_id) {
    $whereClauses[] = 's.semester_id = ?';
    $params[]       = $semester_id;
}
// If you store program/department/school_year in schedules table, do similar checks here

$whereString = '';
if (!empty($whereClauses)) {
    $whereString = 'WHERE ' . implode(' AND ', $whereClauses);
}

$sql = "
    SELECT s.*,
           f.firstname AS faculty_fname, f.lastname AS faculty_lname,
           r.name AS room_name,
           sub.code AS subject_code, sub.description AS subject_desc,
           sec.section AS section_name
    FROM schedules s
    JOIN faculties f ON s.faculty_id = f.id
    JOIN rooms r     ON s.room_id = r.id
    LEFT JOIN subjects sub  ON s.subject_id = sub.id
    LEFT JOIN sections sec  ON s.section_id = sec.id
    $whereString
    ORDER BY FIELD(s.day,'Mon','Tue','Wed','Thu','Fri'), s.start_time
";
$schedules = $db->query($sql, $params)->fetchAll();

if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($schedules);
    exit;
}

$faculties = $db->query("SELECT id, firstname, middlename, lastname FROM faculties ORDER BY lastname, firstname")->fetchAll();
$sections  = $db->query("SELECT id, section FROM sections ORDER BY section")->fetchAll();
$rooms     = $db->query("SELECT id, name FROM rooms ORDER BY name")->fetchAll();
$programs  = $db->query("SELECT p.id, p.name, p.department_id FROM programs p ORDER BY p.name")->fetchAll();
$departments = $db->query("SELECT id, name FROM departments ORDER BY name")->fetchAll();
$schoolYears = $db->query("SELECT id, name FROM school_years ORDER BY name")->fetchAll();
$semesters   = $db->query("SELECT id, label, sy_id FROM semesters ORDER BY label")->fetchAll();
$subjects    = $db->query("SELECT id, code, description FROM subjects ORDER BY code")->fetchAll();

require 'views/admin/schedule/index.view.php';
