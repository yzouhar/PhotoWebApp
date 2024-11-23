<!DOCTYPE html>
<html>
    <head>
        <title>
            Register
        </title>
        <link rel = "stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <!--register form-->
        <form method="post" action="register.php">
            <label for="user">Username:</label>
            <input type="text" id="user" name="user"><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br>
            <label for="pass">Password:</label>
            <input type="text" id="pass" name="pass"><br>
            <input type ="submit" value="Register" name="register">
        </form>

        <br><br>
        <a href="loginview.php" class="button">Back to Login</a>
        
    </body>
</html>