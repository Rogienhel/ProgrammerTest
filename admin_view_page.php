<?php
  include 'include\db.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE-edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

    <title> Edit User </title>
    <link rel="stylesheet" href="style.css">
    <script src="check.js"></script>
  </head>
  <body>
    <script src = "check.js"></script>
    <?php
    $toView = $_GET['viewID'];
    $sql = "SELECT * FROM users WHERE user_id = $toView;";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    echo
    '<div class = "form-container">
      <form action = "" method = "post">
        <div class = "form" id = "form">
          <h1>Edit User</h1><br>
          <h2>User Account</h2><hr>
          <div class = "form-control" id = "form-control">
            <label>Username</label>
            <input class = "form-npt" type = "button" name = "username" id = "npt-btn" value = "'.$row['username'].'"><br>
          </div>
          <div class = "form-control">
            <label>Email Address</label>
            <input class = "form-npt" type = "button" name = "email" id = "npt-btn" value = "'.$row['user_email'].'"><br>
          </div>
          <h2>User Profile</h2><hr>
          <div class = "form-control">
            <label>Fullname</label>
            <input class = "form-npt" type = "button" name = "fname" id = "npt-btn" value = "'.$row['user_fname'].' '.$row['user_mname'].' '.$row['user_lname'].'"><br>
          </div>
          <div class = "form-control">
            <label>Address</label>
            <input class = "form-npt" type = "button" name = "home_add" id = "npt-btn" value = "'.$row['user_add'].'"><br>
          </div>
          <div class = "form-control">
            <label>Company</label>
            <input class = "form-npt" type = "button" name = "company" id = "npt-btn" value = "'.$row['user_company'].'"><br>
          </div>
          <div class = "form-control">
            <label>Contact number</label>
            <input class = "form-npt" type = "button" name = "contact_num" id = "npt-btn" value = "'.$row['user_company'].'"><br>
          </div>
          <div class = "form-control">
            <label>Position</label>
            <input class = "form-npt" type = "button" name = "position" id = "npt-btn" value = "'.$row['user_position'].'"><br>
          </div>
          <div class = "form-control">
            <label>Status</label>
            <input class = "form-npt" type = "button" name = "status" id = "npt-btn" value = "'.$row['user_status'].'"><br>
          </div>
          <div class = "form-control">
            <label>Status</label>
            <input class = "form-npt" type = "button" name = "type" id = "npt-btn" value = "'.$row['user_type'].'"><br>
          </div>

          <div class = "form-control" id = "subref">
            <a href = "edit_page.php?editID='.$row['user_id'].'" id = "consistent">Edit</a>
            <a href = "include/delete.php?deletedID='.$row['user_id'].'" id = "btn" class = "fas fa-trash-alt btn-delete"></a>
            <a href = "config.php" id = "consistent">Back</a>
          </div>
        </div>
      </form>

    </div>
  </body>
  </html>';
