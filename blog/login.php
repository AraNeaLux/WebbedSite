<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php  include('includes/header.php'); ?>
<link rel="stylesheet" href="static/css/login.css">
        <title>Webbed Site | Sign in </title>
</head>
<body>
        <!-- Navbar -->
        <?php include( ROOT_PATH . '/includes/navbar.php'); ?>
        <!-- // Navbar -->
<main>
        <h2>Login</h2>
        <form method="post" action="login.php" >
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <button type="submit" class="btn" name="login_btn">Login</button>
        </form>
        </br>
        Not yet a member? <a href="register.php">Sign up</a>
</main>
<!-- Footer -->
        <?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
