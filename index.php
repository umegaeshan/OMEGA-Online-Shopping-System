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
      // $_SESSION["id"] = $user["id"]; // Duplicate line removed

      header("Location:home.php?login=success");
      exit();
    } else {
      // Bootstrap alert style
      $message = "<div class='alert alert-danger text-center' role='alert'><strong>Error:</strong> Password is invalid!</div>";
    }
  } else {
    $message = "<div class='alert alert-danger text-center' role='alert'><strong>Error:</strong> No Account found, Register Now!</div>";
    // header("Location:register.php"); // Removed automatic redirect so user can see the error
    // exit();
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | OMEGA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #0d6efd 0%, #000046 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-login {
      background-color: #0d6efd;
      border: none;
      padding: 10px;
      font-weight: bold;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background-color: #0b5ed7;
      transform: translateY(-2px);
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="card p-4">
          <div class="card-body">

            <div class="text-center mb-4">
              <h2 class="fw-bold text-primary">OMEGA</h2>
              <h5 class="text-muted">Welcome Back!</h5>
            </div>

            <?php if ($message != ""): ?>
              <?php echo $message; ?>
            <?php endif; ?>

            <form action="index.php" method="post">

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">User Name</label>
              </div>

              <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
              </div>

              <div class="d-grid mb-3">
                <button type="submit" name="login" class="btn btn-primary btn-login btn-lg text-white">Log In</button>
              </div>

              <div class="text-center">
                <p class="small mb-0">Don't have an account? <a href="register.php" class="text-decoration-none fw-bold">Register Now</a></p>
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