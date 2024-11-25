<!DOCTYPE html>
<html>
<head>
    <title>Trending</title>
    <!-- Correct path to your CSS file -->
    <link rel="stylesheet" type="text/css" href="trending.css?v">
    <link rel="icon" type="image/x-icon" href="./images/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>


<body>
<div class="topnav">
  <img src="./images/icon.png/" id="icon" style="width: 50px;height: 50px;float: left;">
  <a href="index.php">Home</a>
  <a href="trending.php">Trending</a>
  <?php
  session_start();
  
  if (isset($_SESSION['username'])) {
      echo '<a href="profilepage.php">My Profile</a>';
      echo '<a href="logout.php" class="split">Logout</a>';
  } else {
      echo '<a class="active split" href="loginview.php">Login</a>';
  }
  ?>
</div>

<?php

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

        echo '<div class="grid">';
        while ($obj = $result->fetch_object()) {
            $base64Image = base64_encode($obj->picture);
            echo '<div class="post">';
            echo '<h3>Posted by: ' . $obj->username. '</h3>';
            echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Trending Post" loading="lazy">';
            echo '<p>Likes: ' . $obj->likes . '</p>';
            echo '</div>';
        }
        echo '</div>';

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

<script src="https://unpkg.com/colcade@0/colcade.js"></script>
<script src="index.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        var colc = new Colcade('.grid', {
            columns: '.grid-col',
            items: '.grid-item',
        });
    });
</script>
</body>
</html>