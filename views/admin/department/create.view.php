<?php include 'views/partials/head.php'; ?>
<h1>Create New Department</h1>
<form method="post">
    <div>
        <label>Name:<br>
            <input type="text" name="name" required>
        </label>
    </div>
    <div>
        <label>Description:<br>
            <textarea name="description"></textarea>
        </label>
    </div>
    <button type="submit">Save</button>
</form>
<p><a href="/admin/departments">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
