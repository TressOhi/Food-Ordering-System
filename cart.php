<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once './config/conn.php';

  $cart_sql = "SELECT * FROM meal_order LEFT JOIN menu ON meal_order.menu_id = menu.id WHERE meal_order.customer_id='$_SESSION[user]' AND meal_order.checked_out=0 " ;
  $cart_req = mysqli_query($connection, $cart_sql);

  if (isset($_POST) && !empty($_POST) && isset($_POST['submit_btn'])) {
    $total_price = 0;

    while($cart_res = mysqli_fetch_assoc($cart_req)){
      $p_sub = 'qty'.$cart_res['mo_id'];

      $update_sql1 = "UPDATE meal_order SET checked_out = 1 WHERE mo_id='$cart_res[mo_id]'";
      $update_req1 = mysqli_query($connection, $update_sql1);
      
      $price = str_replace(',', '', $cart_res['price']); 
      $t_price = $price * $_POST[$p_sub];
      $total_price += $t_price;
      $n_stock = $cart_res['stock'] - $_POST[$p_sub];

      $update_sql2 = "UPDATE menu SET stock = '$n_stock' WHERE id='$cart_res[id]'";
      $update_req2 = mysqli_query($connection, $update_sql2);

      $create_sql = "INSERT INTO order_details (meal_order_id, menu_id, qty, t_price) VALUES ('$cart_res[mo_id]', '$cart_res[id]', '$_POST[$p_sub]', '$t_price')";
      $create_req = mysqli_query($connection, $create_sql);
    }
    
    if ($update_req1 && $update_req2 && $create_req && $total_price != 0) {
      $smsg = "You have successfully paid in the sum of".$total_price ;
    } else {
      $fmsg = "Failed to process transaction";
    }
  }
?>
<div class="main-content">
  <?php 
    if (isset($_GET['fmsg'])) { ?>
      <div class="alert alert-danger"> <?php echo $_GET['fmsg']; ?> </div>
  <?php } ?>
  <?php 
    if (isset($_GET['smsg'])) { ?>
      <div class="alert alert-success"> <?php echo $_GET['smsg']; ?> </div>
  <?php } ?>

  <?php 
    if (isset($fmsg)) { ?>
      <div class="alert alert-danger"> <?php echo $fmsg; ?> </div>
  <?php } ?>
  <?php 
    if (isset($smsg)) { ?>
      <div class="alert alert-success"> <?php echo $smsg; ?> </div>
  <?php } ?>

  <div class="content-heading">
    <h2>Cart</h2>
  </div>
  <form method="post" class="cart-items-container">
      <?php
        while($cart_res = mysqli_fetch_assoc($cart_req)){
      ?>
        <div class="cart-item">
          <div class="item-image">
            <img src="<?php echo './admin/'.$cart_res['image']?>" alt="">
          </div>
          <div class="item-description">
            <h3><?php echo $cart_res['name']?></h3>
            <small><?php echo $cart_res['description']?></small>
            <p><b>N <?php echo $cart_res['price']?></b></p>
            <div class="item-update">
              <input type="number" name="<?php echo 'qty'.$cart_res['mo_id']?>" value="1" class="input-field">
              <a href="remove-from-cart.php?id=<?php echo $cart_res['mo_id']?>">
                <button type="button" class="button">Remove</button>
              </a>
            </div>
          </div>
        </div>
      <?php 
        }
      ?>
      <?php 
        if(mysqli_num_rows($cart_req) > 0 && !isset($smsg)){
      ?>
        <div class="pay-btn-container">
          <input type="submit" name="submit_btn" value="Sum & Pay" class="button">
        </div>
      <?php
        }
      ?>
  </form>

</div>

<?php include "./inc/footer.php"; ?>