<?php
session_start();

require_once('config.data.php');
$mysqli = new mysqli(HOST, USER, PASSWORD, DB, PORT);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
if (isset($_SESSION['username'])) {
    $SQL = "
        SELECT posts.likes, picture, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.likes DESC
        LIMIT 10";

    if ($result = $mysqli->query($SQL)) {
        while ($obj = $result->fetch_object()) {
            $base64Image = base64_encode($obj->picture);
            echo '<div class="post">';
            echo '<h3>Posted by: ' . $obj->username. '</h3>';
            echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Trending Post" loading="lazy">';
            echo '<p>Likes: ' . $obj->likes . '</p>';
            echo '</div>';
        }

        $result->free_result();
    } 

    else {
        echo '<p>No trending posts to display.</p>';
    }
}  

else {
    echo '<p>You must be logged in to view trending posts!</p>';
}

$mysqli->close();
?>