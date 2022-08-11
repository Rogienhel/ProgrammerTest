<?php
  include_once 'db.php';

if(isset($_POST['submit']))
{
  $username = mysqli_real_escape_string($con, $_POST["username"]);
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
  if(isset($_GET['userType'])){$user_type = $_GET['userType'];}
  else{$user_type = 'user';}
  $reg_date = date('m-d-Y');
  $mod_date = "Not modified yet!";

if(empty($username) || empty($email) || empty($password) || empty($re_type) ||
 empty($fname) || empty($lname) || empty($mname) || empty($home_add) ||
 empty($company) || empty($contact_num) || empty($position) || empty($user_status))
 {
   header("Location: ../register_page.php?error=emptyfields&username=".$username."&email=".$email.
          "&fname=".$fname."&lname=".$lname."&mname=".$mname."&home_add=".$home_add."&company="
          .$company."&contact_num=".$contact_num."&position=".$position."&user_status=".$user_status);
   exit();
 }
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
{
  header("Location: ../register_page.php?error=invalidemail&username".$username);
    exit();
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
  header("Location: ../register_page.php?error=invalidemail");
  exit();
}
elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username))
{
  header("Location: ../register_page.php?error=invalidusername");
  exit();
}
elseif ($password != $re_type)
{
  header("Location: ../register_page.php?error=password#do#not#match&username=".$username);
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
  $sql = "SELECT username FROM users WHERE username = ? OR user_email = ?;";
  $stmt = mysqli_stmt_init($con);
  if(!mysqli_stmt_prepare($stmt, $sql))
  {
    header("Location: ../register_page.php?error=sqlerror");
    exit();
  }
  else
  {
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if($resultCheck > 0)
    {
      header("Location: ../register_page.php?error=inputTaken&email=".$email.
            "&fname=".$fname."&lname=".$lname."&mname=".$mname."&home_add="
            .$home_add."&company=".$company."&contact_num=".$contact_num.
             "&position=".$position."&user_status=".$user_status);
      exit();
    }
    else
    {
      $hash_password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users(username, user_email, user_pwd, user_fname, user_lname,
                user_mname, user_add,user_company, user_contact, user_position, user_status,
                registration_date, modified_date, user_type)
         VALUES('$username', '$email', '$hash_password', '$fname', '$lname', '$mname', '$home_add',
                '$company', '$contact_num', '$position', '$user_status', '$reg_date', '$mod_date', '$user_type');";
      mysqli_query($con, $sql);

      header("Location: ../admin_page.php?register=success");
      exit();
    }
  }
}
mysqli_stmt_close($stmt);
mysqli_close($con);

}

else
{
  header("Location: ../register_page.php");
}

?>
