<?php include 'views/partials/head.php'; ?>
<h1>Edit School Year</h1>
<form method="post">
    <div>
        <label>Name:<br>
            <input type="text" name="name" required value="<?= htmlspecialchars($sy['name']) ?>">
        </label>
    </div>
    <div>
        <label>Start Date:<br>
            <input type="date" name="start_date" value="<?= $sy['start_date'] ?>">
        </label>
    </div>
    <div>
        <label>End Date:<br>
            <input type="date" name="end_date" value="<?= $sy['end_date'] ?>">
        </label>
    </div>
    <button type="submit">Update</button>
</form>
<p><a href="/admin/school-years">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
