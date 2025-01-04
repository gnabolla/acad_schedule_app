<?php include 'views/partials/head.php'; ?>
<h1>Create New Subject</h1>
<form method="post">
    <div>
        <label>Code:<br>
            <input type="text" name="code" required>
        </label>
    </div>
    <div>
        <label>Description:<br>
            <input type="text" name="description" required>
        </label>
    </div>
    <div>
        <label>Is Lab?<br>
            <input type="checkbox" name="is_lab" value="1">
        </label>
    </div>
    <div>
        <label>Department:<br>
            <input type="text" name="department">
        </label>
    </div>
    <div>
        <label>Units:<br>
            <input type="number" name="units" step="0.5" min="0">
        </label>
    </div>
    <div>
        <label>Is Major?<br>
            <input type="checkbox" name="is_major" value="1">
        </label>
    </div>
    <button type="submit">Save</button>
</form>
<p><a href="/admin/subjects">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
