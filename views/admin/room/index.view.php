<?php include 'views/partials/head.php'; ?>
<h1>Rooms</h1>
<p><a href="/admin/room/create">Create New Room</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Room Type</th>
            <th>Capacity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><?= $r['room_type'] ?></td>
            <td><?= $r['capacity'] ?></td>
            <td>
                <a href="/admin/room/edit?id=<?= $r['id'] ?>">Edit</a> |
                <a href="/admin/room/delete?id=<?= $r['id'] ?>"
                   onclick="return confirm('Delete this record?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="/">Back to Home</a></p>
<?php include 'views/partials/foot.php'; ?>
