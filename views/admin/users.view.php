<?php include 'views/partials/head.php'; ?>

<h1>Manage Users</h1>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= ucfirst($u['role']) ?></td>
            <td><?= ucfirst($u['status']) ?></td>
            <td>
                <?php if ($u['status'] === 'pending'): ?>
                    <div>
                        <form action="/admin/users/action" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit">Approve</button>
                        </form>
                        <form action="/admin/users/action" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                            <input type="hidden" name="action" value="reject">
                            <button type="submit">Reject</button>
                        </form>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="/">Back to Home</a> | <a href="/logout">Logout</a>
</p>

<?php include 'views/partials/foot.php'; ?>
