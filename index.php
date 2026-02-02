<?php
session_start();

require_once("./connect/connect.php");

$message = "";

if (isset($_SESSION["message"])) {
  $message = $_SESSION["message"];
  unset($_SESSION["message"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);




  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user["password"])) {

      $_SESSION["username"] = $user["username"];
      $_SESSION["role"] = $user["role"];
      $_SESSION["id"] = $user["id"];
      $_SESSION["email"] = $user["email"];
      $_SESSION["id"] = $user["id"];

      header("Location:home.php?login=success");
      exit();
    } else {
      $message = "<p style='color:#d93025; background-color:#f7b4af; padding:10px; border:1px solid #d93025; border-radius:5px; font-family:sans-serif;'>
                        <strong>Error:</strong> Password is invalid !.
                    </p> ";
    }
  } else {
    $message = " <p style='color:#d93025; background-color:#f7b4af; padding:10px; border:1px solid #d93025; border-radius:5px; font-family:sans-serif;'>
                        <strong>Error:</strong> Not Account found , Register Now !.
                    </p>   ";
    header("Location:register.php");
    exit();
  }
}


?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./styles/index.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Login Page</title>
</head>

<body>
  <div class="container">
    <form action="index.php" method="post">
      <div class="head">
        <center>
          <h1>Log In</h1>
        </center>
      </div>

      <div>
        <?php if ($message != ""): ?>

          <?php echo $message; ?>
          </p>
        <?php endif; ?>
      </div>

      <div class="userName">
        <label>User Name</label>
        <br />
        <input type="text" name="username" required />
      </div>

      <div class="password">
        <label>Password</label>
        <br />
        <input type="password" name="password" required />
      </div>

      <div class="loginButtonClass">
        <button type="submit" name="login" class="loginButton" value="Log In">
          Log In
        </button>
        <br />
      </div>

      <div class="bottom-para">
        <center>
          <p>
            I don't have Account
            <a href="register.php" class="goToRegister"><b>Register Now </b></a>
          </p>
        </center>
      </div>

    </form>
  </div>
</body>

</html>