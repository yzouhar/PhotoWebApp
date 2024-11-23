<?php
session_start(); // Resume the session

if (isset($_POST['comment'])) {

    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
        die('Connection failed!'); 
    } 

    if (isset($_SESSION['username'])) {
        //get data from form
        $picid = $_POST['pictureid']; //find way to get it as part of form or other way
        $cont = $_POST['content'];
        $userid = $_SESSION['id'];

        $SQL = "INSERT INTO comments (Content, User_id, Post_id) VALUES ('$cont', '$userid', 'picid')";

        if ($mysqli->query($SQL) === TRUE) {
            echo "<p class='success'> Comment created successfully </php>";
        } else {
            echo "<p class='failed'> Error occurred when trying to create comment </p>";
        }



    } else {
        echo "You are not logged in.";
    }

    $mysqli -> close();
    
}
?>