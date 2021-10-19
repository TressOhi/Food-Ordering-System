<?php
  session_start();
  require_once './config/conn.php';

  if(isset($_GET) & !empty($_GET)){
		$id = $_GET['id'];
    $sql = "DELETE FROM meal_order WHERE mo_id='$id'";
    
		if(mysqli_query($connection, $sql)){
      $smsg = "Meal removed";
      header('location: cart.php?smsg='.$smsg);
		}
	} else{
    $fmsg = "Failed to Remove Meal";
    header('location: cart.php?fmsg'.$fmsg);
	}
?>