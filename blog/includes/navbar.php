<div class="navbar">
    <div class="logo_div">
        <a href="index.php"><h1>LifeBlog</h1></a>
    </div>
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="#news">News</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
    </ul>


<!-- (A) SEARCH FORM -->
<form method="post" action="<?php echo BASE_URL . 'search.php'; ?>">
    <input type="text" name="search" placeholder="Search..." required>
    <button type="submit" class="btn" name="enter_search">Search</button>
</form>

</div>
