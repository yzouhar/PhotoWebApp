<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="topnav">
        <img src="./images/icon.png/" id="icon" style="width: 50px;height: 50px;float: left;">
        <a href="index.php">Home</a>
        <a href="trending.php">Trending</a>
        <?php
        session_start();
        
        if (isset($_SESSION['username'])) {
            echo '<a href="profilepage.php">My Profile</a>';
            echo '<a href="logout.php" class="split">Logout</a>';
        } else {
            echo '<a class="active split" href="loginview.php">Login</a>';
        }
        ?>
    </div>


    <div class="form-container">
        <form method="post" action="login.php" class="login-form">
            <h1>Login</h1>
            <label for="user">Username:</label>
            <input type="text" id="user" name="user" placeholder="Enter your username" required><br>
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" placeholder="Enter your password" required><br>
            <input type="submit" value="Login" name="login" class="submit-button">
            <div class="extra-links">
            <p>Don't have an account? 
              <a href="registerview.php" class="link">Sign Up!</a>
            </p>
        </div>
        </form>
        
    </div>
</body>
</html>
