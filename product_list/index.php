<?php
include("header.php");
include("dbcon.php");
?>

<div class="box1">
  <h2>All Products</h2>


  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Product
  </button>
  <button class="btn btn-primary" style="margin-right: 5px;" onclick="location.href='in_stock.php'">
    In Stock
  </button>
  <button class="btn btn-primary" style="margin-right: 5px;" onclick="location.href='outof_stock.php'">
    out of stock
  </button>
  <button class="btn btn-primary" style="margin-right: 5px;" onclick="location.href='index.php'">
    All Products
  </button>

</div>

<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>

      <th>Product Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Availablity</th>
      <th>View Detail</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM `product_table`";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Query failed: " . mysqli_error($connection));
    } else {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";

        echo "<td>" . $row['Product_Name'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        $description = $row['Description'];
        $limitedDescription = strlen($description) > 12 ? substr($description, 0, 12) . "..." : $description;
        echo "<td>" . $limitedDescription . "</td>";

        echo "<td>";
        if ($row['Quantity'] > 0) {
          echo '  in stock';
        } else {
          echo ' out of stock';
        }
        echo "</td>";

        echo '<td><a href="View_page.php?id=' . $row['Product_ID'] . '" class="btn btn-primary">View Detail</a></td>';
        echo '<td><a href="Delete_page.php?id=' . $row['Product_ID'] . '" class="btn btn-danger">Delete</a></td>';
        echo '<td><a href="Update_page.php?id=' . $row['Product_ID'] . '" class="btn btn-success">Update</a></td>';

        echo "</tr>";
      }
    }
    ?>
  </tbody>
</table>


<?php
if (isset($_GET['message'])) {
  echo "<h6>" . $_GET['message'] . "</h6>";
}

if (isset($_GET['insert_msg'])) {
  echo "<h6>" . $_GET['insert_msg'] . "</h6>";
}

if (isset($_GET['update_msg'])) {
  echo "<h6>" . $_GET['update_msg'] . "</h6>";
}

if (isset($_GET['delete_msg'])) {
  echo "<h6>" . $_GET['delete_msg'] . "</h6>";
}
?>

<form action="insert_data.php" method="post">
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" name="p_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Quantity</label>
            <input type="number" name="quantity" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Price</label>
            <input type="text" name="price" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="add_products" value="Add">
        </div>
      </div>
    </div>
  </div>
</form>

<?php include("footer.php"); ?>