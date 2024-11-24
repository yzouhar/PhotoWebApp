<!--
Thanks homie from https://www.youtube.com/watch?v=tbt9oGgYwFc&pp=ygUcbWFzb25yeSBsYXlvdXQganMgaG9yaXpvbnRhbA%3D%3D
ur code helped and thanks devs at colcade.js

and the authors @ Unsplash
-->

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="main.css">
  <title>PhotoNest</title>
</head>
<body>

<div class="container">

  <nav>
    <ul>
      <li><a href="./trending.html">Trending</a></li>
      <li><a href="./profile.html">Profile</a></li>
    </ul>
  </nav>

  <div class="grid">
    <div class="grid-col grid-col--1">

    </div>
    <div class="grid-col grid-col--2">

    </div>
    <div class="grid-col grid-col--3">

    </div>
    <div class="grid-col grid-col--4">

    </div>

    <?php
    require_once('config.data.php');
    //connect to database
    $mysqli = new mysqli (HOST, USER, PASSWORD, DB, PORT);

    // Check for errors 
    if ($mysqli->connect_error) { 
        die('Connection failed!'); 
    }

    //uploads/' . htmlspecialchars($obj->picture) . '

    $SQL = "SELECT picture FROM posts";
    if ($result = $mysqli->query($SQL)) {

        while ($obj = $result->fetch_object()) {

            $base64Image = base64_encode($obj->picture);

            echo '<div class="grid-item"><img src="data:image/jpeg;base64,' . $base64Image . '" alt="picture" loading="lazy"></div>';
        }

        $result->free_result();
    }
    ?>

    <div class="grid-item">
      <img src="images/1.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/2.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/3.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/3.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/4.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/5.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/6.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/7.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/8.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/9.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/10.jpg" alt="picture">
    </div>
    <div class="grid-item">
      <img src="images/11.jpg" alt="picture">
    </div>
  </div>

  <form method="post" action="addpost.php">
    <label> Upload </label>
    <input type="file" name="imageUpload" id="userUpload" accept="image/png, image/gif, image/jpeg">
    <input type="button" value="Submit" id="uploadButton">
  </form>
  <img id="previewImage" alt="Image Preview" style="display:none; width: 300px; margin-top: 20px;">

</div>

<script src="https://unpkg.com/colcade@0/colcade.js"></script>
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

