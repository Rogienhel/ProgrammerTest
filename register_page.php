<?php
  include 'include\db.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE-edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

    <title> Register Form </title>
    <link rel="stylesheet" href="style.css">
    <script src="check.js"></script>
  </head>
  <body>
    <script src = "check.js"></script>

    <div class = "form-container">
      <form action = "include/register.php<?php if(isset($_GET['userType'])){echo '?userType=admin';}?>" method = "post">
        <div class = "form" id = "form">
          <h1>Create User</h1><br>
          <h2>User Account</h2><hr>
          <div class = "form-control" id = "form-control">
            <label>Username</label>
            <input class = "form-npt" type = "text" name = "username" id = "npt" required placeholder = "Enter your username"><br>
          </div>
          <div class = "form-control">
            <label>Email Address</label>
            <input class = "form-npt" type = "email" name = "email" id = "npt" required placeholder = "Enter your email"><br>

          </div>
          <div class = "form-control">
            <label>Password</label>
            <input class = "form-npt" type = "password" name = "password" id = "npt" required placeholder = "Enter your password"><br>
          </div>
          <div class = "form-control">
            <label>Re-Type Password</label>
            <input class = "form-npt" type = "password" name = "re-type" id = "npt" required placeholder = "Enter your re-type password"><br>
          </div>
          <h2>User Profile</h2><hr>
          <div class = "form-control">
            <label>Firstname</label>
            <input class = "form-npt" type = "text" name = "fname" id = "npt" required placeholder = "Enter your firstname"><br>
          </div>
          <div class = "form-control">
            <label>Lastname</label>
            <input class = "form-npt" type = "text" name = "lname" id = "npt" required placeholder = "Enter your lastname"><br>
          </div>
          <div class = "form-control">
            <label>Middlename</label>
            <input class = "form-npt" type = "text" name = "mname" id = "npt" required placeholder = "Enter your middlename"><br>
          </div>
          <div class = "form-control">
            <label>Address</label>
            <input class = "form-npt" type = "address" name = "home_add" id = "npt" required placeholder = "Enter your address"><br>
          </div>
          <div class = "form-control">
            <label>Company</label>
            <input class = "form-npt" type = "" name = "company" id = "npt" required placeholder = "Enter your company"><br>
          </div>
          <div class = "form-control">
            <label>Contact number</label>
            <input class = "form-npt" type = "number" name = "contact_num" id = "npt" required placeholder = "Enter your contact number"><br>
          </div>
          <div class = "form-control">
            <label>Position</label>
            <input class = "form-npt" type = "address" name = "position" id = "npt" required placeholder = "Enter your position"><br>
          </div>

          <div class = "form-control">
            <select name="user_status" id = "user_status" class = "dropdownlist">
              <option value="active">ACTIVE</option>
              <option value="deactive">DEACTIVATE</option>
            </select>
          </div>

          <div class = "form-control" id = "subref">
            <input type = "submit" name = "submit" value = "register now" id = "consistent">
            <input type="reset" name="reset" value="Reset" id = "consistent">
            <p>Already have an account?<a href = "login_page.php">Login now</a></p>
          </div>
        </div>
      </form>

    </div>
  </body>
  </html>
