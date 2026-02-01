<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");

// 1. Check if we have the ID, Quantity, and a logged-in User
if (isset($_GET['id']) && isset($_SESSION['id'])) {

    $p_id = $_GET['id'];
    $u_id = $_SESSION['id'];
    // Catch the quantity from the form (?qut=)
    $qut  = isset($_GET['qut']) ? $_GET['qut'] : 1;

    // 2. Check if item is already in this user's cart
    $check = "SELECT * FROM cart WHERE user_id = $u_id AND product_id = $p_id";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        // 3. Update with the new chosen quantity
        $sql = "UPDATE cart SET quantity = quantity + $qut WHERE user_id = $u_id AND product_id = $p_id";
    } else {
        // 4. Insert the new item with the chosen quantity
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($u_id, $p_id, $qut)";
    }

    if (mysqli_query($conn, $sql)) {
        // We add the status to the URL here
        header("Location: ../products.php?status=success");
        exit();
    }
}
