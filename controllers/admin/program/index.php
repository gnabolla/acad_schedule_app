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

// Updated to join departments for department name
$sql = "
    SELECT p.*, d.name AS department_name
    FROM programs p
    LEFT JOIN departments d ON p.department_id = d.id
    ORDER BY p.id DESC
";
$programs = $db->query($sql)->fetchAll();

require 'views/admin/program/index.view.php';

