<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';

  $menu_sql1 = "SELECT * FROM menu";
  $menu_req1 = mysqli_query($connection, $menu_sql1);
  
  $menu_sql2 = "SELECT * FROM order_details";
  $menu_req2 = mysqli_query($connection, $menu_sql2);
  
  $menu_sql3 = "SELECT * FROM order_details WHERE fulfilled = 1";
  $menu_req3 = mysqli_query($connection, $menu_sql3);

  $order_sql = "SELECT * FROM order_details LEFT JOIN meal_order ON order_details.meal_order_id = meal_order.mo_id LEFT JOIN menu ON order_details.menu_id = menu.id WHERE order_details.fulfilled=0" ;
  $order_req = mysqli_query($connection, $order_sql);
?>

<div class="main-content">
  <div class="analytics-container">
    <div class="analytics-box">
      <small>Meals Ordered</small>
      <h1><?php echo mysqli_num_rows($menu_req2)?></h1>
    </div>
    <div class="analytics-box">
      <small>Processed Orders</small>
      <h1><?php echo mysqli_num_rows($menu_req3)?></h1>
    </div>
    <div class="analytics-box">
      <small>Unprocessed Orders</small>
      <h1><?php echo mysqli_num_rows($order_req)?></h1>
    </div>
    <div class="analytics-box">
      <small>Meals Available</small>
      <h1><?php echo mysqli_num_rows($menu_req1)?></h1>
    </div>
  </div>

  <?php 
    if (isset($_GET['fmsg'])) { ?>
      <div class="alert alert-danger"> <?php echo $_GET['fmsg']; ?> </div>
  <?php } ?>
  <?php 
    if (isset($_GET['smsg'])) { ?>
      <div class="alert alert-success"> <?php echo $_GET['smsg']; ?> </div>
  <?php } ?>

  <div class="list-container" style="width: 90%;">
    <h3>Meal Orders</h3>
    <table>
      <tr>
        <th>S/N</th>
        <th>Meal</th>
        <th>Qty</th>
        <th style="width: 20%;">Location</th>
        <th>Order Info</th>
        <th>Action</th>
      </tr>
      <?php
        $i=0;
        while($order_res = mysqli_fetch_assoc($order_req)){
      ?>
        <tr>
          <td><?php echo $i = $i+1 ?></td>
          <td><?php echo $order_res['name'] ?></td>
          <td><?php echo $order_res['qty'] ?></td>
          <td class="location-cell"><?php echo $order_res['location'] ?></td>
          <td><?php echo $order_res['od_created_at'] ?></td>
          <td><a href="fulfil-order.php?id=<?php echo $order_res['od_id']?>"><button>Delivered</button></a></td>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
</div>

<?php include "./inc/footer.php"; ?>
