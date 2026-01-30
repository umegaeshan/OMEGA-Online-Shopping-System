<?php

session_start();

$conn = new mysqli("localhost", "root", "", "login register 28");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
} else {
    header("lcation:product.php");
    exit();
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name'] . "| OMEGA" ?></title>

    <style>
        .item {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            margin: 4rem 30rem;
            padding: 5rem;
            box-shadow: 0px 0px 8px black;
            border-radius: 2rem;
        }

        .img-fluid {
            border-radius: 1rem;
        }
    </style>
</head>



<body>

    <?php
    // This pulls in the navbar
    include 'includes/navbar.php';
    ?>


    <div class="item">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $product['image_url'] ?>" class="img-fluid rounded-start" alt="<?php echo $product['name']  ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $product['name']  ?></h2>
                        <p class="card-text"><?php echo $product['description'] ?></p>
                        <p class="card-text">
                        <p class="text-body-secondary">Last updated 3 mins ago</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'includes/footer.php';
    ?>

</body>

</html>