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
    $id         = $_POST['id'];
    $userId     = $_POST['user_id'] ?: null;
    $firstname  = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname   = $_POST['lastname'];

    $sql = "
        UPDATE faculties
        SET user_id = ?, firstname = ?, middlename = ?, lastname = ?
        WHERE id = ?
    ";
    $db->query($sql, [$userId, $firstname, $middlename, $lastname, $id]);

    header('Location: /faculty');
    exit;
} else {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: /faculty');
        exit;
    }

    $faculty = $db->query("SELECT * FROM faculties WHERE id = ?", [$id])->fetch();
    if (!$faculty) {
        echo "Record not found.";
        exit;
    }

    require 'views/faculty/edit.view.php';
}
