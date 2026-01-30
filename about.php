<?php
session_start(); // Ensures navbar knows if user is logged in
include 'includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/about.css">
    <title>About OMEGA</title>
</head>

<body>

    <div class="about-hero text-white py-5 mb-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold blur-in">About OMEGA</h1>
            <p class="lead">Your one-stop destination for the latest trends and quality products.</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Our Story</h2>
                <p class="text-muted">
                    Founded in 2026, OMEGA started with a simple vision: to make high-quality electronics,
                    fashion, and lifestyle products accessible to everyone. We believe that shopping
                    should be easy, reliable, and fun.
                </p>
                <p class="text-muted">
                    From our humble beginnings as a small project group named <strong>PIXCODE Hub</strong>,
                    we have grown into a platform dedicated to bringing you the best items from around the world.
                </p>
            </div>
            <div class="col-md-6">
                <img src="images/about-store.jpg" class="img-fluid rounded-4 shadow-custom" alt="Our Store">
            </div>
        </div>

        <div class="row text-center mt-5">
            <div class="col-md-4">
                <div class="value-card p-3">
                    <h4 class="fw-bold">Fast Delivery</h4>
                    <p class="text-muted">We ensure your orders reach your doorstep in record time, safe and sound.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card p-3">
                    <h4 class="fw-bold">Quality Guarantee</h4>
                    <p class="text-muted">Every product in our store goes through a strict quality check process.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card p-3">
                    <h4 class="fw-bold">24/7 Support</h4>
                    <p class="text-muted">Our dedicated team is always here to help you with any questions or issues.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>