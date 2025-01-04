<?php include 'views/partials/head.php'; ?>
<h1>Semesters</h1>
<p><a href="/admin/semester/create">Create New Semester</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>School Year ID</th>
            <th>Semester No</th>
            <th>Label</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($semesters as $sem): ?>
        <tr>
            <td><?= $sem['id'] ?></td>
            <td><?= $sem['sy_id'] ?></td>
            <td><?= $sem['semester_no'] ?></td>
            <td><?= htmlspecialchars($sem['label']) ?></td>
            <td><?= $sem['start_date'] ?></td>
            <td><?= $sem['end_date'] ?></td>
            <td>
                <a href="/admin/semester/edit?id=<?= $sem['id'] ?>">Edit</a> |
                <a href="/admin/semester/delete?id=<?= $sem['id'] ?>"
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
