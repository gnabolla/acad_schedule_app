<?php include 'views/partials/head.php'; ?>

<h1>Edit Faculty</h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $faculty['id'] ?>">
    <div>
        <label>User ID (optional):</label>
        <input type="number" name="user_id" value="<?= $faculty['user_id'] ?>">
    </div>
    <div>
        <label>Firstname:</label>
        <input type="text" name="firstname" required value="<?= htmlspecialchars($faculty['firstname']) ?>">
    </div>
    <div>
        <label>Middlename:</label>
        <input type="text" name="middlename" value="<?= htmlspecialchars($faculty['middlename']) ?>">
    </div>
    <div>
        <label>Lastname:</label>
        <input type="text" name="lastname" required value="<?= htmlspecialchars($faculty['lastname']) ?>">
    </div>
    <button type="submit">Update</button>
</form>
<p><a href="/faculty">Back to List</a></p>

<?php include 'views/partials/foot.php'; ?>
