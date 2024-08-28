<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<?php require_once( ROOT_PATH . '/includes/guestbook_functions.php') ?>
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
            <?php if (isset($_SESSION['user'])): ?> 
            <h2>Sign Guestbook</h2>
            <?php include(ROOT_PATH . '/includes/messages.php') ?>
            <form method="post" action="<?php echo BASE_URL . 'guestbook.php'; ?>" >
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <label for="message">Message</label>
                <input type="text" id="message" name="message">
                <button type="submit" class="btn" name="sign_btn">Sign</button>
            </form>
            <?php endif ?>
                <?php if (count($messages) == 0): ?>
                    <h2 class="content-title">No signatures in the guestbook!</h2>
                <?php else: ?>
                    <h2 class="content-title">Guestbook</h2>
                    <?php foreach ($messages as $message): ?>
                        <div class="result" aria-label="message" style="margin-left: 10px;">
                        <h3>
                        <a href="user_profile.php?id=<?php echo $message['user_id']; ?>">
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
</main>       
        <!-- footer -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
