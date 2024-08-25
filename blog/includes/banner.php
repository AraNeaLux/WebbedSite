<?php if (isset($_SESSION['user']['username'])) { ?>
        </br>
        welcome <?php echo $_SESSION['user']['username'] ?>
        |
        <a href="logout.php">logout</a>

<?php } else { ?>
    </br>
    <div aria-label="login" class="log_in_info">
        <span><a href="register.php">register</a></span>
        <span> or </span>
        <span><a href="login.php">login</a></span>
    </div>
<?php } ?>
