<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "login register 28");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    die("Access denied!");
}

// 3. Get ID and Sanitize
$id = (int) $_GET["id"];

// 4. Run Query
$sql = "DELETE FROM users WHERE id=$id"; // Removed quotes since $id is an integer

if (mysqli_query($conn, $sql)) {
    header("Location:manage_users.php?msg=deleted");
    exit();
} else {
    header("Location:manage_users.php?msg=error");
    exit();
}
