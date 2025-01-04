<?php include 'views/partials/head.php'; ?>
<h1>Subjects</h1>
<p><a href="/admin/subject/create">Create New Subject</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Is Lab</th>
            <th>Department</th>
            <th>Units</th>
            <th>Is Major</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($subjects as $sub): ?>
        <tr>
            <td><?= $sub['id'] ?></td>
            <td><?= htmlspecialchars($sub['code']) ?></td>
            <td><?= htmlspecialchars($sub['description']) ?></td>
            <td><?= $sub['is_lab'] ? 'Yes' : 'No' ?></td>
            <td><?= htmlspecialchars($sub['department'] ?? '') ?></td>
            <td><?= $sub['units'] ?></td>
            <td><?= $sub['is_major'] ? 'Yes' : 'No' ?></td>
            <td>
                <a href="/admin/subject/edit?id=<?= $sub['id'] ?>">Edit</a> |
                <a href="/admin/subject/delete?id=<?= $sub['id'] ?>"
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
