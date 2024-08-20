<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/search_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Retrieve all posts from database  -->
<?php $posts = getSearchResults(); ?>
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
    <title>LifeBlog | Search </title>
</head>
<body>
    <!-- container - wraps whole page -->
    <div class="container">
        <!-- navbar -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>
        <?php include(ROOT_PATH . '/includes/banner.php') ?>
        <!-- Page content -->
        <div class="content">
            <hr>
                <?php if (count($posts) == 0): ?>
                    <h2 class="content-title">No results for "<?php echo getSearchTerm(); ?>"</h2>
                <?php else: ?>
                    <h2 class="content-title">Search Results for "<?php echo getSearchTerm(); ?>"</h2>
                    <?php foreach ($posts as $post): ?>
                        <div class="post" style="margin-left: 0px;">
                        <img src="<?php echo BASE_URL . 'static/images/' . $post['image']; ?>" class="post_image" alt="<?php echo $post['alt']; ?>">
                    <?php if (isset($post['topic']['name'])): ?>
                    <a 
                    href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>"
                    class="btn category">
                    <?php echo $post['topic']['name'] ?>
                    </a>
                    <?php endif ?>        
    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
        <div class="post_info">
            <h3><?php echo $post['title'] ?></h3>
            <div class="info">
                <span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                <span class="read_more">Read more...</span>
            </div>
        </div>
        </a>
    </div>
<?php endforeach ?>
<?php endif ?>        
        </div>
        <!-- // Page content -->
        <!-- footer -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
