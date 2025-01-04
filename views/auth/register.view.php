<?php include 'views/partials/head.php'; ?>

<h1>Register</h1>
<form method="post">
    <div>
        <label>Username:<br>
            <input type="text" name="username" required>
        </label>
    </div>
    <div>
        <label>Password:<br>
            <input type="password" name="password" required>
        </label>
    </div>
    <div>
        <label>Retype Password:<br>
            <input type="password" name="retype_password" required>
        </label>
    </div>
    <div>
        <label>Role:<br>
            <select name="role">
                <option value="faculty">Faculty</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
        </label>
    </div>
    <?php if (isset($error)): ?>
        <p><?= $error ?></p>
    <?php endif; ?>
    <div>
        <button type="submit">Register</button>
        <a href="/login">Login</a>
    </div>
</form>

<?php include 'views/partials/foot.php'; ?>
