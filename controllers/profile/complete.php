<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database']);

// Get user role
$userId = $_SESSION['user_id'];
$user   = $db->query("SELECT role FROM users WHERE id = ?", [$userId])->fetch();
if (!$user) {
    echo "User not found.";
    exit;
}

// Prepare data for form
$firstname    = '';
$middlename   = '';
$lastname     = '';
$selectedDept = null;
$selectedProg = null;
$departments  = [];
$programs     = [];

// If faculty, load departments and any existing faculty record
if ($user['role'] === 'faculty') {
    $departments = $db->query("SELECT id, name FROM departments ORDER BY name")->fetchAll();
    $existing    = $db->query("SELECT * FROM faculties WHERE user_id = ?", [$userId])->fetch();
    if ($existing) {
        $firstname    = $existing['firstname'];
        $middlename   = $existing['middlename'];
        $lastname     = $existing['lastname'];
        $selectedDept = $existing['department_id'];
    }
// If student, load programs and any existing student record
} elseif ($user['role'] === 'student') {
    $programs = $db->query("SELECT id, name FROM programs ORDER BY name")->fetchAll();
    $existing = $db->query("SELECT * FROM students WHERE user_id = ?", [$userId])->fetch();
    if ($existing) {
        $firstname   = $existing['firstname'];
        $middlename  = $existing['middlename'];
        $lastname    = $existing['lastname'];
        $selectedProg= $existing['program_id'];
    }
}

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname  = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $lastname   = $_POST['lastname'] ?? '';

    if ($user['role'] === 'faculty') {
        $department_id = $_POST['department_id'] ?? null;
        $check = $db->query("SELECT id FROM faculties WHERE user_id = ?", [$userId])->fetch();
        if ($check) {
            $db->query(
                "UPDATE faculties SET department_id=?, firstname=?, middlename=?, lastname=? WHERE user_id=?",
                [$department_id, $firstname, $middlename, $lastname, $userId]
            );
        } else {
            $db->query(
                "INSERT INTO faculties (user_id, department_id, firstname, middlename, lastname)
                 VALUES (?, ?, ?, ?, ?)",
                [$userId, $department_id, $firstname, $middlename, $lastname]
            );
        }
    } elseif ($user['role'] === 'student') {
        $program_id = $_POST['program_id'] ?? null;
        $check = $db->query("SELECT id FROM students WHERE user_id = ?", [$userId])->fetch();
        if ($check) {
            $db->query(
                "UPDATE students SET program_id=?, firstname=?, middlename=?, lastname=? WHERE user_id=?",
                [$program_id, $firstname, $middlename, $lastname, $userId]
            );
        } else {
            $db->query(
                "INSERT INTO students (user_id, program_id, firstname, middlename, lastname)
                 VALUES (?, ?, ?, ?, ?)",
                [$userId, $program_id, $firstname, $middlename, $lastname]
            );
        }
    }
    header('Location: /');
    exit;
}

require 'views/profile/complete.view.php';
