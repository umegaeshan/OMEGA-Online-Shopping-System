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





    <div class="section">
        <div class="product">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card product-card border-0 rounded-4 shadow-sm">
                            <div class="position-relative">
                                <span class="badge bg-danger badge-custom">New Arrival</span>
                                <div class="overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw0fHxoZWFkcGhvbmV8ZW58MHwwfHx8MTczNDc5NTEyM3ww&ixlib=rb-4.0.3&q=80&w=1080" class="card-img-top product-image" alt="Product Image">
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <h5 class="card-title mb-2 fw-bold">Premium Wireless Headphones</h5>
                                <p class="card-text text-muted mb-2">Experience crystal clear sound with our latest noise-cancelling
                                    technology and premium build quality.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price">$299.99</span>
                                    <button class="btn btn-custom text-white px-4 py-2 rounded-pill">
                                        Add to Cart
                                    </button>
                                </div>
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

</body>

</html>