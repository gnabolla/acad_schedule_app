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

// Fetch all semesters
$semesters = $db->query("SELECT * FROM semesters ORDER BY id DESC")->fetchAll();

// Optional: If you want to join school_years to show name
// $semesters = $db->query("SELECT s.*, sy.name AS sy_name
//                          FROM semesters s
//                          JOIN school_years sy ON s.sy_id = sy.id
//                          ORDER BY s.id DESC")->fetchAll();

require 'views/admin/semester/index.view.php';
