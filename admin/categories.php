<?php
  session_start();
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';

  $sql = "SELECT * FROM menu_category";
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
    <h2>All Categories</h2>
    <a href="add-category.php">
      <button class="button">Add Category</button>
    </a>
  </div>

  <div class="list-container">
    <table>
      <tr>
        <th>S/N</th>
        <th>Category</th>
        <th>Actions</th>
      </tr>
      <?php
        $i=0;
        while($res = mysqli_fetch_assoc($req)){
          echo 
            "<tr>
              <td>" . $i = $i+1 . "</td>
              <td>" . $res['name'] . "</td>
              <td class='table-action'>
                <a href='edit-category.php?id={$res['id']}'>Edit</a> 
                | 
                <a href='delete-category.php?id={$res['id']}'>Delete</a>
              </td>
            </tr>";
        }
      ?>
    </table>
  </div>
</div>

<?php include "./inc/footer.php"; ?>