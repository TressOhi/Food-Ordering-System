<?php
	session_start();
  require_once '../config/conn.php';

	if(isset($_GET) & !empty($_GET)){
    $id = $_GET['id'];
    
    $img_sql = "SELECT image FROM menu WHERE id=$id";
    $img_req = mysqli_query($connection, $img_sql);
    $img_res = mysqli_fetch_assoc($img_req);

    if(!empty($img_res['image'])){
      unlink($img_res['image']);
    }

    $sql = "DELETE FROM menu WHERE id='$id'";
    
		if(mysqli_query($connection, $sql)){
      $smsg = "Meal Deleted";
      header('location: products.php?smsg='.$smsg);
		}else{
      $fmsg = "Failed to Delete Meal";
      header('location: products.php?fmsg'.$fmsg);
    }
	} else{
    $fmsg = "Failed to Delete Meal";
    header('location: products.php?fmsg'.$fmsg);
	}
?>