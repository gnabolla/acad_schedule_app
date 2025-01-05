<?php
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

// Fetch schedules (for display, if needed)
$schedules = $db->query("
    SELECT s.*, f.firstname AS faculty_name, f.lastname AS faculty_lname, r.name AS room_name
    FROM schedules s
    JOIN faculties f ON s.faculty_id = f.id
    JOIN rooms r ON s.room_id = r.id
")->fetchAll();

// Fetch master data
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
    SELECT p.id, p.name, p.department_id, d.name AS department_name
    FROM programs p
    JOIN departments d ON p.department_id = d.id
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
