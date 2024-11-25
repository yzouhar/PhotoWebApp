<?php
session_start();

require_once('config.data.php');
$mysqli = new mysqli(HOST, USER, PASSWORD, DB, PORT);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
$SQL = "
    SELECT posts.id, posts.Picture, posts.likes, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.likes DESC
    LIMIT 10";
$result = $mysqli->query($SQL);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $base64Image = base64_encode($row['picture']);
        echo '<div class="post">';
        echo '<h3>Posted by: ' . $row['username']. '</h3>';
        echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Trending Post" loading="lazy">';
        echo '<p>Likes: ' . $row['likes'] . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No trending posts to display.</p>';
}

$mysqli->close();
?>