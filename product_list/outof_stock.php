<?php
include("header.php");
include("dbcon.php");
?>
<div class="box1">
    <h2>Out of stock products</h2>


    <button class="btn btn-primary" style="margin-right: 5px;" onclick="location.href='in_stock.php'">
        In stock
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
        $query = "SELECT * FROM `product_table` WHERE `Quantity` = 0";
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
                echo "<td>" . "out of stock" . "</td>";
                echo '<td><a href="View_page.php?id=' . $row['Product_ID'] . '" class="btn btn-primary">View Detail</a></td>';
                echo '<td><a href="Delete_page.php?id=' . $row['Product_ID'] . '" class="btn btn-danger">Delete</a></td>';
                echo '<td><a href="Update_page.php?id=' . $row['Product_ID'] . '" class="btn btn-success">Update</a></td>';

                echo "</tr>";

                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

<?php include("footer.php"); ?>