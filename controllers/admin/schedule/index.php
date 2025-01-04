<?php
require 'Database.php';
$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

$schedules = $db->query("SELECT s.*, f.firstname AS faculty_name, r.name AS room_name FROM schedules s 
                         JOIN faculties f ON s.faculty_id = f.id 
                         JOIN rooms r ON s.room_id = r.id")->fetchAll();

require 'views/admin/schedule/index.view.php';