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
    $room_type  = $_POST['room_type']; // e.g. LAB or LECTURE
    $capacity   = $_POST['capacity'];

    $sql = "INSERT INTO rooms (name, room_type, capacity) VALUES (?, ?, ?)";
    $db->query($sql, [$name, $room_type, $capacity]);

    header('Location: /admin/rooms');
    exit;
}

require 'views/admin/room/create.view.php';
