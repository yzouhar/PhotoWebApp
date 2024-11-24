<?php
session_start(); // Resume the session
    
if (isset($_POST['uploadpost'])) {

    require_once('config.data.php');
    // Connect to database
    $mysqli = new mysqli(HOST, USER, PASSWORD, DB, PORT);

    // Check for connection errors
    if ($mysqli->connect_error) { 
        die('Connection failed: ' . $mysqli->connect_error); 
    } 

    if (isset($_SESSION['username'])) {

        if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
            // Get file contents
            $pic = file_get_contents($_FILES['imageUpload']['tmp_name']);
            $userid = $_SESSION['id'];

            // Use a prepared statement to insert binary data
            $SQL = $mysqli->prepare("INSERT INTO posts (Picture, User_id) VALUES (?, ?)");
            $SQL->bind_param("bi", $pic, $userid); // "b" for blob, "i" for integer

            if ($SQL->send_long_data(0, $pic) && $SQL->execute()) {
                echo "<p class='success'> Post created successfully </p>";
            } else {
                echo "<p class='failed'> Error occurred: " . $SQL->error . "</p>";
            }

            $SQL->close();
        } else {
            echo "<p class='failed'> No image uploaded or an error occurred </p>";
        }

    } else {
        echo "You are not logged in.";
    }

    $mysqli->close();
}
?>