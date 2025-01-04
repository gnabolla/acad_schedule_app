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
    $name       = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    $sql = "INSERT INTO school_years (name, start_date, end_date) VALUES (?, ?, ?)";
    $db->query($sql, [$name, $start_date, $end_date]);
    header('Location: /admin/school-years');
    exit;
}

require 'views/admin/school-year/create.view.php';
