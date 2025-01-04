<?php include 'views/partials/head.php'; ?>
<h1>Manage Schedules</h1>
<a href="/admin/schedule/create">Create New Schedule</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Faculty</th>
            <th>Room</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($schedules as $schedule): ?>
        <tr>
            <td><?= $schedule['id'] ?></td>
            <td><?= $schedule['faculty_name'] ?></td>
            <td><?= $schedule['room_name'] ?></td>
            <td><?= $schedule['day'] ?></td>
            <td><?= $schedule['start_time'] ?></td>
            <td><?= $schedule['end_time'] ?></td>
            <td>
                <a href="/admin/schedule/edit?id=<?= $schedule['id'] ?>">Edit</a>
                <a href="/admin/schedule/delete?id=<?= $schedule['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'views/partials/foot.php'; ?>

/* File: views/admin/schedule/create.view.php */
<?php include 'views/partials/head.php'; ?>
<h1>Create New Schedule</h1>
<form method="post">
    <div>
        <label>Faculty ID:<br>
            <input type="number" name="faculty_id" required>
        </label>
    </div>
    <div>
        <label>Room ID:<br>
            <input type="number" name="room_id" required>
        </label>
    </div>
    <div>
        <label>Day:<br>
            <select name="day">
                <option value="Mon">Monday</option>
                <option value="Tue">Tuesday</option>
                <option value="Wed">Wednesday</option>
                <option value="Thu">Thursday</option>
                <option value="Fri">Friday</option>
            </select>
        </label>
    </div>
    <div>
        <label>Start Time:<br>
            <input type="time" name="start_time" required>
        </label>
    </div>
    <div>
        <label>End Time:<br>
            <input type="time" name="end_time" required>
        </label>
    </div>
    <button type="submit">Save</button>
</form>
<?php include 'views/partials/foot.php'; ?>