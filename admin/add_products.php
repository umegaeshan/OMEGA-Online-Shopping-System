<?php
session_start();

// 1. Ensure database connection is active
$conn = mysqli_connect("localhost", "root", "", "login register 28");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Protect the page - Only Admin can enter
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die('Access Denied!');
}

// 3. Process the Form Submission
if (isset($_POST['add_product'])) {
    $name =  $_POST['name'];
    $description =  $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_url =  $_POST['image_url'];
    $is_new = isset($_POST['is_new']) ? 1 : 0;

    // Use single quotes for all string values in SQL
    $sql = "INSERT INTO products (name, description, price, category, image_url, is_new) 
            VALUES ('$name', '$description', '$price', '$category', '$image_url', '$is_new')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product Added successfully!'); window.location='manage_products.php';</script>";
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Product | OMEGA</title>
    <style>
        .container {
            margin-top: 3rem;
            max-width: 600px;
            /* Centering the form better */
        }

        .blur-in {
            font-family: sans-serif;
            font-size: 3rem;
            font-weight: bolder;
            animation: blur-text 2s ease-in-out forwards;
            margin-top: 2rem;
        }

        @keyframes blur-text {
            0% {
                filter: blur(12px);
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                filter: blur(0px);
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>

    <?php include '../includes/navbar.php'; ?>

    <center>
        <h1 class="blur-in">Add Product || OMEGA</h1>
    </center>

    <div class="container bg-light p-4 rounded shadow-sm">
        <form class="row g-3" method="POST" action="add_products.php">

            <div class="col-md-12">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
            </div>

            <div class="col-md-12 mt-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Enter product details" style="height: 100px" required></textarea>
            </div>

            <div class="col-md-6 mt-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" required>
            </div>

            <div class="col-md-6 mt-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="" selected disabled>Select Category</option>
                    <option value="cloths">Cloths</option>
                    <option value="computer">Computer</option>
                    <option value="electric">Electric</option>
                    <option value="shouse">Shouse</option>
                    <option value="sport">Sport</option>
                </select>
            </div>

            <div class="col-md-12 mt-3">
                <label class="form-label">Image URL</label>
                <input name="image_url" class="form-control" type="text" placeholder="images/product.jpg" required>
            </div>

            <div class="col-md-12 mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_new" id="isNew">
                    <label class="form-check-label fw-bold" for="isNew">Mark as New Arrival</label>
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" name="add_product" class="btn btn-primary px-5 py-2">Add Product</button>
                <a href="manage_products.php" class="btn btn-outline-secondary px-5 py-2 ms-2">Back</a>
            </div>
        </form>
    </div>

    <?php include '../includes/footer.php'; ?>

</body>

</html>