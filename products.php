<?php

session_start();

$conn = mysqli_connect("sql301.infinityfree.com", "if0_41198448", "eESpwA1g2Ysu", "if0_41198448_if0_41198448_omega");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// FILTERING CONDITIONS
if (isset($_GET["category"])) {
    $cat = $_GET["category"];
} else {
    $cat = "all";
}

if (isset($_GET["min_price"])) {
    $min = $_GET["min_price"];
} else {
    $min = 0;
}

if (isset($_GET["max_price"])) {
    $max = $_GET["max_price"];
} else {
    $max = 100000;
}

if (isset($_GET["search"])) {
    $search = $_GET["search"];
} else {
    $search = "";
}

$sql = "SELECT * FROM products WHERE price>=$min AND price<$max";

if ($cat != 'all') {
    $sql = $sql . "  AND   category='$cat'";
}

if ($search != "" && $search != "search") {
    $sql = $sql . "  AND name LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product OMEGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/products.css">
</head>

<body>

    <?php
    // This pulls in the navbar
    include 'includes/navbar.php';
    ?>

    <div class="filter">
        <form action="products.php" method="GET">
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand ms-md-4" href="products.php">Filter</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterNavbar" aria-controls="filterNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="filterNavbar">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">

                            <li class="nav-item me-lg-4 mb-2 mb-lg-0 mt-2 mt-lg-0">
                                <select name="category" class="form-select form-select-sm w-auto">
                                    <option value="all" <?php if ($cat == 'all') echo 'selected'; ?>>All Category</option>
                                    <option value="shouse" <?php if ($cat == 'shouse') echo 'selected'; ?>>Shoes</option>
                                    <option value="cloths" <?php if ($cat == 'cloths') echo 'selected'; ?>>Clothes</option>
                                    <option value="computer" <?php if ($cat == 'computer') echo 'selected'; ?>>Computer</option>
                                    <option value="sport" <?php if ($cat == 'sport') echo 'selected'; ?>>Sport</option>
                                </select>
                            </li>

                            <li class="nav-item price-filter me-lg-4 mb-2 mb-lg-0">
                                <div class="d-flex align-items-center flex-wrap gap-2 text-white">
                                    <label>Min Price</label>
                                    <input type="number" name="min_price" class="form-control form-control-sm" value="<?php echo $min; ?>" placeholder="Min" style="width: 80px;">

                                    <label class="ms-lg-2">Max Price</label>
                                    <input type="number" name="max_price" class="form-control form-control-sm" value="<?php echo $max; ?>" placeholder="Max" style="width: 80px;">
                                </div>
                            </li>

                            <li class="nav-item d-flex gap-2 mt-2 mt-lg-0">
                                <button class="btn btn-secondary btn-sm" type="submit">Apply Filter</button>
                                <a href="products.php" class="btn btn-outline-danger btn-sm">Reset</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </form>
    </div>

    <div class="container mt-3">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Success!</strong> Item added to your OMEGA cart.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    </div>

    <div class="product-grid">

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="product-card">
                    <div class="image-box">
                        <?php if (isset($row['is_new']) && $row['is_new']) { ?>
                            <span class="badge">New Arrival</span>
                        <?php } ?>

                        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>

                    <div class="card-body">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo isset($row['description']) ? $row['description'] : ''; ?></p>
                        <div class="card-footer">
                            <span class="price">$<?php echo $row['price']; ?></span>
                            <div class="btn-group">
                                <a class="btn btn-details" href="details.php?id=<?php echo $row['id']; ?>">Details</a>
                                <a href="user/add-to-cart.php?id=<?php echo $row['id']; ?>" class="btn">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            } // while ends here
        } else {
            echo "<p class='no-products'>No products found.</p>";
        }
        ?>
    </div>

    <?php
    include 'includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>