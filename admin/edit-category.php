<?php
  session_start();

  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';

  if (isset($_GET) & !empty($_GET)) {
    $id = $_GET['id'];
  } else {
    header('location: categories.php');
  }
  

  $sql = "SELECT * FROM menu_category WHERE id=$id";
  $req = mysqli_query($connection, $sql);
  $res = mysqli_fetch_assoc($req);


  if (isset($_POST) && !empty($_POST) && isset($_POST['submit_btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $sql = "UPDATE menu_category SET name = '$name', description = '$description' WHERE id='$id'";

    $res = mysqli_query($connection, $sql);
    
    if ($res) {
      $smsg = "Category Updated";
      header('location: categories.php?smsg='.$smsg);
    } else {
      $fmsg = "Failed to Update Category";
    }
  }
?>

<div class="main-content">
  <?php 
    if (isset($fmsg)) { ?>
      <div class="alert alert-danger"> <?php echo $fmsg; ?> </div>
  <?php } ?>
  <?php 
    if (isset($smsg)) { ?>
      <div class="alert alert-success"> <?php echo $smsg; ?> </div>
  <?php } ?>
  <form method="post" class="form-card">
    <div class="form-header">
      <h2>Edit Category</h2>
      <small>Edit the existing category below</small>
    </div>
    <div class="form-body">
      <div class="input-container">
        <label>Name</label>
        <input type="text" name="category_name" value="<?php echo $res['name']; ?>" class="input-field" />
      </div>
      <div class="input-container">
        <label>Description</label>
        <textarea
          name="description"
          cols="30"
          rows="5"
          class="input-field"
        ><?php echo $res['description']; ?></textarea>
      </div>
    </div>
    <div class="form-footer">
      <input type="submit" name="submit_btn" class="button" />
    </div>
    </form>
</div>

<?php include "./inc/footer.php"; ?>
