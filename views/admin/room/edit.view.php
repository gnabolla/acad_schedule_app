<?php include 'views/partials/head.php'; ?>
<h1>Edit Room</h1>
<form method="post">
    <div>
        <label>Room Name:<br>
            <input type="text" name="name"
                   value="<?= htmlspecialchars($room['name']) ?>" required>
        </label>
    </div>
    <div>
        <label>Room Type:<br>
            <select name="room_type">
                <option value="LECTURE" <?= $room['room_type'] === 'LECTURE' ? 'selected' : '' ?>>LECTURE</option>
                <option value="LAB" <?= $room['room_type'] === 'LAB' ? 'selected' : '' ?>>LAB</option>
            </select>
        </label>
    </div>
    <div>
        <label>Capacity:<br>
            <input type="number" name="capacity" value="<?= $room['capacity'] ?>">
        </label>
    </div>
    <button type="submit">Update</button>
</form>
<p><a href="/admin/rooms">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
