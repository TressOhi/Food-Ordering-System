<?php
	session_start();
  require_once './config/conn.php';

	if(isset($_GET) & !empty($_GET)){
		$id = $_GET['id'];
    $sql = "DELETE FROM favorites WHERE f_id='$id'";
    
		if(mysqli_query($connection, $sql)){
      $smsg = "Favorite removed";
      header('location: favorites.php?smsg='.$smsg);
		}
	} else{
    $fmsg = "Failed to Remove Favorite";
    header('location: favorites.php?fmsg'.$fmsg);
	}
?>