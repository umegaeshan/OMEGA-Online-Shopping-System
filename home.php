<?php
session_start();

// Check if user is actually logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<p>You are logged in as: <b><?php echo $_SESSION['role']; ?></b></p>
<a href="index.php">Logout</a>