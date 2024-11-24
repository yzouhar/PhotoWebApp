<!DOCTYPE html>
<html>
    <head>
        <title>
            Login
        </title>
        <link rel = "stylesheet" type="text/css" href="main.css">
    </head>
    <body>

        <div class="topnav">
        <a href="index.php">Home</a>
        <a href="trending.php">Trending</a>
        <?php
        session_start();

        if (isset($_SESSION['username'])) {
            echo '<a href="profilepage.php">My Profile</a>';
            echo '<a href="logout.php" class="split">Logout</a>';
        }
        else {
            echo '<a class="active split" href="loginview.php">Login</a>';
        }
        ?>
        </div>

        <!--login form-->
        <form method="post" action="login.php">
            <label for="user">Username:</label>
            <input type="text" id="user" name="user"><br>
            <label for="pass">Password:</label>
            <input type="text" id="pass" name="pass"><br>
            <input type ="submit" value="Login" name="login">
        </form>

        <br><br>
        <a href="registerview.php" class="button">Register</a>

        <a href="profilepage.php" class="button">Profile</a>
        
    </body>
</html>