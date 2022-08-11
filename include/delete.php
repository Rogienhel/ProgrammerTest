
<?php
  include_once 'db.php';


  if(isset($_GET['deletedID'])){
    $todelete = $_GET['deletedID'];
    $sql = "DELETE FROM users WHERE user_id = $todelete;";
    $result = mysqli_query($con, $sql);
    if($result){
      header('Location: ../config.php?id='.$todelete.'#deletedsuccessfully');
    }
  }
