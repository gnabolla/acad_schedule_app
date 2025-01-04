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

// Fetch all school_years
$schoolYears = $db->query("SELECT * FROM school_years ORDER BY id DESC")->fetchAll();
require 'views/admin/school-year/index.view.php';
