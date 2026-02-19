<?php
// databaase connection

$localhost = "sql301.infinityfree.com";
$user = "if0_41198448";
$password = "eESpwA1g2Ysu";
$database = "if0_41198448_if0_41198448_omega";

$conn = new mysqli($localhost, $user, $password, $database);

if (!$conn) {
    die("database connection error" . $conn->connect_errno);
}
