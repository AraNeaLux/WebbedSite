<?php 
/* * * * * * * * * * * * * * *
* Returns all published posts
* * * * * * * * * * * * * * */
function getPublishedPosts() {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=true";
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final_posts = array();
        foreach ($posts as $post) {
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
        }
        return $final_posts;
}

/* * * * * * * * * * * * * * *
* Receives a post id and
* Returns topic of the post
* * * * * * * * * * * * * * */
function getPostTopic($post_id){
        global $conn;
        $sql = "SELECT * FROM topics WHERE id=(SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $topic = mysqli_fetch_assoc($result);
        return $topic;
}

/* * * * * * * * * * * * * * *
* Receives a post id and
* Returns author of the post
* * * * * * * * * * * * * * */
function getPostAuthor($post_id){
    global $conn;
    $sql = "SELECT * FROM posts WHERE id=$post_id";
    $result = mysqli_query($conn, $sql);
    $author_id = mysqli_fetch_assoc($result)['user_id'];
    if ($author_id) {
        // return username
        $sql = "SELECT username FROM users WHERE id=$author_id";
        $result = mysqli_query($conn, $sql);
        $author = mysqli_fetch_assoc($result)['username'];
        return $author;
        } else {
            return null;
        }

}

/* * * * * * * * * * * * * * *
* Returns published posts by date published asc
* * * * * * * * * * * * * * */
function getPublishedPostsOldest() {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=true ORDER BY created_at ASC";
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final_posts = array();
        foreach ($posts as $post) {
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
        }
        return $final_posts;
}

/* * * * * * * * * * * * * * *
* Returns published posts by date updated desc
* * * * * * * * * * * * * * */
function getPublishedPostsNewest5() {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=true ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final_posts = array();
        for ($x = 0; $x <=4; $x+=1) {
            if ($x<sizeof($posts)){
                $post = $posts[$x];
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
            }
        }
        return $final_posts;
}

/* * * * * * * * * * * * * * *
* Returns published posts by date updated desc
* * * * * * * * * * * * * * */
function getPublishedPostsNewest() {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=true ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final_posts = array();
        foreach ($posts as $post) {
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
        }
        return $final_posts;
}

/* * * * * * * * * * * * * * *
* Returns published posts by date updated desc
* * * * * * * * * * * * * * */
function getPublishedPostsUpdated() {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=true ORDER BY updated_at DESC";
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final_posts = array();
        foreach ($posts as $post) {
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
        }
        return $final_posts;
}

/* * * * * * * * * * * * * * * *
* Returns all posts under a topic
* * * * * * * * * * * * * * * * */
function getPublishedPostsByTopic($topic_id) {
        global $conn;
        $sql = "SELECT * FROM posts ps 
                        WHERE ps.id IN 
                        (SELECT pt.post_id FROM post_topic pt 
                                WHERE pt.topic_id=$topic_id GROUP BY pt.post_id 
                                HAVING COUNT(1) = 1)";
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final_posts = array();
        foreach ($posts as $post) {
            if ($post['published']){
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
            }
        }
        return $final_posts;
}
/* * * * * * * * * * * * * * * *
* Returns topic name by topic id
* * * * * * * * * * * * * * * * */
function getTopicNameById($id)
{
        global $conn;
        $sql = "SELECT name FROM topics WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $topic = mysqli_fetch_assoc($result);
        return $topic['name'];
}
/* * * * * * * * * * * * * * *
* Returns a single post
* * * * * * * * * * * * * * */
function getPost($slug){
        global $conn;
        // Get single post slug
        $post_slug = $_GET['post-slug'];
        $sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
        $result = mysqli_query($conn, $sql);

        // fetch query results as associative array.
        $post = mysqli_fetch_assoc($result);
        if ($post) {
                // get the topic to which this post belongs
                $post['topic'] = getPostTopic($post['id']);
        }
        return $post;
}
/* * * * * * * * * * * *
*  Returns all topics
* * * * * * * * * * * * */
function getAllTopics()
{
        global $conn;
        $sql = "SELECT * FROM topics";
        $result = mysqli_query($conn, $sql);
        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $topics;
}
?>
