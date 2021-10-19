<?php
	session_start();
  require_once '../config/conn.php';

	if(isset($_GET) & !empty($_GET)){
		$id = $_GET['id'];
    $sql = "UPDATE order_details SET fulfilled = 1 WHERE od_id='$id'";
    
		if(mysqli_query($connection, $sql)){
      $smsg = "Saved";
      header('location: index.php?smsg='.$smsg);
		}
	} else{
    $fmsg = "Failed to Save";
    header('location: index.php?fmsg'.$fmsg);
	}
?>