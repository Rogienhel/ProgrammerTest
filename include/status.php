<?php
  include_once 'db.php';
  session_start();

  if(isset($_GET['userID'])){
    $id = $_GET['userID'];
    $status = $_GET['status'];
    $sql = "UPDATE users SET user_status = '$status' WHERE user_id = '$id';";
    $result = mysqli_query($con, $sql);
    if($id == $_SESSION['userId']){
      header("Location: logout.php");
      exit();
    }
    elseif($result){
      header("Location: ../config.php?status=updated");
    }
  }
