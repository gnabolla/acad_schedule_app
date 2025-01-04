<?php include 'views/partials/head.php'; ?>
<h1>Sections</h1>
<p><a href="/admin/section/create">Create New Section</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Program</th>
        <th>Year Level</th>
        <th>Section</th>
        <th>Department</th>
        <th>Semester ID</th>
        <th>Curriculum ID</th>
        <th>Archived</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sections as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['program']) ?></td>
            <td><?= $s['year_level'] ?></td>
            <td><?= htmlspecialchars($s['section']) ?></td>
            <td><?= htmlspecialchars($s['department'] ?? '') ?></td>
            <td><?= $s['semester_id'] ?></td>
            <td><?= $s['curriculum_id'] ?></td>
            <td><?= $s['archived'] ? 'Yes' : 'No' ?></td>
            <td>
                <a href="/admin/section/edit?id=<?= $s['id'] ?>">Edit</a> |
                <a href="/admin/section/delete?id=<?= $s['id'] ?>"
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
