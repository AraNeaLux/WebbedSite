<?php if (isset($_SESSION['user']['username'])) { ?>
        welcome <?php echo $_SESSION['user']['username'] ?>
        |
        <a href="logout.php">logout</a>

<?php }else if (str_ends_with($_SERVER['REQUEST_URI'],'index.php')){ ?>
    <a href="register.php" class="btn">Join us!</a>
    <div aria-label="login">
        <form action="index.php" method="post" >
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password"  placeholder="Password">
            <button class="btn" type="submit" name="login_btn">Sign in</button>
        </form>
    </div>
</div>
<?php } else { ?>
    <div class="log_in_info">
        <span><a href="register.php">register</a></span>
        <span> or </span>
        <span><a href="login.php">login</a></span>
    </div>
<?php } ?>
