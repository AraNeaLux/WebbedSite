<?php 
        session_start();
        // connect to database
        $conn = mysqli_connect("localhost", "root", "", "blog");

        if (!$conn) {
                die("Error connecting to database: " . mysqli_connect_error());
        }
    // define global constants
        define ('ROOT_PATH', realpath(dirname(__FILE__)));
        define('BASE_URL', 'http://127.0.0.1:8080/edsa-webbedsite/blog/');
?>
