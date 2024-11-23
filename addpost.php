<?php
session_start(); // Resume the session

if (isset($_POST['post'])) {

    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
        die('Connection failed!'); 
    } 

    if (isset($_SESSION['username'])) {
        //get data from form
        $pic = isset($_POST['picture']) ? $_POST['picture'] : NULL;
        $cont = $_POST['content'];
        $userid = $_SESSION['id'];

        $SQL = "INSERT INTO posts (Picture, Content, User_id) VALUES ('$pic', '$cont', '$userid')";

        if ($mysqli->query($SQL) === TRUE) {
            echo "<p class='success'> Post created successfully </php>";
        } else {
            echo "<p class='failed'> Error occurred when trying to create post </p>";
        }



    } else {
        echo "You are not logged in.";
    }

    $mysqli -> close();
    
}
?>