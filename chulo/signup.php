<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['mobile'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];

        $conn = new mysqli("localhost", "root", "", "chulo");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $checkEmail = "SELECT * FROM users WHERE email='$email'";
        $emailResult = $conn->query($checkEmail);

        if ($emailResult->num_rows > 0) {
            echo "<script>
                    alert('Email already registered. Please use a different email.');
                    window.location.href = 'signup.php';
                  </script>";
        } else {
            $sql = "INSERT INTO users (name, email, password, mobile) VALUES ('$username', '$email', '$password', '$mobile')";
            if ($conn->query($sql) === TRUE) {
                // User successfully created
                echo "<script>
                        alert('Account created successfully. Please log in.');
                        window.location.href = 'index.php';
                      </script>";
            } else {
                // Error occurred during insertion
                echo "<script>
                        alert('Error: " . $sql . "<br>" . $conn->error . "');
                        window.location.href = 'signup.php';
                      </script>";
            }
        }

        // Close the connection
        $conn->close();
    } else {
        echo "<script>
                alert('Please fill all fields.');
                window.location.href = 'signup.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="assets/logo.png" />

    <title>Sign Up to chulo</title>
    <link rel="stylesheet" href="styles/signup.css" />
  </head>
  <body>
    <section class="signup-section">
      <div class="right-side">
        <div class="login-form-container">
          <a class="logo-img-container" href="/">
            <img
              src="assets/chulo_logo.png"
              alt=""
              class="logo-img"
            />
          </a>
          <h2 class="hero-title">Become a part of <span> Chulo! </span></h2>
          <!-- <h4 class="hero-second-title">Join us and explore the power of online food delivery with us.</h4> -->
          <p>Create an account and start ordering, it's that simple : &rpar;</p>
          <form class="login-form" action="signup.php" method="post">
            <h3 class="login-title">Sign Up</h3>

            <label class="username-label label" for="username">Username:</label>
            <input
              class="username-input input"
              type="text"
              id="username"
              name="username"
              required
              aria-label="Enter your username"
            />

            <br />
            <label class="mobile-label label" for="mobile">Phone:</label>
            <input
              class="email-input input"
              type="number"
              id="mobile"
              name="mobile"
              required
              aria-label="Enter your phone number"
            />
            <br />
            <label class="email-label label" for="email">Email:</label>
            <input
              class="email-input input"
              type="email"
              id="email"
              name="email"
              required
              aria-label="Enter your email"
            />
            <br />

            <label class="password-label label" for="password">Password:</label>
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
              value="Create Account"
              role="button"
              aria-label="Submit the form"
            />
          </form>
          <!-- <p class="signup-text">
                <a href="#" class="signup-btn"> Sign up</a> to create an account.
              </p> -->
        </div>
      </div>
    </section>
  </body>
</html>
