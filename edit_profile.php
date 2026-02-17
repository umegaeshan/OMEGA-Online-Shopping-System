<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login register 28");

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['id'];
$msg = "";

// Update Button එක click කලොත්
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET username='$username', email='$email' WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $username; // Session එකෙත් නම update කරනවා
        $msg = "<div class='alert alert-success'>Profile Updated Successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error Updating Profile.</div>";
    }
}

// User ගේ විස්තර ගන්නවා form එකේ පෙන්නන්න
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3>Edit Your Profile</h3>
            </div>
            <div class="card-body">
                <?php echo $msg; ?>
                <form method="post">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">Update Profile</button>
                    <br><br>
                    <a href="person_details.php" class="btn btn-secondary w-100">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>