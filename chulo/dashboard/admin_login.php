<?php
session_start();

// go to admin page if we're already logged in
if (isset($_SESSION['admin'])) {
    echo "<script>
    window.location.href = 'admin.php';
    </script>";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hardcoded username and password
        $default_username = 'arun';
        $default_password = 'arun123';

        if ($username == $default_username && $password == $default_password) {
            $_SESSION['admin'] = $username;

            // Admin login successful
            echo "<script>
            window.location.href = 'admin.php';
            </script>";

        } else {
            // Invalid credentials
            echo "<script>alert('Invalid username or password.');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="icon" type="image/png" href="../assets/logo.png" />
    <title>Admin Login - Chulo</title>
  </head>
  <body>

    <main>
      <section class="hero-section">
        <div class="left-side">
          <div class="hero-img-container">
            <img class="hero-img" src="../assets/bg.gif" alt="" />
          </div>
        </div>
        <div class="right-side">
          <div class="logo-img-container">
            <img
              src="../assets/chulo_logo.png"
              alt=""
              class="logo-img"
            />
          </div>
          <div class="login-form-container">
            <h2 class="hero-title">Admin Login to <span> Chulo! </span></h2>
            <h4 class="hero-second-title">Manage your Food Delivery System.</h4>
            <form class="login-form" action="admin_login.php" method="post">
              <h3 class="login-title">Log In</h3>

              <label class="username-label label" for="username"
                >Username:</label
              >
              <input
                class="username-input input"
                type="text"
                id="username"
                name="username"
                required
                aria-label="Enter your username"
              />

              <br />

              <label class="password-label label" for="password"
                >Password:</label
              >
              <input
                class="password-input input"
                type="password"
                id="password"
                name="password"
                required
                aria-label="Enter your password"
              />

              <br />

              <input
                class="submit-btn"
                type="submit"
                value="Submit"
                role="button"
                aria-label="Submit the form"
              />
            </form>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
