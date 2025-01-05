<?php include 'views/partials/head.php'; ?>
<h1>Edit Program</h1>

<form method="post">
    <div>
        <label>Department:<br>
            <select name="department_id">
                <option value="">-- Select Department --</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>"
                        <?= ($dept['id'] == $program['department_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>

    <div>
        <label>Name:<br>
            <input type="text" name="name"
                   value="<?= htmlspecialchars($program['name']) ?>" required>
        </label>
    </div>
    <div>
        <label>Description:<br>
            <textarea name="description"><?= htmlspecialchars($program['description'] ?? '') ?></textarea>
        </label>
    </div>
    <button type="submit">Update</button>
</form>

<p><a href="/admin/programs">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
