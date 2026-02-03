<?php

$conn = mysqli_connect("localhost", "root", "", "login register 28");

session_start();

if (($_SESSION["role"] != 'admin')) {

    die("Access Denided ! ");
}



$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Manage Products</title>

    <style>
        .table {
            margin: 3rem 1rem;
            width: 90%;

        }

        .container {
            display: flex;
            align-items: center;

        }

        .table th {
            padding: 2rem 1rem;
        }

        .table td {
            padding: 1rem 1rem;
        }

        .blur-in {
            font-family: sans-serif;
            font-size: 3rem;
            font-weight: bolder;
            /* Apply the animation */
            animation: blur-text 2s ease-in-out forwards;
            margin-top: 2rem;
        }

        @keyframes blur-text {
            0% {
                filter: blur(12px);
                opacity: 0;
                transform: scale(0.9);
                /* Optional: adds a slight zoom effect */
            }

            100% {
                filter: blur(0px);
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>


</head>

<body>

    <?php include '../includes/navbar.php';  ?>

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <center>
            <h1 class="blur-in">Manage Users || OMEGA</h1>
        </center>
    <?php } ?>


    <?php if (isset($_GET['msg'])): ?>

        <?php
        $is_deleted = ($_GET['msg'] == 'deleted');
        $color = $is_deleted ? '#2ecc71' : '#e74c3c';
        $text = $is_deleted ? ' deleted successfully!' : 'An error occurred.';
        ?>

        <div id="alert" style="background: white; border: 1px solid <?php echo $color; ?>; color: <?php echo $color; ?>; padding: 15px; margin: 10px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; font-family: sans-serif;">

            <span><strong>Notice:</strong> <?php echo $text; ?></span>

            <button onclick="document.getElementById('alert').style.display='none'" style="background: none; border: none; font-size: 20px; cursor: pointer; color: <?php echo $color; ?>;">
                &times;
            </button>

        </div>
    <?php endif; ?>

    <div class="container">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody> <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php $row['image_url']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><a href="edit-user.php?id=<?php echo $row['id']; ?>"><button class="btn btn-warning">Edit</button></a></td>
                        <td><a href="delete-user.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <?php include '../includes/footer.php';  ?>




</body>

</html>