<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php if (!isAuthor() AND !isAdmin()) {
        $_SESSION['msg'] = "You must log in as an admin first";
        header('location: ../login.php');
} ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/header.php'); ?>
<!-- Get all topics -->
<?php $topics = getAllTopics();      ?>
        <title>Admin | Create Post</title>
</head>
<body>
    <!-- admin navbar -->
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

    <div class="container content">
        <!-- Left side menu -->
        <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

        <!-- Middle form - to create and edit  -->
        <div class="action create-post-div">
            <h1 class="page-title">Create/Edit Post</h1>
            <form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/create_post.php'; ?>" >
                <!-- validation errors for the form -->
                <?php include(ROOT_PATH . '/includes/errors.php') ?>

                <!-- if editing post, the id is required to identify that post -->
                <?php if ($isEditingPost === true): ?>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <?php endif ?>

                <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
                <label style="float: left; margin: 5px auto 5px;">Featured image</label>
                <input type="file" accept="image/*" name="featured_image" >
                <input type="text" name="alt" value="<?php echo $alt; ?>" placeholder="Image alt text">
                <textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
                <select name="topic_id">
                <option value="" disabled selected hidden>Choose Topic</option>
                        <?php foreach ($topics as $topic): ?>
                                <option value="<?php echo $topic['id']; ?>">
                                        <?php echo $topic['name']; ?>
                                </option>
                        <?php endforeach ?>
                </select>
                
                <!-- Only admin users can view publish input field -->
                <?php if (isAdmin()): ?>
                        <!-- display checkbox according to whether post has been published or not -->
                        <?php if ($published == true): ?>
                                <label for="publish">
                                        Publish
                                        <input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
                                </label>
                        <?php else: ?>
                                <label for="publish">
                                        Publish
                                        <input type="checkbox" value="1" name="publish">&nbsp;
                                </label>
                        <?php endif ?>
                <?php endif ?>
                
                <!-- if editing post, display the update button instead of create button -->
                <?php if ($isEditingPost === true): ?> 
                        <button type="submit" class="btn" name="update_post">UPDATE</button>
                <?php else: ?>
                        <button type="submit" class="btn" name="create_post">Save Post</button>
                <?php endif ?>

                        </form>
                </div>
                <!-- // Middle form - to create and edit -->
        </div>
</body>
</html>

<script>
        CKEDITOR.replace('body');
</script>
