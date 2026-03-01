<?php
// 1. Session must be at the very top
session_start();

// 2. Database Connection
$conn = mysqli_connect("sql301.infinityfree.com", "if0_41198448", "eESpwA1g2Ysu", "if0_41198448_if0_41198448_omega");

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        .cart-container {
            margin: 20px auto;
            max-width: 1200px;
            /* පිටුව මැදට ගන්න උපරිම පළලක් දුන්නා */
            font-family: Arial, sans-serif;
            padding: 0 15px;
        }

        .cart-table {
            width: 100%;
            /* 75% වෙනුවට 100% දුන්නා */
            border-collapse: collapse;
            margin: 2rem auto;
            /* කලින් තිබුණු 15rem අයින් කරලා මැදට ගත්තා */
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cart-table th {
            background-color: #f8f9fa;
            color: #333;
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
            /* වචන කැඩෙන එක නවත්වන්න */
        }

        .cart-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .cart-table tr:hover {
            background-color: #f1f1f1;
        }

        .cart-table td:first-child {
            position: relative;
            width: 80px;
            height: 80px;
        }

        .product-img {
            width: 70px;
            height: 70px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid #ddd;
            transition: all 0.4s ease;
            position: absolute;
            top: 5px;
            left: 5px;
        }

        .product-img:hover {
            width: 150px;
            height: 150px;
            z-index: 99;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            transform: scale(1.1);
        }

        .total-price {
            font-weight: bold;
            color: #28a745;
        }

        .action-btns {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            /* Button දෙක Phone එකේදී යටින් වැටෙන්න */
        }

        /* Mobile Responsive CSS */
        @media (max-width: 768px) {

            .cart-table td,
            .cart-table th {
                padding: 8px;
                /* Phone එකේ ඉඩ ඉතුරු කරන්න padding අඩු කළා */
                font-size: 14px;
            }

            .product-img:hover {
                width: 100px;
                /* Phone එකේ ලොකු වැඩියි නිසා hover සයිස් එක අඩු කළා */
                height: 100px;
            }

            .btn-delete,
            .btn-Purches {
                font-size: 12px;
                padding: 6px 10px !important;
                display: inline-block;
                text-align: center;
                width: 100%;
                /* Buttons Phone එකේදී පේළියට දිගටම වැටෙන්න */
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>

    <?php include "../includes/navbar.php"; ?>

    <div class="container mt-3 d-flex justify-content-center">
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
            <h2 class="mb-4">Your Shopping Cart</h2>
        </center>

        <div class="table-responsive">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                        <th>Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><img src="<?php echo $row['image_url']; ?>" class="product-img"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>$<?php echo number_format($row['price'], 2); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td class="total-price">$<?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                                <td>
                                    <a href="cart.php?delete_id=<?php echo $row['id']; ?>"
                                        style="padding:9px 12px; background-color: red; color:white; text-decoration:none; border-radius: 10px;"
                                        class="btn-delete"
                                        onclick="return confirm('Remove this item?');">
                                        Delete
                                    </a>
                                </td>
                                <td>
                                    <a href="add-to-order.php?purches_id=<?php echo $row['id']; ?>"
                                        style="padding:9px 12px; background-color: green; color:white; text-decoration:none; border-radius: 10px;"
                                        class="btn-Purches"
                                        onclick="return confirm('Purchase this item?');">
                                        Purchase
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        // colspan එක 5 ඉඳන් 7 ට වෙනස් කළා (කොලම් 7ක් තියෙන නිසා)
                        echo "<tr><td colspan='7' style='text-align:center; padding: 20px;'>Your cart is empty!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>