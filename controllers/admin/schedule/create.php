<?php
session_start();

// 1) Check admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "Forbidden - Admins only";
    exit;
}

require 'Database.php';
$config = require 'config.php';

// 2) Create DB connection
$db = new Database($config['database'], 'root', '');

// 3) Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gather form fields
    $faculty_id  = $_POST['faculty_id']  ?? null;
    $subject_id  = $_POST['subject_id']  ?? null;
    $section_id  = $_POST['section_id']  ?? null;
    $room_id     = $_POST['room_id']     ?? null;
    $semester_id = $_POST['semester_id'] ?? null;
    $day         = $_POST['day']         ?? null;
    $class_type  = $_POST['class_type']  ?? 'lecture';

    // Convert am/pm time strings to 24-hour format (e.g. '7:30 am' -> '07:30:00')
    $start_time = isset($_POST['start_time'])
        ? date('H:i:s', strtotime($_POST['start_time']))
        : null;

    $end_time = isset($_POST['end_time'])
        ? date('H:i:s', strtotime($_POST['end_time']))
        : null;

    // 4) Insert schedule record
    $db->query(
        "INSERT INTO schedules 
            (faculty_id, subject_id, section_id, room_id, semester_id, day, start_time, end_time, class_type)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [
            $faculty_id,
            $subject_id,
            $section_id,
            $room_id,
            $semester_id,
            $day,
            $start_time,
            $end_time,
            $class_type
        ]
    );

    // 5) Redirect to schedules list
    header('Location: /admin/schedules');
    exit;
}

// If GET or any other method, just redirect to schedules page
header('Location: /admin/schedules');
exit;
