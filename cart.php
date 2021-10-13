<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once './config/conn.php';

  $cart_sql = "SELECT * FROM favorites LEFT JOIN menu ON favorites.menu_id = menu.id";
  $cart_req = mysqli_query($connection, $cart_sql);
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

  <div class="content-heading">
    <h2>Cart</h2>
  </div>
  <div class="cart-items-container">
    <div class="cart-item">
      <div class="item-image">
        <img src="./assets/ChickenRepublic_HomePageBanner.jpg" alt="">
      </div>
      <div class="item-description">
        <h3>Chicken Sharwama</h3>
        <small>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, eius explicab</small>
        <p><b>N 2,500</b></p>
        <div class="item-update">
          <input type="number" value="1" class="input-field">
          <button class="button">Remove</button>
        </div>
      </div>
    </div>
  </div>

</div>

<?php include "./inc/footer.php"; ?>