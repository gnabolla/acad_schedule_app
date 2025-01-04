<?php include 'views/partials/head.php'; ?>
<h1>Programs</h1>
<p><a href="/admin/program/create">Create New Program</a></p>
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
    <?php foreach ($programs as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['description'] ?? '') ?></td>
            <td>
                <a href="/admin/program/edit?id=<?= $p['id'] ?>">Edit</a> |
                <a href="/admin/program/delete?id=<?= $p['id'] ?>"
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
