<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/guestbook_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Retrieve all posts from database  -->
<?php $messages = getLatestMessages(); ?>
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
                <?php if (count($messages) == 0): ?>
                    <h2 class="content-title">No signatures in the guestbook!</h2>
                <?php else: ?>
                    <h2 class="content-title">Guestbook</h2>
                    <?php foreach ($messages as $message): ?>
                        <div class="post" aria-label="post" style="margin-left: 10px;">
                        <h3>
                        <a href="user_profile.php?pid=<?php echo $message['user_id']; ?>">
                            <?php echo getMessageAuthor($message['user_id']) ?></a>
                        </h3>
                        <div class="phrase" aria-label="phrase">
                        <?php echo $message['message'] ?>
                        </div>
                        </div>
<?php endforeach ?>
<?php endif ?> 
</main>       
        <!-- footer -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
