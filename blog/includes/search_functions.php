<?php 
// Variables
$keyword = "";

// Basic search function

function getSearchResults(){
    global $conn;
    if (isset($_GET['query'])) {
        $keyword = $_GET['query'];
        $keyword = mysqli_real_escape_string($conn, $keyword);
        $keyword = htmlspecialchars($keyword);
        $posts = searchKeywordText($keyword);
        return $posts;
    }
}

function getSearchTerm(){
    global $conn;
    if (isset($_GET['query'])) {
        $keyword = $_GET['query'];
        $keyword = mysqli_real_escape_string($conn, $keyword);
        $keyword = htmlspecialchars($keyword);
        return $keyword;    
    }
}

function searchKeywordText($keyword){
    global $conn;
    $sql = "SELECT * FROM posts WHERE published=true AND ((body LIKE CONCAT('%','$keyword','%')) OR (title LIKE CONCAT('%','$keyword','%'))) ORDER BY created_at DESC"; 
    $raw_results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($raw_results) > 0){
        $posts = mysqli_fetch_all($raw_results, MYSQLI_ASSOC);
	} else{ // if there is no matching rows do following
        $posts = array();
    }
   return $posts; 
}

function getKeywordPhrase($keyword, $post_id){
    // get post from database
    global $conn;
    $sql = "SELECT * FROM posts WHERE id=$post_id AND published=true";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    $post_text = strip_tags($post['body']);

    // get position of keyword and other variables
    $key_pos = strpos($post_text,$keyword);
    $key_len = strlen($keyword);
    $body_len = strlen($post_text);
    $radius = 50;
    $pre_key_totlen = $key_pos;
    $post_key_totlen = $body_len-($key_pos+$key_len);


    if (str_contains($post_text, $keyword)) {
        // check if there are more than 50 chars before keyword
        // if yes, take 50 preceding
        // if no, take however many preceding
        if ($pre_key_totlen >= $radius){
            $pre_key_str = substr($post_text,($pre_key_totlen-$radius-1),-($post_key_totlen+$key_len));
            $pre_key_str = "..." . $pre_key_str;
        } else {
            $pre_key_str = substr($post_text,0,$pre_key_totlen);
        }
        // same for chars following keyword
        if ($post_key_totlen >= $radius){
            $post_key_str = substr($post_text,($key_pos+$key_len),($radius));
            $post_key_str = $post_key_str . "...";
        } else {
            $post_key_str = substr($post_text,($key_pos+$key_len),$radius);
        }
        echo $pre_key_str . "<strong>" . $keyword. "</strong>" . $post_key_str;
    } else {
    if ($body_len >= $radius*2){
        echo substr($post_text,0,($radius*2)) . "...";
    } else {
        echo $post_text;
    }
}
}
?>
