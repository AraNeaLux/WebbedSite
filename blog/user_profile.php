<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/profile_public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/guestbook_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Retrieve all posts from database  -->
<?php $messages = getUserMessages($_GET['id']); ?>
<?php $posts = getUserPosts($_GET['id']); ?>
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
    <link rel="stylesheet" href="static/css/search_results.css">
    <link rel="stylesheet" href="static/css/post_section.css">
    <title>Webbed Site | Search </title>
</head>
<body>
        <!-- navbar -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>
        <?php include(ROOT_PATH . '/includes/banner.php') ?>
        <!-- Page content -->
        <main>
            <hr>
            <?php if (UserExists($_GET['id'])): ?>
                <?php if (count($messages) == 0): ?>
                    <h2 class="content-title">No signatures in the guestbook</h2>
                <?php else: ?>
                    <h2 class="content-title">Guestbook</h2>
                    <?php foreach ($messages as $message): ?>
                        <div class="result" aria-label="message" style="margin-left: 10px;">
                        <h3>
                        <a href="user_profile.php?pid=<?php echo $message['user_id']; ?>">
                            <?php echo getMessageAuthor($message['user_id'])?></a>
                        <time datetime="<?php echo date("F j, Y ", strtotime($message["created_at"])); ?>">
                        <?php echo date("F j, Y ", strtotime($message["created_at"])); ?></time>
                        </h3>
                        <div class="phrase" aria-label="phrase">
                        <?php echo $message['message'] ?>
                        </div>
                        </div>
<?php endforeach ?>
<?php endif ?> 
                <?php if (count($posts) == 0): ?>
                <?php else: ?>
                    <h2 class="content-title">Posts Authored</h2>
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
<?php endif ?> 
<?php else: ?>
    <h2>User not found</h2>
<?php endif ?>
</main>       
        <!-- footer -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
