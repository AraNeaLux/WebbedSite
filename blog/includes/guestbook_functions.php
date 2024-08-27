<?php

function getLatestMessages() {
    $final_posts = array();
    $authors = getMessageAuthors();
    foreach ($authors as $author) {
        $latest_message = getLatestFromAuthor($author);
        array_push($final_posts, $latest_message);
    }
    return $final_posts;
}

function getMessageAuthors() {
    global $conn;
    $sql = "SELECT * FROM guestbook WHERE approved=1";
    $result = mysqli_query($conn, $sql);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $authors = array();
    foreach ($messages as $message) {
        $author = $message['user_id'];
        array_push($authors, $author);
    }
    $authors=array_unique($authors);
    return $authors;
}

function getLatestFromAuthor($user_id) {
    global $conn;
    $sql = "SELECT * FROM guestbook WHERE user_id=$user_id AND approved=1 ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $messages[0];
}

function getAllFromAuthor($user_id) {
    global $conn;
    $sql = "SELECT * FROM guestbook WHERE user_id=$user_id AND approved=1 ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $messages;
}

// get the author/username of a post
function getMessageAuthor($user_id)
{
        global $conn;
        $sql = "SELECT username FROM users WHERE id=$user_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
                // return username
                return mysqli_fetch_assoc($result)['username'];
        } else {
                return null;
        }
}
?>
