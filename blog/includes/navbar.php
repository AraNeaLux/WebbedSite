<link rel="stylesheet" href="static/css/navbar.css">
<a href="#maincontent">Skip to main content</a>
    <h1>
        <a href="index.php">Webbed Site</a>
    </h1>
<nav>
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="guestbook.php">Guest Book</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="archive.php">Archive</a></li>
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
