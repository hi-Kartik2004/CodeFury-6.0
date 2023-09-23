<?php
    session_start();
    require_once("config.php");
    $conn = mysqli_connect(server, host, password, db_name);
    function fetchPosts(){
        global $conn;
        $query = "SELECT * FROM `posts` ORDER BY `id` DESC";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $posts = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
    
                $_SESSION['posts'] = $posts;
            } else {
                $_SESSION["err"]["err_msg"] = "No posts Found!";
            }
        } else {
            $_SESSION["err"]["err_msg"] = "Error fetching posts: " . mysqli_error($conn);
        }
    
    }

    function fetchUserPosts($user){
        global $conn;
        $query = "SELECT * FROM `posts` WHERE `email` = '$user' ORDER BY `id` DESC";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $posts = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
    
                $_SESSION['posts'] = $posts;
            } else {
                $_SESSION["err"]["err_msg"] = "No posts Found!";
            }
        } else {
            $_SESSION["err"]["err_msg"] = "Error fetching posts: " . mysqli_error($conn);
        }
    }
