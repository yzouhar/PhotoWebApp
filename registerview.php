<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="topnav">
        <img src="./images/icon.png/" id="icon" style="width: 50px;height: 50px;float: left;">
        <a href="index.php">Home</a>
        <a href="trending.php">Trending</a>
        <a class="active split" href="loginview.php">Login</a>
    </div>

    <div class="form-container">
        <form method="post" action="register.php" class="login-form">
            <h1>Register</h1>
            <label for="user">Username:</label>
            <input type="text" id="user" name="user" placeholder="Enter your username" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required><br>
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" placeholder="Enter your password" required><br>
            <input type="submit" value="Register" name="register" class="submit-button">
            <div class="extra-links">
                <p>Already have an account? 
                    <a href="loginview.php" class="link">Sign In!</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
