<?php include 'views/partials/head.php'; ?>
<h1>Edit Subject</h1>
<form method="post">
    <div>
        <label>Code:<br>
            <input type="text" name="code"
                   value="<?= htmlspecialchars($subject['code']) ?>" required>
        </label>
    </div>
    <div>
        <label>Description:<br>
            <input type="text" name="description"
                   value="<?= htmlspecialchars($subject['description']) ?>" required>
        </label>
    </div>
    <div>
        <label>Is Lab?<br>
            <input type="checkbox" name="is_lab" value="1" 
                   <?= $subject['is_lab'] ? 'checked' : '' ?>>
        </label>
    </div>
    <div>
        <label>Department:<br>
            <input type="text" name="department"
                   value="<?= htmlspecialchars($subject['department'] ?? '') ?>">
        </label>
    </div>
    <div>
        <label>Units:<br>
            <input type="number" name="units" step="0.5" min="0"
                   value="<?= $subject['units'] ?>">
        </label>
    </div>
    <div>
        <label>Is Major?<br>
            <input type="checkbox" name="is_major" value="1"
                   <?= $subject['is_major'] ? 'checked' : '' ?>>
        </label>
    </div>
    <button type="submit">Update</button>
</form>
<p><a href="/admin/subjects">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
