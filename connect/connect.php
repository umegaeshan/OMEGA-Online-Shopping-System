<?php
// databaase connection

$localhost = "localhost";
$user = "root";
$password = "";
$database = "login register 28";

$conn = new mysqli($localhost, $user, $password, $database);

if (!$conn) {
    die("database connection error" . $conn->connect_errno);
}
