<?php include 'views/partials/head.php'; ?>
<h1>Create New Room</h1>
<form method="post">
    <div>
        <label>Room Name:<br>
            <input type="text" name="name" required>
        </label>
    </div>
    <div>
        <label>Room Type:<br>
            <select name="room_type">
                <option value="LECTURE">LECTURE</option>
                <option value="LAB">LAB</option>
            </select>
        </label>
    </div>
    <div>
        <label>Capacity:<br>
            <input type="number" name="capacity">
        </label>
    </div>
    <button type="submit">Save</button>
</form>
<p><a href="/admin/rooms">Back</a></p>
<?php include 'views/partials/foot.php'; ?>
