<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != 'admin') {
    die("Access Denied!");
}

// Order Status එක වෙනස් කිරීම (Pending -> Completed)
if (isset($_GET['id']) && isset($_GET['status'])) {
    $o_id = $_GET['id'];
    $status = $_GET['status'];
    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$o_id");
    header("Location: manage_orders.php");
    exit();
}

// Orders, Users සහ Products එකට join කරලා data ගැනීම
$sql = "SELECT orders.*, users.username, products.name as pname, products.image_url 
        FROM orders 
        JOIN users ON orders.user_id = users.id 
        JOIN products ON orders.product_id = products.id 
        ORDER BY orders.id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <center>
            <h2>Customer Orders</h2>
        </center>
        <table class="table table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>
                            <img src="../<?php echo $row['image_url']; ?>" width="40" height="40" style="border-radius:50%">
                            <?php echo $row['pname']; ?>
                        </td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>
                            <?php if ($row['status'] == 'Pending') { ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php } else { ?>
                                <span class="badge bg-success">Completed</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'Pending') { ?>
                                <a href="manage_orders.php?id=<?php echo $row['id']; ?>&status=Completed" class="btn btn-success btn-sm">Mark Complete</a>
                            <?php } else { ?>
                                <button class="btn btn-secondary btn-sm" disabled>Done</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>