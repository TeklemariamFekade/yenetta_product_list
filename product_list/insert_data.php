<?php

include("dbcon.php");
?>
<?php
if (isset($_POST['add_products'])) {
    echo "yes, you have been added successfully";

    $p_name = $_POST['p_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if ($p_name == "" || empty($p_name)) {
        header('location: index.php?message=You need to fill in the product name!');
    } else {
        $query = "INSERT INTO product_table (`Product_Name`, `Quantity`, `Price`, `Description`)
                  VALUES ('$p_name', '$quantity', '$price', '$description')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been successfully added');
        }
    }
}
