
<?php
  include_once 'db.php';

  $id = $_GET['editID'];
  if(isset($_POST['submit']))
  {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $re_type = mysqli_real_escape_string($con, $_POST["re-type"]);
    $fname = mysqli_real_escape_string($con, $_POST["fname"]);
    $lname = mysqli_real_escape_string($con, $_POST["lname"]);
    $mname = mysqli_real_escape_string($con, $_POST["mname"]);
    $home_add = mysqli_real_escape_string($con, $_POST["home_add"]);
    $company = mysqli_real_escape_string($con, $_POST["company"]);
    $contact_num = $_POST["contact_num"];
    $position = mysqli_real_escape_string($con, $_POST["position"]);
    $user_status = $_POST['user_status'];
    $mod_date = date('m-d-Y');
    $user_type = $_POST['user_type'];


  if(empty($email) || empty($password) || empty($re_type) ||
   empty($fname) || empty($lname) || empty($mname) || empty($home_add) ||
   empty($company) || empty($contact_num) || empty($position) || empty($user_status))
   {
     header("Location: ../edit_page.php?error=emptyfields&username=".$username."&email=".$email.
            "&fname=".$fname."&lname=".$lname."&mname=".$mname."&home_add=".$home_add."&company="
            .$company."&contact_num=".$contact_num."&position=".$position."&user_status=".$user_status);
     exit();
   }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
      header("Location: ../edit_page.php?error=invalidemail");
      exit();
  }
  elseif ($password != $re_type)
  {
    header("Location: ../edit_page.php?error=password#do#not#match&username=".$username);
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9\#\,\s]*$/", $home_add))
  {
    header("Location: ../register_page.php?error=invalidAddress=".$home_add);
  }
  elseif (!preg_match("/^[a-zA-Z0-9\s]*$/", $fname))
  {
    header("Location: ../register_page.php?error=invalidFirstname");
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9\s]*$/", $mname))
  {
    header("Location: ../register_page.php?error=invalidMiddlename");
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9\s\.]*$/", $lname))
  {
    header("Location: ../register_page.php?error=invalidLastname");
    exit();
  }
  else
  {
    $sql = "SELECT username FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
      header("Location: ../edit_page.php?error=sqlerror");
      exit();
    }
    else
    {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0)
      {
        header("Location: ../edit_page.php?error=usernametaken&email=".$email.
              "&fname=".$fname."&lname=".$lname."&mname=".$mname."&home_add="
              .$home_add."&company=".$company."&contact_num=".$contact_num.
               "&position=".$position."&user_status=".$user_status);
        exit();
      }
      else
      {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET username = '$username', user_email = '$email',
                user_pwd = '$hash_password', user_fname = '$fname', user_lname = '$lname',
                user_mname = '$mname', user_add = '$home_add', user_company = '$company',
                user_contact = '$contact_num', user_position = '$position', user_status = '$user_status',
                modified_date = '$mod_date', user_type = '$user_type'
                WHERE user_id = '$id';";
        mysqli_query($con, $sql);

        header("Location: ../config.php?edit=success");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($con);

  }

  else
  {
    header("Location: ../config.php");
  }

  ?>
