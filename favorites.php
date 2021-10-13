<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once './config/conn.php';

  $fav_sql = "SELECT * FROM favorites LEFT JOIN menu ON favorites.menu_id = menu.id";
  $fav_req = mysqli_query($connection, $fav_sql);
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
    <h2>Your Faves.</h2>
  </div>

  <div class="list-container">
    <table>
      <tr>
        <th>S/N</th>
        <th>Meal</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
      <?php
        while($fav_res = mysqli_fetch_assoc($fav_req)){
      ?>
        <tr>
          <td><?php echo $fav_res['f_id']?></td>
          <td><?php echo $fav_res['name']?></td>
          <td><?php echo $fav_res['price']?></td>
          <td class="table-action">
            <a href="add-to-cart.php?cart_menu_id=<?php echo $fav_res['f_id']?>">Add to cart</a> 
            | 
            <a href="remove-favorite.php?id=<?php echo $fav_res['f_id']?>">Remove</a>
          </td>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
</div>

<?php include "./inc/footer.php"; ?>