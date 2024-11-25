<!DOCTYPE html>
<head>
    <title>
        Profile Page
    </title>
    <link rel = "stylesheet" type="text/css" href="main.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./trending.php">Trending</a></li>
            <?php
            session_start();

            if (isset($_SESSION['username'])) {
                echo '<li><a href="./logout.php" class="split">Logout</a></li>';
            }
            else {
                echo '<li><a href="./loginview.php" class="split">Login</a></li>';
            }
            ?>
        </ul>
    </nav>


    <?php

    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

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

        echo "<h1><strong>{$_SESSION['username']}</strong></h1>";

        echo "<h2>$email</h2>";

        echo "<p><strong>$numpost</strong> <small>Posts</small></p>";

        echo '<hr width="100%" color="black" size="3">';

        //add all post by user here

    }
    else {
        echo "<h1><strong>You are not Log in</strong></h1>";
        echo "<h2>Please Log in to check your profile</h2>";
    }
    ?>


    <div class="grid-item">
        <?php


        if (isset($_SESSION['username'])) {
            $stmt = $mysqli->prepare("SELECT picture FROM posts WHERE user_id = ?");
            $stmt->bind_param("s", $_SESSION['id']);
            $stmt->execute();  // Execute the statement
            $result = $stmt->get_result();  // Get the result from the statement

            // Check if there are results
            if ($result->num_rows > 0) {

                while ($obj = $result->fetch_object()) {

                    $base64Image = base64_encode($obj->picture);

                    echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="picture" loading="lazy">';
                }

            }

            $result->free_result();
            $stmt->close();
        }
        ?>
    </div>
    
</body>


