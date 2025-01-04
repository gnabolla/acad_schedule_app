<?php include 'views/partials/head.php'; ?>
<h1>Departments</h1>
<p><a href="/admin/department/create">Create New Department</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($departments as $d): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= htmlspecialchars($d['name']) ?></td>
            <td><?= htmlspecialchars($d['description'] ?? '') ?></td>
            <td>
                <a href="/admin/department/edit?id=<?= $d['id'] ?>">Edit</a> |
                <a href="/admin/department/delete?id=<?= $d['id'] ?>"
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
