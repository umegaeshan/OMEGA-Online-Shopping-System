<?php

$conn = mysqli_connect("localhost", "root", "", "login register 28");

session_start();

if (($_SESSION["role"] != 'admin')) {

    die("Access Denided ! ");
}

$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Manage Users</title>

    <style>
        .table {
            margin: 5rem 7rem;
            width: 70%;

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
    </style>


</head>

<body>

    <?php include '../includes/navbar.php';  ?>
    <div class="container">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="row">ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_array($result)) { ?>

                <tbody>
                    <tr>
                        <td scope="col"><?php echo $row['id'] ?></td>
                        <td scope="col"><?php echo $row['username'] ?></td>
                        <td scope="col"><?php echo $row['email'] ?></td>
                        <td scope="col"><?php echo $row['role'] ?></td>
                        <td><a href="edit-user.php?id=<?php $row['id'] ?>"><button type="button" class="btn btn-warning"> Edit</button></a></td>
                        <td><a href="delete-user.php?id=<?php $row['id'] ?>"><button type="button" class="btn btn-danger"> Delete</button></a></td>

                    </tr>
                </tbody>
            <?php   } ?>
        </table>

    </div>

    <?php include '../includes/footer.php';  ?>




</body>

</html>