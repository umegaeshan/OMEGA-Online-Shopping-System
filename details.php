<?php
session_start();

$conn = new mysqli("localhost", "root", "", "login register 28");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
} else {
    // FIXED: Changed 'lcation' to 'Location' and corrected file name to 'products.php'
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name'] . " | OMEGA" ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .item {
            margin: 4rem auto;
            /* Changed to 'auto' to center it properly on all screens */
            max-width: 900px;
            padding: 3rem;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 2rem;
            background-color: #fff;
        }

        .img-fluid {
            border-radius: 1rem;
            object-fit: cover;
        }

        .row {
            display: flex;
            align-items: center;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <?php
    // This pulls in the navbar
    include 'includes/navbar.php';
    ?>

    <div class="container">
        <div class="item">

            <div class="card border-0">
                <div class="row g-0">

                    <div class="col-md-5">
                        <?php if ($product['is_new']) { ?>
                            <span class="badge">New Arrival</span>
                        <?php } ?>
                        <img
                            src="<?php echo $product['image_url']; ?>"
                            class="img-fluid"
                            alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body ps-md-5">
                            <h1 class="fw-bold"><?php echo $product['name'] ?></h1>
                            <h3 class="text-primary mb-3">$<?php echo $product['price'] ?></h3>
                            <p class="text-muted"><?php echo $product['description'] ?></p>

                            <div class="mt-4">
                                <button class="btn btn-primary btn-lg px-4">Add to Cart</button>
                                <a href="products.php" class="btn btn-outline-secondary btn-lg ms-2">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>