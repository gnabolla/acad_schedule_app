<?php
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $faculty_id = $_POST['faculty_id'];
    $room_id = $_POST['room_id'];
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $db->query("INSERT INTO schedules (faculty_id, room_id, day, start_time, end_time) VALUES (?, ?, ?, ?, ?)",
               [$faculty_id, $room_id, $day, $start_time, $end_time]);

    header('Location: /admin/schedules');
    exit;
}

require 'views/admin/schedule/create.view.php';
