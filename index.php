<!--
Thanks homie from https://www.youtube.com/watch?v=tbt9oGgYwFc&pp=ygUcbWFzb25yeSBsYXlvdXQganMgaG9yaXpvbnRhbA%3D%3D
ur code helped and thanks devs at colcade.js

and the authors @ Unsplash
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="main.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="icon" type="image/x-icon" href="./images/icon.png">
  <title>PhotoNest</title>
</head>
<body style="background-color: #2d3641;">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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

<br>
<div id="title"><h1>PhotoNest</h1></div>

<div class="container">

  <!-- Add images -->
  <form method="post" action="addpost.php" enctype="multipart/form-data">
    <label class="userUpload"> <h4> Upload: </h4></label><br>
    <input type="file" name="imageUpload" class="userUpload" accept="image/png, image/gif, image/jpeg">
    <br><br>
    <input type="submit" value="Submit" id="uploadButton" name = "uploadpost">
  </form>
  <br><br>

  <div class="grid">
    <div class="grid-col grid-col--1">

    </div>
    <div class="grid-col grid-col--2">

    </div>
    <div class="grid-col grid-col--3">

    </div>
    <div class="grid-col grid-col--4">

    </div>

    <!-- Add images from the database -->
    <?php
    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
        die('Connection failed!'); 
    }

    if (isset($_SESSION['username'])) { // only generate images if logged in
      $SQL = "SELECT picture, id FROM posts";
      if ($result = $mysqli->query($SQL)) {

        while ($obj = $result->fetch_object()) {

            $base64Image = base64_encode($obj->picture);

            echo '<div class="grid-item" id = "'. $obj->id . '"><img src="data:image/jpeg;base64,' . $base64Image . '" alt="picture" loading="lazy"></div>';
        }

        $result->free_result();
      }
    }
    ?>

    <?php
    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
        die('Connection failed!'); 
    } 

    $SQL = "SELECT post_id, user_id FROM likes";
    if ($result = $mysqli->query($SQL)) {

      while ($obj = $result->fetch_object()) {

        // Ensure we only see likes made by the current logged-in user
        if (isset($_SESSION['username'])) {
          if ($obj->user_id == $_SESSION["id"]) {
              echo "
              <script>
                  var pic = document.getElementById('" . $obj->post_id . "');

                  if (pic.children.length < 2) {
                    var label = document.createElement('div');
                    label.classList.add('image-label');

                    var icon = document.createElement('i');
                    icon.classList.add('bi', 'bi-heart-fill');
                    icon.style = \"color:#DE3163;\"
                    

                    label.appendChild(icon);

                    pic.appendChild(label);
                  }
              </script>
              ";
          }
        }  
      }

      $result->free_result();
    }
    ?>

    <script>
      $(document).ready(function(){
        $(".grid-item").dblclick(function(){
          const div_id = $(this).attr("id");
          $.ajax({
            url: 'like.php',
            type: "GET",
            data: {post_id: div_id}
          });
        });
      });
    </script>

</div>

<script src="https://unpkg.com/colcade@0/colcade.js"></script>
<script src="index.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    var colc = new Colcade('.grid', {
      columns: '.grid-col',
      items: '.grid-item',
    });
  });
</script>

</body>
</html>