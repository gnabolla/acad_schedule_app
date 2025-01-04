<?php include 'views/partials/head.php'; ?>
<h1>Edit Department</h1>
<form method="post">
    <div>
        <label>Name:<br>
            <input type="text" name="name"
                   value="<?= htmlspecialchars($department['name']) ?>" required>
        </label>
    </div>
    <div>
        <label>Description:<br>
            <textarea name="description"><?= htmlspecialchars($department['description'] ?? '') ?></textarea>
        </label>
    </div>
    <button type="submit">Update</button>
</form>
<p><a href="/admin/departments">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
