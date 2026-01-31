<?php
session_start();

// 1. Connection to your database
$conn = mysqli_connect("localhost", "root", "", "login register 28");

// 2. Check if the user is actually logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// 3. Get the ID of the person who is currently logged in
$current_user_id = $_SESSION['id'];

// 4. Fetch their specific details from the database
$sql = "SELECT * FROM users WHERE id = '$current_user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | OMEGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/profile.css">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">
        <div class="profile-card mx-auto shadow p-5">
            <div class="text-center mb-4">
                <?php if ($user['role'] == 'admin') { ?>
                    <div class="admin-badge mb-3">🛠️ System Administrator</div>
                <?php } else { ?>
                    <div class="user-badge mb-3">👤 Valued Customer</div>
                <?php } ?>

                <h2 class="fw-bold"><?php echo $user['username']; ?></h2>
                <hr>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label class="text-muted small uppercase">Full Name</label>
                    <p class="fs-5 fw-semibold"><?php echo $user['username']; ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="text-muted small uppercase">Email Address</label>
                    <p class="fs-5 fw-semibold"><?php echo $user['email']; ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="text-muted small uppercase">Account Type</label>
                    <p class="fs-5 fw-semibold text-primary"><?php echo ucfirst($user['role']); ?></p>
                </div>
                <!-- <div class="col-md-6 mb-3">
                    <label class="text-muted small uppercase">Member Since</label>
                    <p class="fs-5 fw-semibold"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></p>
                </div> -->
            </div>

            <div class="mt-4 d-flex gap-2">
                <a href="edit_profile.php" class="btn btn-primary px-4">Edit Profile</a>
                <a href="logout.php" class="btn btn-danger">Log Out</a>
                <?php if ($user['role'] == 'admin') { ?>
                    <a href="home.php" class="btn btn-dark px-4">Go to Admin Panel</a>
                <?php } ?>
            </div>



        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>

</html>