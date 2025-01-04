<?php include 'views/partials/head.php'; ?>
<h1>Complete Faculty Profile</h1>
<form method="post">
    <div>
        <label>Firstname:<br>
            <input type="text" name="firstname" 
                   value="<?= $existing['firstname'] ?? '' ?>" required>
        </label>
    </div>
    <div>
        <label>Middlename:<br>
            <input type="text" name="middlename" 
                   value="<?= $existing['middlename'] ?? '' ?>">
        </label>
    </div>
    <div>
        <label>Lastname:<br>
            <input type="text" name="lastname" 
                   value="<?= $existing['lastname'] ?? '' ?>" required>
        </label>
    </div>
    <button type="submit">Save</button>
</form>
<p><a href="/">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
