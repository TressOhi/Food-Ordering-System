<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';

  $ful_sql = "SELECT * FROM order_details LEFT JOIN meal_order ON order_details.meal_order_id = meal_order.mo_id LEFT JOIN menu ON order_details.menu_id = menu.id WHERE order_details.fulfilled=1";
  $ful_req = mysqli_query($connection, $ful_sql);
?>
<div class="main-content">
  <div class="content-heading">
    <h2>Fulfilled Orders</h2>
  </div>

  <div class="list-container">
    <table>
      <tr>
        <th>S/N</th>
        <th>Meal</th>
        <th>Price</th>
        <th>Date</th>
      </tr>
      <?php
        $i=0;
        while($ful_res = mysqli_fetch_assoc($ful_req)){
      ?>
        <tr>
          <td><?php echo $i = $i+1 ?></td>
          <td><?php echo $ful_res['name']?></td>
          <td><?php echo $ful_res['t_price']?></td>
          <td><?php echo $ful_res['od_created_at'] ?></td>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
</div>

<?php include "./inc/footer.php"; ?>