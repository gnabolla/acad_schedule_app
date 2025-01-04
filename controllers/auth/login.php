<?php
session_start();
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $db->query("SELECT * FROM users WHERE username = ?", [$username])->fetch();
    if ($user && password_verify($password, $user['password'])) {
        if ($user['status'] === 'rejected') {
            $error = "Your account has been rejected. Please contact the administrator.";
            require 'views/auth/login.view.php';
            exit;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role']    = $user['role'];
        $_SESSION['status']  = $user['status'];

        // Ensure profile is complete before anything else
        if ($user['role'] === 'faculty') {
            $faculty = $db->query("SELECT id FROM faculties WHERE user_id = ?", [$user['id']])->fetch();
            if (!$faculty) {
                header('Location: /profile/faculty-complete');
                exit;
            }
        } elseif ($user['role'] === 'student') {
            $student = $db->query("SELECT id FROM students WHERE user_id = ?", [$user['id']])->fetch();
            if (!$student) {
                // For students, redirect to a different route if you want
                header('Location: /profile/complete');
                exit;
            }
        }

        header('Location: /');
        exit;
    } else {
        $error = "Invalid credentials.";
        require 'views/auth/login.view.php';
    }
} else {
    require 'views/auth/login.view.php';
}
