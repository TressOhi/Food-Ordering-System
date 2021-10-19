<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once './config/conn.php';

  $top_picks_sql = "SELECT * FROM menu ORDER BY id DESC LIMIT 10";
  $top_picks_req = mysqli_query($connection, $top_picks_sql);

  $featured_sql = "SELECT * FROM menu WHERE featured = 1 ORDER BY id DESC LIMIT 10";
  $featured_req = mysqli_query($connection, $featured_sql);

  if(isset($_POST['fav_menu_id'])){
    if(isset($_SESSION['user'])){
      $check_sql = "SELECT id FROM favorites WHERE menu_id = '$_POST[fav_menu_id]' AND user_id = '$_SESSION[user]'"; 
      $check_req = mysqli_query($connection, $check_sql);
      if(mysqli_num_rows($check_req) < 1){
        $add_fav_sql = "INSERT INTO favorites (menu_id, user_id) VALUES ('$_POST[fav_menu_id]', '$_SESSION[user]')";
        $add_fav_req = mysqli_query($connection, $add_fav_sql);
        header("location: favorites.php");
      }
    } 
    else{
      header("location: set-user.php");
    }
  }

  if(isset($_POST['cart_menu_id'])){
    if(isset($_SESSION['user'])){
      $check_sql = "SELECT * FROM meal_order WHERE menu_id = '$_POST[cart_menu_id]' AND customer_id = '$_SESSION[user]'"; 
      $check_req = mysqli_query($connection, $check_sql);
      if(mysqli_num_rows($check_req) < 1){
        $add_fav_sql = "INSERT INTO meal_order (menu_id, customer_id, location) VALUES ('$_POST[cart_menu_id]', '$_SESSION[user]', '$_SESSION[user_location]')";
        $add_fav_req = mysqli_query($connection, $add_fav_sql);
        header("location: index.php");
      }
    } 
    else{
      header("location: set-user.php");
    }
  }
?>
<div class="main-content">
  <div class="banner">
    <h1>Enjoy soulfully spiced Chicken meals</h1>
  </div>

  <?php
    if(mysqli_num_rows($featured_req) > 0){
  ?>
    <div class="featured-meals-section">
      <h3 class="section-header">Featured Meals</h3>
      <div class="meals-container">
      <?php
          while($featured_res = mysqli_fetch_assoc($featured_req)){
        ?>
          <div class="meal">
            <img src="<?php echo './admin/'.$featured_res['image']?>" alt="" />
            <div class="meal-details">
              <small><?php echo $featured_res['name'] ?></small>
              <div class="price-info">
                <h4><?php echo $featured_res['price'] ?></h4>
                <form method="post">
                  <button name="fav_menu_id" value="<?php echo $featured_res['id']?>">
                    <i class="far fa-heart"></i>
                  </button>
                  <button name="cart_menu_id" value="<?php echo $featured_res['id']?>">
                    <i class="fas fa-plus"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
    </div>
  <?php
    }
  ?>

  <?php
    if(mysqli_num_rows($top_picks_req) > 0){
  ?>
    <div class="top-picks-section">
      <h3 class="section-header">Top Picks</h3>
      <div class="meals-container">
        <?php
          while($top_picks_res = mysqli_fetch_assoc($top_picks_req)){
        ?>
          <div class="meal">
            <img src="<?php echo './admin/'.$top_picks_res['image']?>" alt="" />
            <div class="meal-details">
              <small><?php echo $top_picks_res['name'] ?></small>
              <div class="price-info">
                <h4><?php echo $top_picks_res['price'] ?></h4>
                <form method="post">
                  <button name="fav_menu_id" value="<?php echo $top_picks_res['id']?>">
                    <i class="far fa-heart"></i>
                  </button>
                  <button name="cart_menu_id" value="<?php echo $top_picks_res['id']?>">
                    <i class="fas fa-plus"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
    </div>
  <?php
    }
  ?>
</div>

<?php include "./inc/footer.php"; ?>
