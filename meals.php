<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once './config/conn.php';

  $category_sql = "SELECT * FROM menu_category";
  $category_req = mysqli_query($connection, $category_sql);
  
  if(isset($_POST) && !empty($_POST) && isset($_POST['filter_btn']) && $_POST['category'] != 0){
    $menu_sql = "SELECT * FROM menu WHERE menu_category_id = '$_POST[category]'";
    $menu_req = mysqli_query($connection, $menu_sql);
  } else{
    $menu_sql = "SELECT * FROM menu";
    $menu_req = mysqli_query($connection, $menu_sql);
  }

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
        header("location: meals.php");
      }
    } 
    else{
      header("location:set-user.php");
    }
  }

?>
<div class="main-content">
  <div class="filter-section">
    <h2>Find Something specific; Filter by Categories.</h2>
    <form method="post">
      <select name="category" id="">
        <option value="0">All Categories</option>
        <?php
            while($category_res = mysqli_fetch_assoc($category_req)){
              echo "<option value='{$category_res['id']}'>{$category_res['name']}</option>";
            }
          ?>
      </select>
      <br>
      <input type="submit" name="filter_btn" value="Filter" class="button">
    </form>
  </div>

  <div class="meals-container">
    <?php
      while($menu_res = mysqli_fetch_assoc($menu_req)){
    ?>
      <div class="meal">
        <img src="<?php echo './admin/'.$menu_res['image']?>" alt="" />
        <div class="meal-details">
          <small><?php echo $menu_res['name'] ?></small>
          <div class="price-info">
            <h4><?php echo $menu_res['price'] ?></h4>
            <form method="post">
              <button name="fav_menu_id" value="<?php echo $menu_res['id']?>">
                <i class="far fa-heart"></i>
              </button>
              <button name="cart_menu_id" value="<?php echo $menu_res['id']?>">
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

<?php include "./inc/footer.php"; ?>
