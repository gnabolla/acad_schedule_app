<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "Forbidden";
    exit;
}
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database']);

// Fetch all departments
$departments = $db->query("SELECT * FROM departments ORDER BY id DESC")->fetchAll();
require 'views/admin/department/index.view.php';
