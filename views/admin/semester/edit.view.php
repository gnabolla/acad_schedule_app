<?php include 'views/partials/head.php'; ?>
<h1>Edit Semester</h1>
<form method="post">
    <div>
        <label>School Year ID:<br>
            <input type="number" name="sy_id" value="<?= $semester['sy_id'] ?>" required>
        </label>
    </div>
    <div>
        <label>Semester No:<br>
            <input type="number" name="semester_no" value="<?= $semester['semester_no'] ?>" required>
        </label>
    </div>
    <div>
        <label>Label:<br>
            <input type="text" name="label" value="<?= htmlspecialchars($semester['label']) ?>" required>
        </label>
    </div>
    <div>
        <label>Start Date:<br>
            <input type="date" name="start_date" value="<?= $semester['start_date'] ?>">
        </label>
    </div>
    <div>
        <label>End Date:<br>
            <input type="date" name="end_date" value="<?= $semester['end_date'] ?>">
        </label>
    </div>
    <button type="submit">Update</button>
</form>
<p><a href="/admin/semesters">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
