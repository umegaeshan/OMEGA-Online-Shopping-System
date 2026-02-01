<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");

// 1. FIXED: Check if user_id exists in session to avoid 'Undefined key' error
if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-danger'>Please log in to view your cart.</div>";
    exit();
}

$u_id = $_SESSION['user_id'];

// 2. FIXED: The SQL now has a guaranteed ID value
$sql = "SELECT cart.*, products.name, products.price, products.image_url 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $u_id";

$result = mysqli_query($conn, $sql);

// 3. FIXED: Catch query errors so the page doesn't crash
if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}
?>

<table class="table">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <tr>
                <td><img src="../<?php echo $row['image_url']; ?>" width="50"></td>
                <td><?php echo $row['name']; ?></td>
                <td>$<?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>$<?php echo $row['price'] * $row['quantity']; ?></td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>Your cart is empty!</td></tr>";
    }
    ?>
</table>