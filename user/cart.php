<?php
// 1. Session must be at the very top
session_start();

// 2. Database Connection
$conn = mysqli_connect("localhost", "root", "", "login register 28");

// 3. FIXED PATH: Path to navbar (Go up one level out of 'user' folder)
include '../includes/navbar.php';



if (!isset($_SESSION['id'])) {
    echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin: 20px; font-family: sans-serif;'>
            <strong>Error:</strong> Please log in to view your cart.
          </div>";
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
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $u_id";

$result = mysqli_query($conn, $sql);
?>

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

    .product-img {
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    .total-price {
        font-weight: bold;
        color: #28a745;
    }
</style>

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
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Path to image: Go up to root, then into images folder
                    $imgPath = "../" . $row['image_url'];
            ?>
                    <tr>
                        <td><img src="<?php echo $imgPath; ?>" width="60" height="60" class="product-img"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td class="total-price">$<?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>Your cart is empty!</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// FIXED PATH: Path to footer
include '../includes/footer.php';
?>