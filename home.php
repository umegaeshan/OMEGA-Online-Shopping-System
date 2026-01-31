<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <title>Admin Panal | OMEGA</title>
    <?php } else { ?>
        <title> Home Page | OMEGA </title>
    <?php } ?>

    <link rel="stylesheet" href="./styles/home.css">


</head>

<body>


    <?php
    // This pulls in the navbar
    include 'includes/navbar.php';
    ?>
    <?php if ($_SESSION['role'] == 'admin') { ?>
        <center>
            <h1 class="blur-in">Welcome to Admin Panal</h1>
        </center>
    <?php } ?>
    <div class="grid-container">
        <div class="intro">
            <h1 style="font-size: 3rem; color: #333; margin-bottom: 10px;">
                Quality Products, <span style="color: #ff9900;">Delivered to You.</span>
            </h1>
            <p style="font-size: 1.2rem; color: #666; line-height: 1.6;">
                Discover our curated collection of essentials and trends.
                Simple shopping, secure checkout, and fast shipping.
            </p>
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <div style="margin-top: 30px;">
                    <a href="products.php" style="
                background-color: #333; 
                color: white; 
                padding: 12px 30px; 
                text-decoration: none; 
                border-radius: 5px;
                font-weight: bold;
            ">Start Manage System</a>
                <?php } else { ?>
                    <div style="margin-top: 30px;">
                        <a href="products.php" style="
                background-color: #333; 
                color: white; 
                padding: 12px 30px; 
                text-decoration: none; 
                border-radius: 5px;
                font-weight: bold;
            ">Shop Now</a>
                    <?php  } ?>
                    </div>
                </div>

                <div class="image-slider">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images\2309-w058-n003-726B-p15-726.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images\cyber-monday-shopping-sales.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images\piyush_28_feb_22.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
        </div>


        <?php
        include 'includes/footer.php';
        ?>

</body>

</html>