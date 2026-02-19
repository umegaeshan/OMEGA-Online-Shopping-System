<?php
session_start();
$conn = mysqli_connect("sql301.infinityfree.com", "if0_41198448", "eESpwA1g2Ysu", "if0_41198448_if0_41198448_omega");

if (!isset($_SESSION['id'])) {
    echo "<div class='alert alert-danger m-5'>Please log in to view your Orders.</div>";
    exit();
}

// Order delete logic (Cancel Order)
if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    $del_sql = "DELETE FROM orders WHERE id = $del_id";
    mysqli_query($conn, $del_sql);
    header("Location: orders.php?message=deleted");
    exit();
}

$u_id = $_SESSION['id'];

// FIXED: Now selecting from the 'orders' table instead of 'cart'
$sql = "SELECT 
            orders.id, 
            orders.quantity, 
            orders.status,
            products.name, 
            products.price, 
            products.image_url 
        FROM orders 
        JOIN products ON orders.product_id = products.id 
        WHERE orders.user_id = $u_id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Orders || OMEGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-table {
            width: 80%;
            margin: 3rem auto;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-table th,
        .cart-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <center>
            <h2>My Confirmed Orders</h2>
        </center>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><img src="<?php echo $row['image_url']; ?>" class="product-img"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>$<?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                            <td><span class="badge bg-warning"><?php echo $row['status']; ?></span></td>
                            <td>
                                <a href="orders.php?delete_id=<?php echo $row['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Cancel this order?');">Cancel</a>
                            </td>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='7'>No orders found.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>

    <?php include '../includes/footer.php'; ?>

</body>

</html>