<?php include("dbcon.php"); ?>
<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "delete from `product_table` where 
    `Product_ID` = '$id
    '";


    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("query failed" . mysqli_error($connection));
    } else {
        header('location:index.php?delete_msg = You have delete the product successfully.');
    }
}

?>
