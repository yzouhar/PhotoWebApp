<?php
session_start(); 
if (isset($_POST['login'])) {

    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
        die('Connection failed!'); 
    } 
    $username = $_POST['user']; 
    $password = $_POST['pass'];

    $SQL = $mysqli->prepare("SELECT id, Password FROM users WHERE Username = ?");
    $SQL->bind_param('s', $username); // 's' specifies the type as string

    $SQL->execute(); 
    $SQL->store_result();

    if ($SQL->num_rows > 0) {
        $SQL->bind_result($id, $hashed_password);

        $SQL->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true; 
            $_SESSION['id'] = $id; 
            $_SESSION['username'] = $username; 

            //redirect to another page here \/\/
        }
        else {
            echo "Incorrect password!";
        }
    }
    else {
        echo "User not found!";
    }

    $SQL->close();
    $mysqli->close();

    echo '<a href="profilepage.php" class="button">Profile</a>';


}
?>