<?php
// 1. හැමතිස්සෙම session_start() උඩින්ම තියෙන්න ඕන
session_start();

$conn = mysqli_connect("localhost", "root", "", "login register 28");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Admin කෙනෙක්ද කියලා බලන්න ඕන 'role' එකෙන් ('id' එකෙන් නෙමෙයි)
if (!isset($_SESSION["role"]) || $_SESSION["role"] != 'admin') {
    die('Access Denied!');
}

// 3. URL එකෙන් එන ID එක අරගන්නවා
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ඒ ID එකට අදාළ User ගේ විස්තර ගන්නවා
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("User not found!");
    }
} else {
    header("Location: manage_users.php");
    exit();
}

// 4. Update Button එක Click කළාම වෙන දේ
if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_sql = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        // සාර්ථක නම් manage_users page එකට යවනවා
        echo "<script>alert('User Updated Successfully!'); window.location='manage_users.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | OMEGA Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* පොඩි ලස්සන Style ටිකක් */
        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <?php include '../includes/navbar.php'; ?>

    <div class="container">
        <div class="card p-4">
            <h3 class="text-center mb-4 text-primary">Edit User Details</h3>

            <form action="" method="POST">

                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-select">
                        <option value="user" <?php if ($row['role'] == 'user') echo 'selected'; ?>>User</option>
                        <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                    <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

</body>

</html>