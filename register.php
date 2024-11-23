<?php
if (isset($_POST['register'])) {

    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
    die('Connection failed!'); 
    } 

    //get data from form
    $user = $_POST['user'];
    $password = $_POST['pass'];
    $email = $_POST['email'];

    //Hashing the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $SQL = "INSERT INTO users (Username, Email, Password) VALUES ('$user', '$email', '$password')";
    if ($mysqli->query($SQL) === TRUE) {
        echo "<p class='success'> Account created successfully </php>";
    } else {
        echo "<p class='failed'> Error occurred when trying to create account </p>";
    }

    $mysqli -> close();

}
?>