<?php
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

$id = $_GET['id'] ?? null;
if ($id) {
    $db->query("DELETE FROM schedules WHERE id = ?", [$id]);
}

header('Location: /admin/schedules');
exit;