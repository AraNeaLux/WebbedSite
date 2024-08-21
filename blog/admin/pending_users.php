<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php if (!isAdmin()) {
        $_SESSION['msg'] = "You must log in as an admin first";
        header('location: ../login.php');
} ?>
<?php 
        // Get all non-admin users from DB
        $pending_users = getPendingUsers();
        $roles = ['Viewer', 'Commentor', 'Author', 'Admin'];                           
?>
<?php include(ROOT_PATH . '/admin/includes/header.php'); ?>
        <title>Admin | Manage pending users</title>
</head>
<body>
    <!-- admin navbar -->
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
    <div class="container content">
        <!-- Left side menu -->
        <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
        <!-- Middle form - to create and edit  -->
        <div class="action">
            <h1 class="page-title">Create/Edit Pending User</h1>

            <form method="post" action="<?php echo BASE_URL . 'admin/pending_users.php'; ?>" >

                <!-- validation errors for the form -->
                <?php include(ROOT_PATH . '/includes/errors.php') ?>

                <!-- if editing user, the id is required to identify that user -->
                <?php if ($isEditingUser === true): ?>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <?php endif ?>

                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
                <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="passwordConfirmation" placeholder="Password confirmation">
                <select name="role">
                    <option value="" selected disabled>Assign role</option>
                    <?php foreach ($roles as $key => $role_option): ?>
                        <option value="<?php echo $role_option; ?>"><?php echo $role_option; ?></option>
                    <?php endforeach ?>
                </select>

                <!-- display checkbox according to whether user has been approved or not -->
                <?php if ($approved == true): ?>
                        <label for="approved">
                                Approved
                                <input type="checkbox" value="1" name="approved" checked="checked">&nbsp;
                        </label>
                <?php else: ?>
                        <label for="approved">
                                Approved
                                <input type="checkbox" value="1" name="approved">&nbsp;
                        </label>
                <?php endif ?>

                <!-- display checkbox according to whether user has verified email or not -->
                <!-- 
                <?php if ($email_verified == true): ?>
                        <label for="email_verified">
                                Verified email
                                <input type="checkbox" value="1" name="email_verified" checked="checked">&nbsp;
                        </label>
                <?php else: ?>
                        <label for="email_verified">
                                Verified email
                                <input type="checkbox" value="1" name="email_verified">&nbsp;
                        </label>
                <?php endif ?>
                -->

                <!-- if editing user, display the update button instead of create button -->
                <?php if ($isEditingUser === true): ?> 
                    <button type="submit" class="btn" name="update_pending_user">UPDATE</button>
                <?php else: ?>
                    <button type="submit" class="btn" name="create_pending_user">Save User</button>
                <?php endif ?>
            </form>
        </div>
        <!-- // Middle form - to create and edit -->

        <!-- Display records from DB-->
        <div class="table-div">
            <!-- Display notification message -->
            <?php include(ROOT_PATH . '/includes/messages.php') ?>

            <?php if (empty($pending_users)): ?>
                <h1>No pending users in the database.</h1>
            <?php else: ?>
                <table class="table">
                    <thead>
                            <th>N</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Approve</th>
                            <th>Edit</th>
                            <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_users as $key => $pending_user): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td>
                                    <?php echo $pending_user['username']; ?>, &nbsp;
                                    <?php echo $pending_user['email']; ?>    
                                </td>
                                <td><?php echo $pending_user['role']; ?></td>
                                <td>
                                    <?php if ($pending_user['approved'] == true): ?>
                                        <a class="fa fa-check btn unpublish"
                                            href="pending_users.php?unapprove=<?php echo $pending_user['id'] ?>">
                                        </a>
                                    <?php elseif ($pending_user['approved'] == false): ?>
                                        <a class="fa fa-times btn publish"
                                            href="pending_users.php?approve=<?php echo $pending_user['id'] ?>">
                                        </a>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a class="fa fa-pencil btn edit"
                                        href="pending_users.php?edit-user=<?php echo $pending_user['id'] ?>">
                                    </a>
                                </td>
                                <td>
                                    <a class="fa fa-trash btn delete" 
                                        href="pending_users.php?delete-user=<?php echo $pending_user['id'] ?>">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
        <!-- // Display records from DB -->
    </div>
</body>
</html>
