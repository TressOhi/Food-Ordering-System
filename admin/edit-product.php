<?php
include "./inc/head.php";
include "./inc/nav.php";
require_once '../config/conn.php';

if (isset($_GET) & !empty($_GET)) {
  $id = $_GET['id'];
} else {
  header('location: categories.php');
}

$created_sql = "SELECT * FROM menu WHERE id=$id";
$created_req = mysqli_query($connection, $created_sql);
$created_res = mysqli_fetch_assoc($created_req);

$sql = "SELECT * FROM menu_category";
$req = mysqli_query($connection, $sql);

if (isset($_POST) && !empty($_POST) && isset($_POST['submit_btn'])) {
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $description = mysqli_real_escape_string($connection, $_POST['description']);
  $price = mysqli_real_escape_string($connection, $_POST['price']);
  $stock = mysqli_real_escape_string($connection, $_POST['stock']);
  $category = $_POST['category'];
  $featured = $_POST['featured'];

  if (isset($_FILES['image']) && !empty($_FILES)) {
    $filename = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $max_size = 10000000;
    $extension = substr($filename, strpos($filename, '.') + 1);

    if (isset($filename) && !empty($filename)) {
      unlink($created_res['image']);

      if (($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size <= $max_size) {
        $location = "uploads/";
        if (move_uploaded_file($tmp_name, $location . $filename)) {
          $update_sql = "UPDATE menu SET menu_category_id = '$category', name = '$name', description = '$description', stock = '$stock',	price = '$price', image = '$location$filename', featured='$featured' WHERE id='$id'";
          $update_res = mysqli_query($connection, $update_sql);

          if ($update_res) {
            $smsg = "Meal Updated";
            header('location: products.php?smsg=' . $smsg);
          } else {
            $fmsg = "Failed to Update Meal";
          }
        } else {
          $fmsg = "Failed to upload";
        }
      } else {
        $fmsg = "Only JPG files are allowed and should be less than 1MB";
      }
    } else {
      $update_sql = "UPDATE menu SET menu_category_id = '$category', name = '$name', description = '$description', stock = '$stock',	price = '$price', featured='$featured' WHERE id='$id'";
      $update_res = mysqli_query($connection, $update_sql);

      if ($update_res) {
        $smsg = "Meal Updated";
        header('location: products.php?smsg=' . $smsg);
      } else {
        $fmsg = "Failed to Update Meal";
      }
      $fmsg = "Please select a file";
    }
  } else {
    $update_sql = "UPDATE menu SET menu_category_id = '$category', name = '$name', description = '$description', stock = '$stock',	price = '$price', featured='$featured' WHERE id='$id'";
    $update_res = mysqli_query($connection, $update_sql);

    if ($update_res) {
      $smsg = "Meal Updated";
      header('location: products.php?smsg=' . $smsg);
    } else {
      $fmsg = "Failed to Update Meal";
    }
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
  <form method="post" enctype="multipart/form-data" class="form-card">
    <div class="form-header">
      <h2>Edit Meal</h2>
      <small>Selecting a new image will automatically replace the former.</small>
    </div>
    <div class="form-body">
      <div class="input-container">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $created_res['name']; ?>" class="input-field" />
      </div>
      <div class="input-container">
        <label>Description</label>
        <textarea name="description" id="" cols="30" rows="5" class="input-field"><?php echo $created_res['description']; ?></textarea>
      </div>
      <div class="input-container">
        <label>Price</label>
        <input type="text" name="price" value="<?php echo $created_res['price']; ?>" class="input-field" />
      </div>
      <div class="input-container">
        <label>Stock</label>
        <input type="number" name="stock" value="<?php echo $created_res['stock']; ?>" class="input-field" />
      </div>
      <div class="input-container">
        <label>Category</label>
        <select name="category" value="4" id="" class="input-field">
          <option>Select Category</option>
          <?php
          while ($res = mysqli_fetch_assoc($req)) {
          ?>
            <option value="<?php echo $res['id']; ?>" <?php if ($created_res['menu_category_id'] ==  $res['id']) {
                                                        echo 'selected';
                                                      } ?>>
              <?php echo $res['name']; ?>
            </option>;
          <?php
          }
          ?>
        </select>
      </div>
      <div class="input-container">
        <label>Meal Image</label>
        <?php 
          if($created_res['image']){
        ?>
          <img src="<?php echo $created_res['image'] ?>" id="preview-thumbnail" style="width: 100px; height: 70px; object-fit: cover;" alt="">
        <?php
          }
        ?>
        <input onclick="document.getElementById('preview-thumbnail').style.display='none'" type="file" name="image" class="input-field" />
      </div>
      <div class="input-container">
        <label class="">
          <input type="checkbox" name="featured" value="1" <?php if($created_res['featured']==1) {echo "checked";} ?>/>
          <span>Featured Meal</span>
        </label>
      </div>
    </div>
    <div class="form-footer">
      <input type="submit" name="submit_btn" class="button" />
    </div>
  </form>
</div>

<?php include "./inc/footer.php"; ?>