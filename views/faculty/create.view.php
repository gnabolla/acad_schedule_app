<?php include 'views/partials/head.php'; ?>

<h1>Create Faculty</h1>
<form method="post">
    <div>
        <label>User ID (optional):</label>
        <input type="number" name="user_id">
    </div>
    <div>
        <label>Firstname:</label>
        <input type="text" name="firstname" required>
    </div>
    <div>
        <label>Middlename:</label>
        <input type="text" name="middlename">
    </div>
    <div>
        <label>Lastname:</label>
        <input type="text" name="lastname" required>
    </div>
    <button type="submit">Save</button>
</form>
<p><a href="/faculty">Back to List</a></p>

<?php include 'views/partials/foot.php'; ?>
