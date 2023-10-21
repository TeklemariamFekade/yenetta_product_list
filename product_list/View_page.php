<?php include("header.php"); ?>
<?php include("dbcon.php"); ?>
<?php
// Retrieve the product ID from the URL parameter
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Perform your database query to fetch the product details based on the ID
    $query = "SELECT * FROM `product_table` WHERE `Product_ID` = '$productID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        // Fetch the product details
        $row = mysqli_fetch_assoc($result);

        // Display the product details
        echo "<h1>Product Details:</h1>";
        echo "<p><strong>Product ID:</strong> " . $row['Product_ID'] . "</p>";
        echo "<p><strong>Product Name:</strong> " . $row['Product_Name'] . "</p>";
        echo "<p><strong>Quantity:</strong> " . $row['Quantity'] . "</p>";
        echo "<p><strong>Price:</strong> " . $row['Price'] . "</p>";
        echo "<p><strong>Description:</strong> " . $row['Description'] . "</p>";

        // Add the "Order" button and quantity input field
        echo '<form action="" method="post">';
        echo '<label for="quantity" >Quantity:</label>';
        echo '<input type="number" id="quantity" name="quantity" min="1" max="' . $row['Quantity'] . '" required style = "margin-right:15px;" </br>';
        echo '<input type="submit" name="order" value="Order" class="btn btn-success">';
        echo '</form>';

        // Process the order
        if (isset($_POST['order'])) {
            $quantityOrdered = $_POST['quantity'];

            if ($quantityOrdered <= $row['Quantity']) {
                // Update the stock quantity
                $newQuantity = $row['Quantity'] - $quantityOrdered;
                $updateQuery = "UPDATE `product_table` SET `Quantity` = '$newQuantity' WHERE `Product_ID` = '$productID'";
                $updateResult = mysqli_query($connection, $updateQuery);

                if ($updateResult) {
                    echo "Order placed successfully. Stock updated.";
                } else {
                    echo "Failed to update stock.";
                }
            } else {
                echo "Not enough stock available.";
            }
        }
    }
} else {
    echo "Product ID not provided.";
}

echo '<td><a href="index.php" class="btn btn-primary">Back</a></td>';
?>
<?php include("footer.php"); ?>