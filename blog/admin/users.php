<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php if (!isAdmin()) {
        $_SESSION['msg'] = "You must log in as an admin first";
        header('location: ../login.php');
} ?>
<?php 
    // Get users of requested type from DB
    $users = getUsersOfType();
    $roles = ['Viewer', 'Commentor', 'Author', 'Admin'];                           
?>
<?php include(ROOT_PATH . '/admin/includes/header.php'); ?>
        <title>Admin | Manage non-admin users</title>
</head>
<body>
    <!-- admin navbar -->
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
    <div class="container content">
        <!-- Left side menu -->
        <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
        <!-- Middle form - to create and edit  -->
        <div class="action">
            <h1 class="page-title">Create/Edit User</h1>

            <form method="post" action="<?php echo BASE_URL . 'admin/users.php'; ?>" >

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
                    <?php foreach ($roles as $key => $role): ?>
                        <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
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

                <!-- if editing user, display the update button instead of create button -->
                <?php if ($isEditingUser === true): ?> 
                    <button type="submit" class="btn" name="update_user">UPDATE</button>
                <?php else: ?>
                    <button type="submit" class="btn" name="create_user">Save User</button>
                <?php endif ?>
            </form>
        </div>
        <!-- // Middle form - to create and edit -->

        <!-- Display records from DB-->
        <div class="table-div">
            <!-- Display notification message -->
            <?php include(ROOT_PATH . '/includes/messages.php') ?>

            <?php if (empty($users)): ?>
                <h1>No non-admins in the database.</h1>
            <?php else: ?>
                <table class="table">
                    <thead>
                            <th>N</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Approved</th>
                            <th>Edit</th>
                            <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $user): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td>
                                    <?php echo $user['username']; ?>, &nbsp;
                                    <?php echo $user['email']; ?>    
                                </td>
                                <td><?php echo $user['role']; ?></td>
                                <td>
                                    <?php if ($user['approved'] == true): ?>
                                        <a class="fa fa-check btn unpublish"
                                            href="pending_users.php?unapprove=<?php echo $user['id'] ?>">
                                        </a>
                                    <?php elseif ($user['approved'] == false): ?>
                                        <a class="fa fa-times btn publish"
                                            href="pending_users.php?approve=<?php echo $user['id'] ?>">
                                        </a>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a class="fa fa-pencil btn edit"
                                        href="users.php?edit-user=<?php echo $user['id'] ?>">
                                    </a>
                                </td>
                                <td>
                                    <a class="fa fa-trash btn delete" 
                                        href="users.php?delete-user=<?php echo $user['id'] ?>">
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
