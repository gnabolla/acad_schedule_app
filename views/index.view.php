<!-- views/index.view.php -->
<?php include 'views/partials/head.php'; ?>

<h1>Welcome</h1>
<p>
    <?php if (isset($_SESSION['user_id'])): ?>
        You are logged in as <?= $_SESSION['role'] ?>. 
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <!-- Add your admin links here -->
            <a href="/admin/users">User Management</a> | 
            <a href="/faculty">Faculty Management</a> |
            <a href="/admin/school-years">Manage School Years</a> |
            <a href="/admin/semesters">Manage Semesters</a> |
            <a href="/admin/rooms">Manage Rooms</a> |
            <a href="/admin/subjects">Manage Subjects</a> |
            
            <!-- New link for managing sections -->
            <a href="/admin/sections">Manage Sections</a> |
        <?php endif; ?>
        
        <!-- For all logged-in users -->
        <a href="/logout">Logout</a>

    <?php else: ?>
        <a href="/login">Login</a> | <a href="/register">Register</a>
    <?php endif; ?>
</p>

<?php include 'views/partials/foot.php'; ?>
