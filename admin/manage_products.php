<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != 'admin') {
    die("Access Denied!");
}

// Delete Logic
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: manage_products.php?msg=deleted");
    exit();
}

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Products</title>
</head>

<body>

    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <center>
            <h2 class="mb-4">Manage Products</h2>
        </center>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') { ?>
            <div class="alert alert-success">Product deleted successfully!</div>
        <?php } ?>

        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <img src="../<?php echo $row['image_url']; ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius:5px;">
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td>
                            <a href="edit_products.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="manage_products.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>