<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");

if ($_SESSION["role"] != 'admin') {
    die("Access Denied!");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $img = $_POST['image_url'];

    $sql = "UPDATE products SET name='$name', price='$price', description='$desc', image_url='$img' WHERE id=$id";
    mysqli_query($conn, $sql);
    echo "<script>alert('Product Updated!'); window.location='manage_products.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="text-center">Edit Product</h2>
        <form method="POST" class="card p-4 shadow">
            <label>Product Name</label>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control mb-3" required>

            <label>Price</label>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" class="form-control mb-3" required>

            <label>Description</label>
            <textarea name="description" class="form-control mb-3"><?php echo $product['description']; ?></textarea>

            <label>Image URL</label>
            <input type="text" name="image_url" value="<?php echo $product['image_url']; ?>" class="form-control mb-3">

            <button type="submit" name="update_product" class="btn btn-success">Update Product</button>
            <a href="manage_products.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>