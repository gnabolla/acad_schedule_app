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

// Get filter from query
$viewType   = $_GET['viewType']   ?? '';
$selectedId = $_GET['selectedId'] ?? '';

// Build optional WHERE clause
$where  = '';
$params = [];
if ($viewType === 'faculty' && $selectedId) {
    $where  = 'WHERE s.faculty_id = ?';
    $params = [$selectedId];
} elseif ($viewType === 'room' && $selectedId) {
    $where  = 'WHERE s.room_id = ?';
    $params = [$selectedId];
} elseif ($viewType === 'section' && $selectedId) {
    $where  = 'WHERE s.section_id = ?';
    $params = [$selectedId];
}

// Query schedules
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
    $where
    ORDER BY FIELD(s.day,'Mon','Tue','Wed','Thu','Fri'), s.start_time
";
$schedules = $db->query($sql, $params)->fetchAll();

// Other master data
$faculties = $db->query("
    SELECT id, firstname, middlename, lastname
    FROM faculties
    ORDER BY lastname, firstname
")->fetchAll();

$sections = $db->query("
    SELECT id, section
    FROM sections
    ORDER BY section
")->fetchAll();

$rooms = $db->query("
    SELECT id, name
    FROM rooms
    ORDER BY name
")->fetchAll();

$programs = $db->query("
    SELECT p.id, p.name, p.department_id
    FROM programs p
    ORDER BY p.name
")->fetchAll();

$departments = $db->query("
    SELECT id, name
    FROM departments
    ORDER BY name
")->fetchAll();

$schoolYears = $db->query("
    SELECT id, name
    FROM school_years
    ORDER BY name
")->fetchAll();

$semesters = $db->query("
    SELECT id, label, sy_id
    FROM semesters
    ORDER BY label
")->fetchAll();

$subjects = $db->query("
    SELECT id, code, description
    FROM subjects
    ORDER BY code
")->fetchAll();

require 'views/admin/schedule/index.view.php';
