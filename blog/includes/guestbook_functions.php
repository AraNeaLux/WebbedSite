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

$message = "";
$errors = array();

if (isset($_POST['sign_btn'])) {
    $user_id = $_SESSION['user']['id'];
    $message = esc($_POST['message']);

    if (empty($message)) {array_push($errors, "Message empty");}
    if (empty($errors)) {
        $query = "INSERT INTO guestbook (user_id, message, created_at) 
            VALUES('$user_id', '$message', now())";
        if (mysqli_query($conn, $query)){
            $_SESSION['message'] = "Message submitted successfully";
            header('location: guestbook.php');
            exit(0);
        }
        else {$_SESSION['message'] = "Something went wrong :(";}
    }
}



?>
