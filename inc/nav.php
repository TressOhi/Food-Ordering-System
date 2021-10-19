<?php 
  session_start();
  require_once './config/conn.php';

  $cart_sql = "SELECT * FROM meal_order WHERE customer_id='$_SESSION[user]' AND checked_out=0 " ;
  $cart_req = mysqli_query($connection, $cart_sql);

  $fav_sql = "SELECT * FROM favorites WHERE user_id='$_SESSION[user]'";
  $fav_req = mysqli_query($connection, $fav_sql);
?>
<div class="sidebar">
  <div class="sidebar-header">
    <img src="./assets/ChickenRepublic_HeaderLogo.jpg" alt="" />
    <h3>Chicken Republic</h3>
  </div>
  <div class="nav-items-container">
    <a href="index.php" class="nav-item">
      <i class="fas fa-igloo"></i>
      <span>Home</span>
    </a>
    <a href="meals.php" class="nav-item">
      <i class="fas fa-hamburger"></i>
      <span>Menu</span>
    </a>
    <a href="favorites.php" class="nav-item">
      <i class="fas fa-clipboard-list"></i>
      <span>Favorites</span>
      <span class="count"><?php echo mysqli_num_rows($fav_req)?></span>
    </a>
    <a href="cart.php" class="nav-item">
      <i class="fas fa-shopping-cart"></i>
      <span>Cart</span> 
      <span class="count"><?php echo mysqli_num_rows($cart_req)?></span>
    </a>
    <a href="set-user.php" class="nav-item">
      <i class="fas fa-user"></i>
      <span>Switch User</span>
    </a>
  </div>
</div>
<div class="body-content">
  <div class="searchbar-container">
    <div class="searchbar">
      <input type="text" placeholder="Search" />
    </div>
    <button class="button">Search</button>
  </div>