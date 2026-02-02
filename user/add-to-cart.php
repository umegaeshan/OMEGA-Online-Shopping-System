<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");


if (isset($_GET['id']) && isset($_SESSION['id'])) {

    $p_id = $_GET['id'];
    $u_id = $_SESSION['id'];

    $qut  = isset($_GET['qut']) ? $_GET['qut'] : 1;


    $check = "SELECT * FROM cart WHERE user_id = $u_id AND product_id = $p_id";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {

        $sql = "UPDATE cart SET quantity = quantity + $qut WHERE user_id = $u_id AND product_id = $p_id";
    } else {

        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($u_id, $p_id, $qut)";
    }

    if (mysqli_query($conn, $sql)) {

        header("Location: ../products.php?status=success");
        exit();
    }
}
