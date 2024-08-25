<?php  include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include('includes/registration_login.php'); ?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="static/css/login.css">

<title>Webbed Site | Sign up </title>
</head>
<body>
    <!-- Navbar -->
    <?php include( ROOT_PATH . '/includes/navbar.php'); ?>
    <!-- // Navbar -->
    <main>
    <h2>Register on Webbed Site</h2>

    <form method="post" action="register.php" >
        <?php include(ROOT_PATH . '/includes/errors.php') ?>
        <label for="username">Username</label>
        <input type="text" id= "username" name="username" value="<?php echo $username; ?>">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email ?>">
        <label for="password_1">Password</label>
        <input type="password" id="password_1" name="password_1">
        <label for="password_2">Confirm Password</label>
        <input type="password" id="password_2" name="password_2">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </form>
    </br>
    Already a member? <a href="login.php">Sign in</a>
</main>
<!-- Footer -->
        <?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
