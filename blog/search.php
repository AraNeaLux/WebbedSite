<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/search_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Retrieve all posts from database  -->
<?php $posts = getSearchResults(); ?>
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
    <link rel="stylesheet" href="static/css/search_results.css">
    <title>Webbed Site | Search </title>
</head>
<body>
        <!-- navbar -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>
        <?php include(ROOT_PATH . '/includes/banner.php') ?>
        <!-- Page content -->
        <main>
            <hr>
                <?php if (count($posts) == 0): ?>
                    <h2 class="content-title">No results for "<?php echo getSearchTerm(); ?>"</h2>
                <?php else: ?>
                    <h2 class="content-title">Search Results for "<?php echo getSearchTerm(); ?>"</h2>
                    <?php foreach ($posts as $post): ?>
                        <div class="post" aria-label="post" style="margin-left: 10px;">
                        <h3>
                        <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                            <?php echo $post['title'] ?></a>
                        </h3>
                        <div class="phrase" aria-label="phrase">
                        <?php getKeywordPhrase($_GET['query'],$post['id']) ?>
                        </div>
                        </div>
<?php endforeach ?>
<?php endif ?> 
</main>       
        <!-- footer -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
