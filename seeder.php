<?php
/**
 * Faculty to Users Seeder
 * 
 * This script creates a user account for each faculty member in `faculties`.
 * - username  = faculty.id_number
 * - password  = "isur1978" (hashed)
 * - email     = faculty.email
 * - role      = "faculty"
 * - status    = "active"
 * 
 * Then updates faculties.user_id with the newly inserted users.id
 */

// 1) Database connection settings — adjust as needed
$dsn    = 'mysql:host=127.0.0.1;dbname=acad_schedule_db;charset=utf8mb4';
$dbUser = 'root';      // DB username
$dbPass = '';          // DB password

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2) Query all faculty who do not have a user_id yet (or all, if you want to re‐seed)
    //    Here we fetch `id`, `id_number`, and `email`.
    $sql = "SELECT `id`, `id_number`, `email`
            FROM `faculties`
            WHERE `user_id` IS NULL";  // or remove WHERE if you want to seed all
    $stmt = $pdo->query($sql);
    $faculties = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$faculties) {
        echo "No faculty records found (or all have user_id). Nothing to do.\n";
        exit;
    }

    // 3) Prepare the insert statement for users
    //    We'll do a simple approach: same created_at/updated_at = now() 
    //    and fix `role` = 'faculty', `status` = 'active'.
    $insertUserSql = "INSERT INTO `users` 
            (`username`, `password`, `email`, `role`, `created_at`, `updated_at`, `status`)
            VALUES
            (:username, :password, :email, 'faculty', NOW(), NOW(), 'active')";
    $insertUserStmt = $pdo->prepare($insertUserSql);

    // Hash the default password "isur1978" once outside the loop
    $defaultPasswordHash = password_hash("isur1978", PASSWORD_BCRYPT);

    // 4) Prepare the update statement for faculties
    $updateFacultySql = "UPDATE `faculties` SET `user_id` = :user_id WHERE `id` = :faculty_id";
    $updateFacultyStmt = $pdo->prepare($updateFacultySql);

    // 5) Process each faculty
    foreach ($faculties as $faculty) {
        // a) Insert a new user row
        $insertUserStmt->execute([
            ':username' => $faculty['id_number'],
            ':password' => $defaultPasswordHash,
            ':email'    => $faculty['email'] ?? null,
        ]);

        // b) Retrieve the newly inserted user id
        $newUserId = $pdo->lastInsertId();

        // c) Update the faculty record with this new user_id
        $updateFacultyStmt->execute([
            ':user_id'     => $newUserId,
            ':faculty_id'  => $faculty['id'],
        ]);

        echo "Created user for faculty ID {$faculty['id']}, username={$faculty['id_number']}, user_id=$newUserId\n";
    }

    echo "Done seeding users for faculties.\n";

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
