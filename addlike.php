<?php

//don't know if this is needed
session_start();


require_once('config.data.php');
//connect to database
$mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

// Check for errors 
if ($mysqli->connect_error) { 
    die('Connection failed!'); 
}  

//need to get post id somehow



// Initialize the 'liked' session array if not already set
if (!isset($_SESSION['liked'])) {
    $_SESSION['liked'] = array();
}

// Ensure the specific post ID is initialized
if (!isset($_SESSION['liked'][$userid])) {
    $_SESSION['liked'][$userid] = 0;
}

//if not liked yet or even amount
if ($_SESSION['liked'][$userid] % 2 == 0) {
    $SQL = $mysqli->prepare("UPDATE posts SET Likes = Likes + 1 WHERE id = ?");
    $SQL->bind_param('i', $postid);

    $SQL->execute();

    $_SESSION['liked'][$userid] += 1;
}//if liked or odd amount
elseif ($_SESSION['liked'][$userid] % 2 == 1) {
    $SQL = $mysqli->prepare("UPDATE posts SET Likes = Likes - 1 WHERE id = ?");
    $SQL->bind_param('i', $postid);

    $SQL->execute();

    $_SESSION['liked'][$userid] += 1;
}else{
    echo "Error!"
}
 


?>