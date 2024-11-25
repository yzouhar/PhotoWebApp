<?php
session_start();

require_once('config.data.php');
//connect to database
$mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

// Check for errors 
if ($mysqli->connect_error) { 
    die('Connection failed!'); 
} 

//need to get post id somehow
$userid = $_SESSION['id']; // User ID from the session
$postid = $_GET['post_id'] ?? null; // Post ID from the request (e.g., GET/POST)

if (!$userid || !$postid) {
    die('Invalid request.');
}

$SQLCheck = $mysqli->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
$SQLCheck->bind_param('ii', $userid, $postid);
$SQLCheck->execute();
$result = $SQLCheck->get_result();

if ($result->num_rows > 0) {
    // User has already liked the post, so remove the like
    $SQLDelete = $mysqli->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
    $SQLDelete->bind_param('ii', $userid, $postid);
    if ($SQLDelete->execute()) {
        // Decrement the likes count
        $SQLUpdate = $mysqli->prepare("UPDATE posts SET Likes = Likes - 1 WHERE id = ?");
        $SQLUpdate->bind_param('i', $postid);
        $SQLUpdate->execute();
        echo "Like removed.";
    } else {
        echo "Failed to remove like.";
    }
    $SQLDelete->close();
} else {
    // User has not liked the post, so add the like
    $SQLInsert = $mysqli->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
    $SQLInsert->bind_param('ii', $userid, $postid);
    if ($SQLInsert->execute()) {
        // Increment the likes count
        $SQLUpdate = $mysqli->prepare("UPDATE posts SET Likes = Likes + 1 WHERE id = ?");
        $SQLUpdate->bind_param('i', $postid);
        $SQLUpdate->execute();
        echo "Like added.";
    } else {
        echo "Failed to add like.";
    }
    $SQLInsert->close();
}
$SQLCheck->close();
$SQLUpdate->close();


?>