<?php
  session_start();
  require_once './config/conn.php';

  if(isset($_SESSION['user'])){
    $check_sql = "SELECT id FROM meal_order WHERE menu_id = '$_GET[cart_menu_id]' AND customer_id = '$_SESSION[user]'"; 
    $check_req = mysqli_query($connection, $check_sql);
    if(mysqli_num_rows($check_req) < 1){
      $add_fav_sql = "INSERT INTO meal_order (menu_id, customer_id, location) VALUES ('$_GET[cart_menu_id]', '$_SESSION[user]', '$_SESSION[location]')";
      $add_fav_req = mysqli_query($connection, $add_fav_sql);
    }
    header("location: cart.php");
  } 
  else{
    header("location: set-user.php");
  }
?>