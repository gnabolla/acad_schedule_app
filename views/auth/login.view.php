<?php include 'views/partials/head.php'; ?>

<h1>Login</h1>
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
    <?php if (isset($error)): ?>
        <p><?= $error ?></p>
    <?php endif; ?>
    <div>
        <button type="submit">Login</button>
        <a href="/register">Register</a>
    </div>
</form>

<?php include 'views/partials/foot.php'; ?>
