<?php  include('../config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/header.php'); ?>
        <title>Admin | Dashboard</title>
<?php if (!isAdmin() AND !isAuthor()) {
        $_SESSION['msg'] = "You must log in as an admin first";
        header('location: ../login.php');
} ?>
</head>
<body>
        <div class="header">
                <div class="logo">
                        <a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
                                <h1>LifeBlog - Admin</h1>
                        </a>
                </div>
                <?php if (isset($_SESSION['user'])): ?>
                        <div class="user-info">
                                <span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
                                <a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">logout</a>
                        </div>
                <?php endif ?>
        </div>
        <div class="container dashboard">
                <h1>Welcome</h1>
                <div class="stats">
                        <a href="users.php" class="first">
                                <span>43</span> <br>
                                <span>Newly registered users</span>
                        </a>
                        <a href="posts.php">
                                <span>43</span> <br>
                                <span>Published posts</span>
                        </a>
                        <a>
                                <span>43</span> <br>
                                <span>Published comments</span>
                        </a>
                </div>
                <br><br><br>
                <div class="buttons">
                    <?php if (isAdmin()): ?>
                        <a href="users.php">Add Users</a>
                    <?php endif ?>
                        <a href="posts.php">Add Posts</a>
                </div>
        </div>
</body>
</html>

