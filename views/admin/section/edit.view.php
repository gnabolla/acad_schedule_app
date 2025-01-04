<?php include 'views/partials/head.php'; ?>
<h1>Edit Section</h1>
<form method="post">
    <div>
        <label>Program:<br>
            <input type="text" name="program" 
                   value="<?= htmlspecialchars($sec['program']) ?>" required>
        </label>
    </div>
    <div>
        <label>Year Level:<br>
            <input type="number" name="year_level" min="1"
                   value="<?= $sec['year_level'] ?>" required>
        </label>
    </div>
    <div>
        <label>Section Name:<br>
            <input type="text" name="section" 
                   value="<?= htmlspecialchars($sec['section']) ?>" required>
        </label>
    </div>
    <div>
        <label>Department:<br>
            <input type="text" name="department"
                   value="<?= htmlspecialchars($sec['department'] ?? '') ?>">
        </label>
    </div>
    <div>
        <label>Semester ID:<br>
            <input type="number" name="semester_id" 
                   value="<?= $sec['semester_id'] ?>" required>
        </label>
    </div>
    <div>
        <label>Curriculum ID:<br>
            <input type="number" name="curriculum_id"
                   value="<?= $sec['curriculum_id'] ?>" required>
        </label>
    </div>
    <div>
        <label>Archived?<br>
            <input type="checkbox" name="archived" value="1"
                   <?= $sec['archived'] ? 'checked' : '' ?>>
        </label>
    </div>
    <button type="submit">Update</button>
</form>

<p><a href="/admin/sections">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
