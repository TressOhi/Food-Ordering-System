<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';

  $sql = "SELECT * FROM menu";
  $req = mysqli_query($connection, $sql);
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
    <h2>All Meals</h2>
    <a href="add-product.php">
      <button class="button">Add Meal</button>
    </a>
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
        while($res = mysqli_fetch_assoc($req)){
          echo "
            <tr>
              <td>{$res['id']}</td>
              <td>{$res['name']}</td>
              <td>{$res['price']}</td>
              <td class='table-action'> 
                <a href='edit-product.php?id={$res['id']}'>Edit<a> 
                | 
                <a href='delete-product.php?id={$res['id']}'>Delete</a>
              </td>
            </tr>
          ";
        }
      ?>
    </table>
  </div>
</div>

<?php include "./inc/footer.php"; ?>
