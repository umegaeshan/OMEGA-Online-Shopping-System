<?php
session_start();
require_once './connect/connect.php';

$message = "";

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user values
    $username = $_POST['username'];
    $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger text-center'><strong>Error:</strong> This email is already registered.</div>";
    } else {
        $sql = "INSERT INTO users (username,password,email,role) VALUES ('$username','$hash_password','$email' , '$role')";

        if (mysqli_query($conn, $sql)) {
            // Success Message
            $_SESSION['message'] = "<div class='alert alert-success text-center'><strong>Success!</strong> Registration Successful. Please Login.</div>";
            header("Location:index.php");
            exit();
        } else {
            $message = "<div class='alert alert-danger text-center'><strong>Error:</strong> Registration Failed! " . $conn->errno . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | OMEGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #000046 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-register {
            background-color: #0d6efd;
            border: none;
            padding: 10px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4">
                    <div class="card-body">

                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Create Account</h2>
                            <p class="text-muted">Join OMEGA today!</p>
                        </div>

                        <?php if ($message != ""): ?>
                            <?php echo $message; ?>
                        <?php endif; ?>

                        <form action="register.php" method="post">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="regUser" placeholder="Username" required>
                                <label for="regUser">User Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="regEmail" placeholder="name@example.com" required>
                                <label for="regEmail">Email Address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="regPass" placeholder="Password" required>
                                <label for="regPass">Password</label>
                            </div>

                            <div class="form-floating mb-4">
                                <select class="form-select" name="role" id="roleSelect" required>
                                    <option value="" selected disabled>Select Your Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <label for="roleSelect">Role</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" name="register" class="btn btn-primary btn-register btn-lg text-white">Register</button>
                            </div>

                            <div class="text-center">
                                <p class="small mb-0">Already have an account? <a href="index.php" class="text-decoration-none fw-bold">Login Now</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>