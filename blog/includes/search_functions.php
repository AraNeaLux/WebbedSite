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
        $posts = searchKeyword($keyword);
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

function searchKeyword($keyword){
    global $conn;
    $sql = "SELECT * FROM posts WHERE published=true AND ((title LIKE CONCAT('%','$keyword','%')) 
        OR (body LIKE CONCAT('%','$keyword','%')))"; 
    $raw_results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($raw_results) > 0){
        $posts = mysqli_fetch_all($raw_results, MYSQLI_ASSOC);
	} else{ // if there is no matching rows do following
        $posts = array();
    }
   return $posts; 
}
?>
