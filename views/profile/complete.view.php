<?php include 'views/partials/head.php'; ?>
<h1>Complete Profile</h1>

<form method="post">
    <div>
        <label>Firstname:<br>
            <input type="text" name="firstname" required
                   value="<?= htmlspecialchars($firstname) ?>">
        </label>
    </div>
    <div>
        <label>Middlename:<br>
            <input type="text" name="middlename"
                   value="<?= htmlspecialchars($middlename) ?>">
        </label>
    </div>
    <div>
        <label>Lastname:<br>
            <input type="text" name="lastname" required
                   value="<?= htmlspecialchars($lastname) ?>">
        </label>
    </div>

    <?php if ($_SESSION['role'] === 'faculty'): ?>
        <div>
            <label>Department:<br>
                <select name="department_id" required>
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $d): ?>
                        <option value="<?= $d['id'] ?>"
                            <?= $selectedDept == $d['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($d['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
    <?php elseif ($_SESSION['role'] === 'student'): ?>
        <div>
            <label>Program:<br>
                <select name="program_id" required>
                    <option value="">-- Select Program --</option>
                    <?php foreach ($programs as $p): ?>
                        <option value="<?= $p['id'] ?>"
                            <?= $selectedProg == $p['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
    <?php endif; ?>

    <button type="submit">Save</button>
</form>

<p><a href="/logout">Logout</a></p>
<?php include 'views/partials/foot.php'; ?>
