<?php


require_once('config.data.php');
//connect to database
$mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

// Check for errors 
if ($mysqli->connect_error) { 
    die('Connection failed!'); 
} 

//need to get post id somehow

$SQL = $mysqli->prepare("UPDATE posts SET Likes = Likes - 1 WHERE id = ?");
$SQL->bind_param('i', $id);

$SQL->execute(); 


?>