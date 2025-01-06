<?php include 'views/partials/head.php'; ?>
<h1>Edit Profile</h1>
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p>Password changed successfully.</p>
<?php endif; ?>
<form method="post">
    <div>
        <label>Old Password:<br>
            <input type="password" name="old_password" required>
        </label>
    </div>
    <div>
        <label>New Password:<br>
            <input type="password" name="new_password" required>
        </label>
    </div>
    <div>
        <label>Confirm New Password:<br>
            <input type="password" name="confirm_password" required>
        </label>
    </div>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <button type="submit">Change Password</button>
</form>
<p><a href="/">Back to Home</a></p>
<?php include 'views/partials/foot.php'; ?>
