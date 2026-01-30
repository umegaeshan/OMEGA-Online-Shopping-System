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
    $sql = $sql . "AND category='$cat'";
}

if ($search != "search") {
    $sql = $sql . "AND name LIKE '%$search%'";
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
    <title>Home page</title>
    <link rel="stylesheet" href="./styles/products.css">


</head>

<body>


    <?php
    // This pulls in the navbar
    include 'includes/navbar.php';
    ?>

    <div class="filter">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand ms-5 me-5" href="#">Filter</a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle ms-5 me-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorys
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Electric</a></li>
                                <li><a class="dropdown-item" href="#">Shouse</a></li>
                                <li><a class="dropdown-item" href="#">Cloths</a></li>
                                <li><a class="dropdown-item" href="#">Computer</a></li>
                                <li><a class="dropdown-item" href="#">Sport</a></li>

                            </ul>
                        </li>

                        <li class="price-filter mt-1 ms-5 me-5">
                            <label class="ms-5 me-5" style="color:white"> Min prices </label>
                            <input type="number" name="min" placeholder="Min" style="padding-left: 1rem; width:5rem;">

                            <label class="ms-5 me-5" style="color:white"> Max prices </label>
                            <input type="number" name="max" placeholder="Max" style="padding-left: 1rem; width:5rem;">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>



    <div class="product-grid">

        <div class="product-card">
            <div class="image-box">
                <span class="badge">New Arrival</span>
                <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?q=80&w=1080" alt="Product">
            </div>
            <div class="card-body">
                <h3>Premium Wireless Headphones</h3>
                <p>Experience crystal clear sound with noise-cancelling tech.</p>
                <div class="card-footer">
                    <span class="price">$299.99</span>
                    <button class="btn btn-details ms-5">Details</button>
                    <button class="btn">Add to Cart</button>
                </div>
            </div>
        </div>



    </div>

    <?php
    include 'includes/footer.php';
    ?>

</body>

</html>