<?php

session_start();

require_once './connect/connect.php';

$message = "";

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get user values to variables 

    $username = $_POST['username'];
    $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    // check email or password exist in table 
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "Email already exists!";
    } else {
        $sql = "INSERT INTO users (username,password,email,role) VALUES ('$username','$hash_password','$email' , '$role')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Registration Successful!";
            header("Location:index.php");
            exit();
        } else {
            $message = "Registration Error !" . $conn->errno;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Register page</title>
</head>

<body>
    <div class="container">
        <form action="register.php" method="post">
            <div class="head">
                <center>
                    <h1> Register</h1>
                </center>
            </div>

            <div>
                <?php if ($message != ""): ?>
                    <p style="color:red; background-color:aliceblue; padding:10px;"> <?php echo $message; ?></p>
                <?php endif; ?>
            </div>

            <div class="userName">
                <label>User Name</label>
                <br>
                <input type="text" name="username" required>
            </div>

            <div class="password">
                <label>Password</label>
                <br>
                <input type="password" name="password" required>
            </div>

            <div class="email">
                <label>Email</label>
                <br>
                <input type="email" name="email" required>
            </div>

            <div class="role">
                <select name="role">
                    <option name="">Select Your Role</option>
                    <option name="user">User</option>
                    <option name="admin">Admin</option>
                </select>
            </div>

            <div class="registerButtonClass">
                <button type="submit" name="register" class="registerButton" value="Log In">Register</button>
                <br>
            </div>

            <div class="bottom-para">
                <center>
                    <p> I have an Account <a href="index.php" class="goToLogin"><b>Login Now </b></a></p>
                </center>
            </div>

        </form>
    </div>





</body>

</html>