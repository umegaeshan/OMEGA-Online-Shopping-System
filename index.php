<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Login Page</title>
</head>

<body>

    <div class="container">
        <form action="home.php" method="post">
            <div class="head">
                <center>
                    <h1> Log In</h1>
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
            <div class="loginButtonClass">
                <button type="sumbit" name="login" class="loginButton" value="Log In">Log In</button>
                <br>
            </div>
            <div class="bottom-para">
                <center>
                    <p> I don't have Account <a href="register.php" class="goToRegister"><b>Register Now </b></a></p>
                </center>
            </div>

        </form>
    </div>





</body>

</html>