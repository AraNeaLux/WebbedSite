<?php

function UserExists($user_id){
    global $conn;
    $sql = "SELECT * FROM users WHERE id=$user_id AND approved=1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $user;
}

function getUserMessages($user_id) {
    global $conn;
    $sql = "SELECT * FROM guestbook WHERE user_id=$user_id AND approved=1 ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $messages;
}

function getUserPosts($user_id) {
    global $conn;
    $sql = "SELECT * FROM posts WHERE user_id=$user_id AND published=1 ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}
?>
