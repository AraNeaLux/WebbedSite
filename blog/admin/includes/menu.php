<div class="menu">
    <div class="card">
        <div class="card-header">
            <h2>Actions</h2>
        </div>
        <div class="card-content">
            <a href="<?php echo BASE_URL . 'admin/create_post.php' ?>">Create Posts</a>
            <a href="<?php echo BASE_URL . 'admin/posts.php' ?>">Manage Posts</a>
            <?php if (isAdmin()): ?>
                <a href="<?php echo BASE_URL . 'admin/users.php' ?>">Manage All Users</a>
                <a href="<?php echo BASE_URL . 'admin/users.php?type=admin' ?>">Manage Admin</a>
                <a href="<?php echo BASE_URL . 'admin/users.php?type=members' ?>">Manage Users</a>
                <?php if (empty(getPendingUsers()) == false): ?>
                    <a href="<?php echo BASE_URL . 'admin/users.php?type=pending' ?>">Manage Pending Users</a>
                <?php endif ?>
                <a href="<?php echo BASE_URL . 'admin/topics.php' ?>">Manage Topics</a>
            <?php endif ?>
        </div>
    </div>
</div>
