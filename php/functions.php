<?php
session_start();
require_once("config.php");
$conn = mysqli_connect(server, host, password, db_name);
function fetchPosts()
{
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

function fetchUserPosts($user)
{
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

function getUserPosts($user)
{
    global $conn;
    $query = "SELECT * FROM `posts` WHERE `email` = '$user' ORDER BY `id` DESC";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $posts = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $posts[] = $row;
            }

            return $posts; // Return the array of posts
        } else {
            return array(); // Return an empty array if no posts are found
        }
    } else {
        return false; // Return false to indicate an error
    }
}

function getPostById($id){
    global $conn;
    $query = "SELECT * FROM `posts` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $post = mysqli_fetch_assoc($result);
            return $post; // Return the array of posts
        } else {
            return array(); // Return an empty array if no posts are found
        }
    } else {
        return false; // Return false to indicate an error
    }
}

function getCommentsForPost($postId)
{
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

function getSessionDetails()
{
    global $conn;
    $query = "SELECT * FROM `sessions`;";
    $result = mysqli_query($conn, $query);

    $sessions = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sessions[] = $row;
        }
    }

    return $sessions;
}


function deleteOverSessions()
{
    global $conn;
    // Calculate today's date in the format YYYY-MM-DD
    $currentDate = date("Y-m-d");

    // Define a SQL query to delete sessions that have a date older than today
    $sql = "DELETE FROM `sessions` WHERE `date` < '$currentDate'";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
    } else {
        $_SESSION["err"]["err_msg"] = "Error deleting past sessions: ";
    }
}
