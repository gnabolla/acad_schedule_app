<?php
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

// Create admin user if not exists
$username = 'admin';
$password = password_hash('admin', PASSWORD_DEFAULT);
$role     = 'admin';
$status   = 'active';

$check = $db->query("SELECT id FROM users WHERE username = ?", [$username])->fetch();
if (!$check) {
    $sql = "INSERT INTO users (username, password, role, status) VALUES (?, ?, ?, ?)";
    $db->query($sql, [$username, $password, $role, $status]);
    echo "Seeded admin account (username='admin', password='admin')\n";
} else {
    echo "Admin user already exists.\n";
}
