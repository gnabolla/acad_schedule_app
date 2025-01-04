<?php include 'views/partials/head.php'; ?>
<h1>School Years</h1>
<p><a href="/admin/school-year/create">Create New School Year</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($schoolYears as $sy): ?>
        <tr>
            <td><?= $sy['id'] ?></td>
            <td><?= htmlspecialchars($sy['name']) ?></td>
            <td><?= $sy['start_date'] ?></td>
            <td><?= $sy['end_date'] ?></td>
            <td>
                <a href="/admin/school-year/edit?id=<?= $sy['id'] ?>">Edit</a> |
                <a href="/admin/school-year/delete?id=<?= $sy['id'] ?>"
                   onclick="return confirm('Delete this item?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="/">Back to Home</a></p>
<?php include 'views/partials/foot.php'; ?>
