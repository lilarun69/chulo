<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "chulo");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $_SESSION['username'] = $username;

        // User found, login successful
        echo "<script>
        window.location.href = 'dashboard/dashboard.php';
        </script>";

    } else {
        // No user found
        echo "<script>alert('Invalid username or password.');
        

        </script>";
    }

    $conn->close();
}

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="icon" type="image/png" href="assets/logo.png" />
    <title>Chulo - Premium Food Delivery</title>
  </head>
  <body>

    <main>
      <section class="hero-section">
        <div class="left-side">
          <div class="hero-img-container">
            <img class="hero-img" src="assets/bg.gif" alt="" />
          </div>
        </div>
        <div class="right-side">
          <div class="logo-img-container">
            <img
              src="assets/chulo_logo.png"
              alt=""
              class="logo-img"
            />
          </div>
          <div class="login-form-container">
            <h2 class="hero-title">Welcome to <span> Chulo! </span></h2>
            <h4 class="hero-second-title">Easy and Quick Food Delivery.</h4>
            <form class="login-form" action="index.php" method="post">
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
            <p class="signup-text">
              <a href="signup.php" class="signup-btn"> Sign up</a> to create an
              account.
            </p>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
