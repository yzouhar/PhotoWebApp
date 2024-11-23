<!DOCTYPE html>
<html>
    <head>
        <title>
            Login
        </title>
        <link rel = "stylesheet" type="text/css" href="main.css">
    </head>
    <body>
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
        
    </body>
</html>