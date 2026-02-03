<?php

$conn = new mysqli("localhost", "root", "", "login register 28");


if ($_SESSION["id"] != 'admin') {
    die('Access Dinited !');
}

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | OMEGA</title>
</head>

<body>

</body>

</html>