<?php include 'views/partials/head.php'; ?>
<h1>Create New Section</h1>
<form method="post">
    <div>
        <label>Program:<br>
            <input type="text" name="program" required>
        </label>
    </div>
    <div>
        <label>Year Level:<br>
            <input type="number" name="year_level" min="1" required>
        </label>
    </div>
    <div>
        <label>Section Name:<br>
            <input type="text" name="section" required>
        </label>
    </div>
    <div>
        <label>Department:<br>
            <input type="text" name="department">
        </label>
    </div>
    <div>
        <label>Semester ID:<br>
            <input type="number" name="semester_id" required>
            <!-- If you want a dropdown, you'd query semesters from DB and loop them here. -->
        </label>
    </div>
    <div>
        <label>Curriculum ID:<br>
            <input type="number" name="curriculum_id" required>
            <!-- Similarly, for a real UI, you'd select from an existing curricula list. -->
        </label>
    </div>
    <div>
        <label>Archived?<br>
            <input type="checkbox" name="archived" value="1">
        </label>
    </div>
    <button type="submit">Save</button>
</form>

<p><a href="/admin/sections">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
