<?php include 'views/partials/head.php'; ?>
<h1>Create Semester</h1>
<form method="post">
    <div>
        <label>School Year ID:<br>
            <input type="number" name="sy_id" required>
        </label>
    </div>
    <div>
        <label>Semester No:<br>
            <input type="number" name="semester_no" required>
        </label>
    </div>
    <div>
        <label>Label:<br>
            <input type="text" name="label" required>
        </label>
    </div>
    <div>
        <label>Start Date:<br>
            <input type="date" name="start_date">
        </label>
    </div>
    <div>
        <label>End Date:<br>
            <input type="date" name="end_date">
        </label>
    </div>
    <button type="submit">Save</button>
</form>
<p><a href="/admin/semesters">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
