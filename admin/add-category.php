<?php
  session_start();

  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';
  
  if (isset($_POST) && !empty($_POST) && isset($_POST['submit_btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $sql = "INSERT INTO menu_category (name, description) VALUES ('$name', '$description')";
    $res = mysqli_query($connection, $sql);
    
    if ($res) {
      $smsg = "Category Added";
    } else {
      $fmsg = "Failed Add Category";
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
      <h2>Category Creation</h2>
      <small>Fill in details of the new category below</small>
    </div>
    <div class="form-body">
      <div class="input-container">
        <label>Name</label>
        <input type="text" name="category_name" class="input-field" />
      </div>
      <div class="input-container">
        <label>Description</label>
        <textarea
          name="description"
          id=""
          cols="30"
          rows="5"
          class="input-field"
        ></textarea>
      </div>
    </div>
    <div class="form-footer">
      <input type="submit" name="submit_btn" class="button" />
    </div>
    </form>
</div>

<?php include "./inc/footer.php"; ?>
