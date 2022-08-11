<?php

  include 'include/db.php';

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE-edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

    <title> Log in </title>

    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <script src = "check.js"></script>

    <div class = "form-container">
      <form action = "include/login.php" method = "post">
        <div class = "form">
          <h1>Login Now</h1><br>
          <div class="form-control">
            <input class = "form-npt" type = "text" id = "npt" name = "username_mail" required placeholder = "Enter your email"><br>
            <input class = "form-npt" type = "password" id = "npt" name = "password" required placeholder = "Enter your password"><br>
            <div class = "form-control" id = "subref">
              <input type = "submit" name = "submit" value = "login now" id = "consistent">
              <p>Don't have an account?<a href = "register_page.php">Register now</a></p>
            </div>
          </div>
        </div>
    </div>
