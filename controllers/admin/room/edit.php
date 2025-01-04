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

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /admin/rooms');
    exit;
}

$room = $db->query("SELECT * FROM rooms WHERE id = ?", [$id])->fetch();
if (!$room) {
    echo "Record not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['name'];
    $room_type  = $_POST['room_type'];
    $capacity   = $_POST['capacity'];

    $sql = "UPDATE rooms
            SET name=?, room_type=?, capacity=?
            WHERE id=?";
    $db->query($sql, [$name, $room_type, $capacity, $id]);

    header('Location: /admin/rooms');
    exit;
}

require 'views/admin/room/edit.view.php';
