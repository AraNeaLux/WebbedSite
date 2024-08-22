<a href="#maincontent">Skip to main content</a>
<nav>
    <h1>
        <a href="index.php"><h1>LifeBlog</h1></a>
    </h1>
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="guestbook.php">Guest Book</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
        <li aria-label="Search">
    <!-- (A) SEARCH FORM -->
    <search>
        <form method="get" action="<?php echo BASE_URL . 'search.php'; ?>">
            <label for="query">Search</label>
            <input type="text" id="query" name="query" required>
            <input type="submit" value="Enter">
        </form>
    </search>
    </li>
</ul>
</nav>
