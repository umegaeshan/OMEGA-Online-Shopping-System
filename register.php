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
        <form action="home.php" method="post">
            <div class="head">
                <center>
                    <h1> Register</h1>
                </center>
            </div>
            <div class="userName">
                <label>User Name</label>
                <br>
                <input type="text" name="userName" required>
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
                <label>Select Your Role</label>
                <br>
                <select class="selectRole">
                    <option name="user">User</option>
                    <option name="admin">Admin</option>
                </select>
            </div>

            <div class="registerButtonClass">
                <button type="sumbit" name="register" class="registerButton" value="Log In">Register</button>
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