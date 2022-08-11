
<?php
  include 'include/db.php';
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE-edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

    <title>User Management</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <?php
      if(isset($_SESSION['userType']) || isset($_SESSION['userId']))
        {
          echo '<div class = "list">
            <form method = "post">
              <div class = "form">
              <div class = "header">
              <h1>List of users</h1><br>
                <h2>You are logged in!</h2><hr>';
                if($_SESSION['userId'] == 1 && $_SESSION['userType'] == 'admin'){echo '<a href = "register_page.php?userType=admin" class = "add-admin" id = "consistent">+ Add Admin</a>';}
                echo '<a href = "register_page.php?userType=user" class = "add-user" id = "consistent">+ Add User</a>
                <a href = "include/logout.php?logout=success" class = "logout" id = "consistent">Log out</a>
                </div>
                <table id = "table" class="container">
                  <thead>
                    <tr>
                      <th scope="col">User ID</th>
                      <th scope="col">Username</th>
                      <th scope="col">Full name</th>
                      <th scope="col">Date Created</th>
                      <th scope="col">Date Modified</th>
                      <th scope="col">Position</th>
                      <th scope="col">Status</th>
                      <th scope="col">Control</th>
                    </tr>
                  </thead>
                  <form method = "post" class = "search">
                    <i class = "fas fa-search search-btn" aria-hidden = "true"></i>
                    <input type = "text" name = "search-bar" placeholder = "Search"></input>
                  </form>
                  <tbody>';
                  if(!isset($_POST['search-bar']) || $_POST['search-bar'] == null){
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($con, $sql);
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['user_id'];
                        $username = $row['username'];
                        $email = $row['user_email'];
                        $fname = $row['user_fname'];
                        $lname = $row['user_lname'];
                        $mname = $row['user_mname'];
                        $address = $row['user_add'];
                        $company = $row['user_company'];
                        $contact = $row['user_contact'];
                        $position = $row['user_position'];
                        $status = $row['user_status'];
                        $reg_date = $row['registration_date'];
                        $mod_date = $row['modified_date'];

                        echo '<tr>
                                  <th scope = "row">'.$id.'</th>
                                  <td>'.$username.'</td>
                                  <td>'.$fname." ".$mname." ".$lname.'</td>
                                  <td>'.$reg_date.'</td>
                                  <td>'.$mod_date.'</td>
                                  <td>'.$position.'</td>
                                  <td>';
                                    if($status == "active"){echo '<a class = "status" id = "active" href = "include/status.php?userID='.$id.'&status=deactive">Active</a>';}
                                    else{echo '<a class = "status" id = "deactivate" href = "include/status.php?userID='.$id.'&status=active">Activate</a>';}
                                    echo
                                    '
                                  </td>
                                  <td>
                                  <a href = "edit_page.php?editID='.$id.'" id = "btn" class = "fas fa-pencil-alt btn-edit"></a>
                                  <a href = "admin_view_page.php?viewID='.$id.'" id = "btn" class = "fas fa-id-card btn-view"></a>
                                  <a href = "include/delete.php?deletedID='.$id.'" id = "btn" class = "fas fa-trash-alt btn-delete"></a>
                              </tr>

                              ';

                      }

                    }
                  echo '
                  </tbody>
                </table>
              </div>
            </form>
          </div>';
        }
        else{

              $tosearch = $_POST['search-bar'];
              $sql = "SELECT * FROM users WHERE user_id = ? OR username = ? OR
                       user_email = ? OR user_pwd = ? OR user_fname = ? OR
                       user_lname = ? OR user_mname = ? OR user_add = ? OR
                       user_company = ? OR user_contact = ? OR user_position = ? OR
                       user_status = ?;";
              $stmt = mysqli_stmt_init($con);
              mysqli_stmt_prepare($stmt, $sql);
              mysqli_stmt_bind_param($stmt, "ssssssssssss", $tosearch, $tosearch, $tosearch,
                       $tosearch, $tosearch, $tosearch, $tosearch, $tosearch, $tosearch,
                       $tosearch, $tosearch, $tosearch);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              $resultCheck = mysqli_stmt_num_rows($stmt);
              if($resultCheck < 0){echo '<tr><td colspan = "10">No results found!</td></tr>';}
              else{
                while($row = mysqli_fetch_assoc($result)){
                  $id = $row['user_id'];
                  $username = $row['username'];
                  $email = $row['user_email'];
                  $fname = $row['user_fname'];
                  $lname = $row['user_lname'];
                  $mname = $row['user_mname'];
                  $address = $row['user_add'];
                  $company = $row['user_company'];
                  $contact = $row['user_contact'];
                  $position = $row['user_position'];
                  $status = $row['user_status'];
                  $reg_date = $row['registration_date'];
                  $mod_date = $row['modified_date'];

                  echo '<tr>
                            <th scope = "row">'.$id.'</th>
                            <td>'.$username.'</td>
                            <td>'.$fname." ".$mname." ".$lname.'</td>
                            <td>'.$reg_date.'</td>
                            <td>'.$mod_date.'</td>
                            <td>'.$position.'</td>
                            <td>';
                            if($_SESSION['userId'] == $id || $_SESSION['userType'] == "admin")
                                {
                                  if($status == "active"){echo '<a class = "status" id = "active" href = "include/status.php?userID='.$id.'&status=deactive">Active</a>';}
                                  else{echo '<a class = "status" id = "deactivate" href = "include/status.php?userID='.$id.'&status=active">Activate</a>';}
                              echo
                              '
                            </td>
                            <td>
                            <a href = "edit_page.php?editID='.$id.'" id = "btn" class = "fas fa-pencil-alt btn-edit"></a>
                            <a href = "admin_view_page.php?viewID='.$id.'" id = "btn" class = "fas fa-id-card btn-view"></a>
                            <a href = "include/delete.php?deletedID='.$id.'" id = "btn" class = "fas fa-trash-alt btn-delete"></a>
                        </tr>

                        ';}
                                else
                                {
                                  echo ''.$status.'</td><td></td></tr>';
                                }
              }
            }
        }
      }
      else
        {
          echo '<div class = "form-container">
            <form action = "login_page.php" method = "post">
            <div class = "form">
              <h1>Not logged in yet!</h1><br>
                <h2>Please log in first!</h2><hr>
                <input type = "submit" name = "submit" value = "Log In" id = "consistent">
              </div>
            </form>
          </div>';

        }
        ?>
  </body>
</html>
