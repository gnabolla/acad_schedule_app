<?php include 'views/partials/head.php'; ?>

<h1>Faculty List</h1>
<!-- <p><a href="/faculty/create">Create New Faculty</a></p> -->

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Username (if any)</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Lastname</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($faculties as $f): ?>
        <tr>
            <td><?= $f['id'] ?></td>
            <td><?= $f['user_id'] ?></td>
            <td><?= $f['username'] ?? '' ?></td>
            <td><?= htmlspecialchars($f['firstname']) ?></td>
            <td><?= htmlspecialchars($f['middlename']) ?></td>
            <td><?= htmlspecialchars($f['lastname']) ?></td>
            <td>
                <a href="/faculty/edit?id=<?= $f['id'] ?>">Edit</a> |
                <a href="/faculty/delete?id=<?= $f['id'] ?>"
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
