<?php
  include "./inc/head.php";
  include "./inc/nav.php";
  require_once '../config/conn.php';

  $sql = "SELECT * FROM menu_category";
  $req = mysqli_query($connection, $sql);

  if (isset($_POST) && !empty($_POST) && isset($_POST['submit_btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $stock = mysqli_real_escape_string($connection, $_POST['stock']);
    $category = $_POST['category'];
    $featured = $_POST['featured'];

    if (isset($_FILES['image'])) {
      $filename = $_FILES['image']['name'];
      $size = $_FILES['image']['size'];
      $type = $_FILES['image']['type'];
      $tmp_name = $_FILES['image']['tmp_name'];
  
      $max_size = 10000000;
      $extension = substr($filename, strpos($filename, '.') + 1);
  
      if (isset($filename) & !empty($filename)) {
    
        if (($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size <= $max_size) {
          $location = "uploads/";
          if (move_uploaded_file($tmp_name, $location.$filename)) {
            $create_sql = "INSERT INTO menu (menu_category_id, name, description, stock,	price, image, featured) VALUES ('$category', '$name', '$description','$stock','$price','$location$filename', '$featured')";
            $create_res = mysqli_query($connection, $create_sql);

            if ($create_res) {
              $smsg="Meal Created";
              header('location: products.php?smsg='.$smsg);
            } else {
              $fmsg = "Failed to Create Meal";
            }
          } else {
            $fmsg = "Failed to upload";
          }
        } else {
          $fmsg = "Only JPG files are allowed and should be less than 1MB";
        }
      } else {
        $fmsg = "Please select a file";
      }
    } else {
        $create_sql = "INSERT INTO menu (menu_category_id, name, description, stock,	price, featured) VALUES ('$category', '$name', '$description','$stock','$price', '$featured')";
        $create_res = mysqli_query($connection, $create_sql);

        if ($create_res) {
          header('location: products.php?smsg='.$smsg);
        } else {
          $fmsg = "Failed to Create Meal";
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
      <h2>Meal Creation</h2>
      <small>Fill in details of the new meal below</small>
    </div>
    <div class="form-body">
      <div class="input-container">
        <label>Name</label>
        <input type="text" name="name" class="input-field" />
      </div>
      <div class="input-container">
        <label>Description</label>
        <textarea name="description" id="" cols="30" rows="5" class="input-field"></textarea>
      </div>
      <div class="input-container">
        <label>Price</label>
        <input type="text" name="price" class="input-field" />
      </div>
      <div class="input-container">
        <label>Stock</label>
        <input type="number" name="stock" class="input-field" />
      </div>
      <div class="input-container">
        <label>Category</label>
        <select name="category" id="" class="input-field">
          <option value="">Select Category</option>
          <?php
            while($res = mysqli_fetch_assoc($req)){
              echo "<option value='{$res['id']}'>{$res['name']}</option>";
            }
          ?>
        </select>
      </div>
      <div class="input-container">
        <label>Meal Image</label>
        <input type="file" name="image" class="input-field" />
      </div>
      <div class="input-container">
        <label class="">
          <input type="checkbox" name="featured" value="1"/>
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