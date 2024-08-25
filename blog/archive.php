<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPostsNewest5(); ?>
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
    <link rel="stylesheet" href="static/css/post_section.css">
    <title>Webbed Site | Home </title>
</head>
<body>
        <!-- navbar -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>
        <?php include(ROOT_PATH . '/includes/banner.php') ?>
        <!-- Page content -->
        <main id="maincontent">
            <h2 class="content-title">Recent Articles</h2>
            <hr>
<?php foreach ($posts as $post): ?>
    <div class="post" aria-label="post" style="margin-left: 10px;">
    <img src="<?php echo BASE_URL . 'static/images/' . $post['image']; ?>" class="post_image" alt="<?php echo $post['alt']; ?>">
    <h3>
    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
        <?php echo $post['title'] ?></a>
    </h3>
        <time datetime="<?php echo date("F j, Y ", strtotime($post["created_at"])); ?>">
        <?php echo date("F j, Y ", strtotime($post["created_at"])); ?></time>
    <?php if (isset($post['topic']['name'])): ?>
        <a 
         href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>"
         class="btn_category">
         <?php echo $post['topic']['name'] ?>
        </a>
    <?php endif ?>        
    </div>
<?php endforeach ?>
        <!-- footer -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
