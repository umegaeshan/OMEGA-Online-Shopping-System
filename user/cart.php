<?php
session_start();

// 1. Check if an ID was actually sent
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 2. If the cart doesn't exist yet, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // 3. Add item or increase quantity
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += 1; // Already there? Add 1 more
    } else {
        $_SESSION['cart'][$id] = 1; // New? Set to 1
    }

    // 4. Redirect back to the shop immediately
    header("Location: products.php");
    exit();
}
