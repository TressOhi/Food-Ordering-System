<?php
	session_start();
  require_once '../config/conn.php';

	if(isset($_GET) & !empty($_GET)){
		$id = $_GET['id'];
    $sql = "DELETE FROM menu_category WHERE id='$id'";
    
		if(mysqli_query($connection, $sql)){
      $smsg = "Category Deleted";
      header('location: categories.php?smsg='.$smsg);
		}
	} else{
    $fmsg = "Failed to Delete Category";
    header('location: categories.php?fmsg'.$fmsg);
	}
?>