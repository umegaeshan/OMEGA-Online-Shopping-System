<?php
session_start();
$conn = mysqli_connect("sql301.infinityfree.com", "if0_41198448", "eESpwA1g2Ysu", "if0_41198448_if0_41198448_omega");

// 1. We catch 'purches_id' from your cart.php link
if (isset($_GET['purches_id']) && isset($_SESSION['id'])) {

    $cart_id = $_GET['purches_id'];
    $u_id = $_SESSION['id'];


    $cart_query = "SELECT * FROM cart WHERE id = $cart_id";
    $cart_res = mysqli_query($conn, $cart_query);
    $item = mysqli_fetch_assoc($cart_res);

    if ($item) {
        $p_id = $item['product_id'];
        $qty  = $item['quantity'];


        $order_sql = "INSERT INTO orders (user_id, product_id, quantity, status) 
                      VALUES ($u_id, $p_id, $qty, 'Pending')";

        if (mysqli_query($conn, $order_sql)) {
            // 4. After successful order, DELETE from cart
            $del_sql = "DELETE FROM cart WHERE id = $cart_id";
            mysqli_query($conn, $del_sql);

            // Redirect to the orders page with a success message
            header("Location: orders.php?status=ordered");
            exit();
        }
    }
}
