<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="icon" type="image/x-icon" href="./images/icon.png">
</head>
<body>

<!-- Navigation bar -->
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

<!-- Profile Section -->
<div class="profile-container">
    <?php
    require_once('config.data.php');
    $mysqli = new mysqli(HOST, USER, PASSWORD, DB, PORT);
    if ($mysqli->connect_error) {
        die('Connection failed!');
    }

    if (isset($_SESSION['username'])) {
        $SQL = $mysqli->prepare("SELECT Email FROM users WHERE Username = ?");
        $SQL->bind_param('s', $_SESSION['username']);
        $SQL->execute();
        $SQL->bind_result($email);
        $SQL->fetch();
        $SQL->close();

        $SQLposts = $mysqli->prepare("SELECT COUNT(id) AS numpost FROM posts WHERE user_id = ?");
        $SQLposts->bind_param('i', $_SESSION['id']);
        $SQLposts->execute();
        $SQLposts->bind_result($numpost);
        $SQLposts->fetch();
        $SQLposts->close();

        echo "<div class='profile-header'>";
        echo "<div class='profile-img'>";
        // Use default profile picture with lazy loading
        echo "<img src='images/default_profile.png' alt='Profile Picture' loading='lazy' />";
        echo "</div>";
        echo "<div class='profile-details'>";
        echo "<h1>{$_SESSION['username']}</h1>";
        echo "<h2>$email</h2>";
        echo "<p><strong>$numpost</strong> Posts</p>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<h1><strong>You are not logged in</strong></h1>";
        echo "<h2>Please log in to view your profile</h2>";
    }
    ?>
</div>

<!-- Display user's posts (if any) -->
<div class="user-posts">
    <?php
    if (isset($_SESSION['username'])) {
        $stmt = $mysqli->prepare("SELECT picture FROM posts WHERE user_id = ?");
        $stmt->bind_param("s", $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='posts-grid'>";
            while ($obj = $result->fetch_object()) {
                $base64Image = base64_encode($obj->picture);
                // Lazy load post images
                echo "<img class='post-img' src='data:image/jpeg;base64,$base64Image' alt='User Post' loading='lazy' />";
            }
            echo "</div>";
        }
        $result->free_result();
        $stmt->close();
    }
    ?>
</div>

</body>
</html>