<?php include("header.php"); ?>
<?php include("dbcon.php"); ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$query = "SELECT * FROM `product_table` WHERE `Product_ID` = '$id'";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
} else {
    $row = mysqli_fetch_assoc($result);
}

?>

<?php
if (isset($_POST['update_products'])) {
    if (isset($_GET['id_new'])) {
        $idnew = $_GET['id_new'];
    }
    $p_name = $_POST['p_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $query = "UPDATE `product_table` SET `Product_Name` = '$p_name', `Quantity` = '$quantity', `Price` = '$price', `Description` = '$description' WHERE `Product_ID` = '$idnew'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location:index.php?update_msg=You have successfully updated the product');
    }
}
?>

<form action="Update_page.php?id_new=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="">Product Name</label>
        <input type="text" name="p_name" class="form-control" value="<?php echo $row['Product_Name']; ?>">
    </div>
    <div class="form-group">
        <label for="">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="<?php echo $row['Quantity']; ?>">
    </div>
    <div class="form-group">
        <label for="">Price</label>
        <input type="text" name="price" class="form-control" value="<?php echo $row['Price']; ?>">
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-control"><?php echo $row['Description']; ?></textarea>
    </div>
    <input type="submit" class="btn btn-success" name="update_products" value="UPDATE" style="margin: 15px;">
</form>

<?php include("footer.php"); ?>