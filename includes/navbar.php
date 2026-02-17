<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        // අපි බලමු දැනට ඉන්නේ මොන folder එකේද කියලා links හරියට දෙන්න
        // මේක simple logic එකක්. 
        $path_prefix = "";
        if (basename(getcwd()) == "admin" || basename(getcwd()) == "user") {
            $path_prefix = "../";
        }
        ?>

        <a class="navbar-brand" href="<?php echo $path_prefix; ?>index.php">OMEGA
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                <sup style="background-color: red; color:white; font-size: 10px; padding:2px; border-radius:2px;">ADMIN</sup>
            <?php } ?>
        </a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 p-3" style="font-size: 1.1rem;">

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>home.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>admin/add_products.php">Add Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>admin/manage_products.php">Edit Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>admin/manage_users.php">Manage Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>admin/manage_orders.php">Orders</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>user/cart.php">My Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>user/orders.php">My Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>Contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $path_prefix; ?>about.php">About Us</a></li>
                <?php } ?>
            </ul>

            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['username'])) { ?>
                    <div class="text-white me-3">
                        Hi, <b><?php echo $_SESSION['username']; ?></b>
                    </div>
                    <a href="<?php echo $path_prefix; ?>person_details.php" class="btn btn-light btn-sm me-2">Profile</a>
                    <a href="<?php echo $path_prefix; ?>logout.php" class="btn btn-danger btn-sm">Log Out</a>
                <?php } else { ?>
                    <a href="<?php echo $path_prefix; ?>index.php" class="btn btn-light me-2">Log In</a>
                    <a href="<?php echo $path_prefix; ?>register.php" class="btn btn-warning">Register</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>