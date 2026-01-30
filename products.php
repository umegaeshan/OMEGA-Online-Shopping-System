<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "login register 28");

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
    $sql = $sql . " AND category='$cat'";
}

if ($search != "search") {
    $sql = $sql . " AND name LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Product OMEGA</title>
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
                    <a class="navbar-brand ms-5 me-5" href="#">Filter</a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <select name="category" class="ms-1 p-1">
                                    <option class="dropdown-item" value="all">All Category</option>
                                    <option class="dropdown-item" value="shouse">Shouse</option>
                                    <option class="dropdown-item" value="cloths">Cloths</option]>
                                    <option class="dropdown-item" value="computer">Computer</option>
                                    <option class="dropdown-item" value="sport">Sport</option>
                                </select>
                        </ul>
                        </li>

                        <li class="price-filter mt-1 ms-5 me-5">
                            <label class="ms-5 me-5" style="color:white"> Min prices </label>
                            <input type="number" name="min_price" placeholder="Min" style="padding-left: 1rem; width:5rem;">

                            <label class="ms-5 me-5" style="color:white"> Max prices </label>
                            <input type="number" name="max_price" placeholder="Max" style="padding-left: 1rem; width:5rem;">
                        </li>
                        <li> <button class="btn btn-secondary ms-5 me-5" type="submit">Apply Filter</button></li>
                        <a href="products.php" class="btn btn-outline-danger btn-sm">Reset</a>
                        </ul>
                    </div>
                </div>
            </nav>
        </form>
    </div>



    <div class="product-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            // The loop must start BEFORE the product-card div
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="product-card">
                    <div class="image-box">
                        <?php if ($row['is_new']) { ?>
                            <span class="badge">New Arrival</span>
                        <?php } ?>

                        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>

                    <div class="card-body">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <div class="card-footer">
                            <span class="price">$<?php echo $row['price']; ?></span>
                            <div class="btn-group">
                                <button class="btn btn-details" href=" ">Details</button>
                                <button class="btn">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div> <?php
                    } // while ends here
                } else {
                    echo "<p style='grid-column: span 4; text-align: center;'>No products found.</p>";
                }
                        ?>
    </div>


    <?php
    include 'includes/footer.php';
    ?>

</body>

</html>