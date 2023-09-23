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

function getCommentsForPost($postId) {
    global $conn;
    $comments = array();

    // Query to fetch comments for the specified post
    $commentQuery = "SELECT * FROM `comments` WHERE `comment_id` = $postId";
    $commentResult = mysqli_query($conn, $commentQuery);

    if ($commentResult) {
        // Check if there are comments for this post
        if (mysqli_num_rows($commentResult) > 0) {
            // Iterate through comments for this post
            while ($comment = mysqli_fetch_assoc($commentResult)) {
                $comments[] = $comment;
            }
        }
    }

    return $comments;
}
