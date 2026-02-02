<?php
// 1. Session must be at the very top
session_start();

// 2. Database Connection
$conn = mysqli_connect("localhost", "root", "", "login register 28");





if (!isset($_SESSION['id'])) {
    echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin: 20px; font-family: sans-serif;'>
            <strong>Error:</strong> Please log in to view your cart.
          </div>";
    exit();
}

// item delete 


if (isset($_GET['delete_id'])) {
    $cart_id = $_GET['delete_id'];
    $del_sql = "DELETE FROM cart WHERE id = $cart_id";
    mysqli_query($conn, $del_sql);

    // After deleting, we refresh the page
    header("Location: cart.php?message=deleted");
    exit();
}

if (isset($_GET["massage"])) {
}


$u_id = $_SESSION['id'];

$sql = "SELECT 
            cart.id, 
            cart.quantity, 
            products.name, 
            products.price, 
            products.image_url 
        FROM cart 
        JOIN products 
        ON cart.product_id = products.id 
        WHERE cart.user_id = $u_id";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>

    <style>
        .cart-container {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        .cart-table {
            width: 75%;
            border-collapse: collapse;
            margin: 3rem 15rem;
            margin-right: 3rem;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cart-table th {
            background-color: #f8f9fa;
            color: #333;
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #dee2e6;
        }

        .cart-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .cart-table tr:hover {
            background-color: #f1f1f1;
        }

        /* 1. Add relative positioning to the table cell so the image stays near it */
        .cart-table td:first-child {
            position: relative;
            width: 80px;
            /* Keeps the column size steady */
            height: 80px;
            /* Keeps the row height steady */
        }

        .product-img {
            width: 70px;
            height: 70px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid #ddd;
            transition: all 0.4s ease;
            position: absolute;
            /* Takes the image out of the normal layout flow */
            top: 5px;
            left: 5px;
        }

        .product-img:hover {
            width: 150px;
            /* Grows large */
            height: 150px;
            z-index: 99;
            /* Makes it float ABOVE the other rows */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            transform: scale(1.1);
            /* Optional: adds a slight extra zoom effect */
        }

        .total-price {
            font-weight: bold;
            color: #28a745;
        }

        .alert {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <?php

    include "../includes/navbar.php";
    ?>

    <div class="container mt-3 d-flex justify-content-center ">
        <?php if (isset($_GET['message']) && $_GET['message'] == 'deleted') { ?>
            <div class="alert alert-danger alert-dismissible fade show text-center shadow-sm"
                role="alert"
                style="width: 100%; max-width: 600px; border-radius: 10px;">

                <strong>Deleted!</strong> Item removed from your OMEGA cart.

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    </div>

    <div class="cart-container">
        <center>
            <h2>Your Shopping Cart</h2>
        </center>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Path to image: Go up to root, then into images folder
                        // $imgPath = "../" . $row['image_url'];
                ?>
                        <tr>
                            <td><img src="<?php echo $row['image_url']; ?>" class="product-img"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td class="total-price">$<?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                            <td>
                                <a href="cart.php?delete_id=<?php echo $row['id']; ?>"
                                    style="padding:9px 12px ; background-color: red ; color:white; text-decoration:none ; border-radius: 10px;"
                                    class="btn-delete"
                                    onclick="return confirm('Remove this item?');">
                                    Delete
                                </a>


                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>  Your cart is empty!  </td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // FIXED PATH: Path to footer
    include '../includes/footer.php';
    ?>


</body>

</html>