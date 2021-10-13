<?php
  include "./inc/head.php";
  include "./inc/nav.php";
?>

<div class="main-content">
  <div class="analytics-container">
    <div class="analytics-box">
      <small>Meals Ordered</small>
      <h1>20</h1>
    </div>
    <div class="analytics-box">
      <small>Processed Orders</small>
      <h1>48</h1>
    </div>
    <div class="analytics-box">
      <small>Unprocessed Orders</small>
      <h1>04</h1>
    </div>
    <div class="analytics-box">
      <small>Meals Available</small>
      <h1>19</h1>
    </div>
  </div>
  <div class="list-container">
    <h3>Meal Orders</h3>
    <table>
      <tr>
        <th>S/N</th>
        <th>Meal</th>
        <th>Price</th>
        <th>Order Info</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Chicken bucket</td>
        <td>10,000</td>
        <td>20/12/2021</td>
        <td><button>Delivered</button></td>
      </tr>
      <tr>
        <td>2</td>
        <td>Rice and Chicken</td>
        <td>5,000</td>
        <td>20/12/2021</td>
        <td><button>Delivered</button></td>
      </tr>
      <tr>
        <td>3</td>
        <td>Ice Cream</td>
        <td>2,000</td>
        <td>20/12/2021</td>
        <td><button>Delivered</button></td>
      </tr>
      <tr>
        <td>4</td>
        <td>Chicken bucket</td>
        <td>10,000</td>
        <td>20/12/2021</td>
        <td><button>Delivered</button></td>
      </tr>
    </table>
  </div>
</div>

<?php include "./inc/footer.php"; ?>
