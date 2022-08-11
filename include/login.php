<?php
  include_once 'db.php';

if (isset($_POST['submit']))
  {
    $username_mail = $_POST['username_mail'];
    $password = $_POST['password'];

    if(empty($username_mail) || empty($password))
      {
        header("Location: ../login_page.php?error=emptyfields");
        exit();
      }
    else
      {
        $sql = "SELECT * FROM users WHERE username = ? OR user_email = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql))
          {
            header("Location: ../login_page.php?error=sqlerror");
            exit();
          }
        else
          {
            mysqli_stmt_bind_param($stmt, "ss", $username_mail, $username_mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result))
              {
                $passwordCheck = password_verify($password, $row['user_pwd']);
                if($passwordCheck == false)
                  {
                    header("Location: ../login_page.php?error=wrongpassword");
                    exit();
                  }
                else if($passwordCheck == true && $row['user_status'] == 'active')
                  {
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userType'] = $row['user_type'];
                    if($_SESSION['userId'] == 1 || $_SESSION['userType'] == 'admin')
                      {
                        header("Location: ../config.php?login=success&userID=".$row['user_id']."&userType=admin");
                      }
                    else
                      {
                        header("Location: ../user_page.php?login=success&userID=".$row['user_id']."&userType=user");
                      }
                    exit();
                  }
                else
                  {
                    header("Location: ../login_page.php?error=accountDeactivated");
                  }
              }
            else
              {
                header("Location: ../login_page.php?error=noUser");
                exit();
              }
          }
      }
  }
else
  {
    header("Location: ../login_page.php");
  }


 ?>
