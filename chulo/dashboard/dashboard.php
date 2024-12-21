<?php
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header("Location: ../index.php");
    exit();
}
else{
  // echo $_SESSION['username'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['foodname'])) {
      // Save the price in the session
      $_SESSION['price'] = $_POST['price'];
      $_SESSION['image'] = $_POST['image'];
      $_SESSION['foodname'] = $_POST['foodname'];


      
      // Redirect to the same page to prevent form resubmission
      header("Location: order.php");
      exit(); 
  }
}

// Logout functionality
if (isset($_POST['logout'])) {
  unset($_SESSION['username']);
  header("Location: ../index.php");

  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../styles/dashboard.css?<?= filemtime($_SERVER["DOCUMENT_ROOT"] . "/style.css"); ?>" /> -->
    <link rel="stylesheet" href="../styles/dashboard.css" />

    <!-- font awesome  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
  </head>
  <body>
    <!-- 
        STRUCTURE  
    Navbar: Place | Food | Drinks |Your order

    ***
    food item card with text to speech option too
    ***

    food: pizza, chowmin, momo, biryani, burger, spicy wings, chicken chillie

    drinks: fanta, sprite, dew, 
    
    footer with footer links
    -->

    <header>
      <div class="logo-container">
        <img src="../assets/chulo_logo.png" class="logo" alt="Chulo logo" />
        <div class="logo-texts">
          <h1 class="logo-title">CHULO</h1>
          <p class="logo-quote">Order just one click away.</p>
        </div>
        <span   id="username"> Welcome <?php echo $_SESSION["username"] ?>!</span>
        <form action="" method="post" class="logout-form">
        <button class="logout-btn" type="submit" name="logout">Log Out</button>
        </form>
        
      </div>
    </header>
    <nav aria-label="Main">
      <ul class="nav-list">
        <li><a href="" class="nav-link" aria-current="page">Menu</a></li>
        <li class="food-li"><a href="" class="nav-link">Food</a></li>
        <!-- <li><a href="" class="nav-link">Drinks</a></li> -->
        <li><a href="" class="nav-link">Your Order</a></li>
      </ul>
    </nav>
    <marquee
      behavior="scroll"
      direction="left"
      scrollamount="10"
      class="marquee"
      >Welcome to CHULO. Get best food delivered in your home with just one
      click. Don't miss 10% discount every friday and saturday!!!</marquee
    >

    <main>
      <div class="food-card-container" role="list">
       

        <!-- card 1 -->
        <form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="Pizza" />
    <input type="hidden" name="price" value="700" />
    <input type="hidden" name="image" value="../assets/pizza.jpg" />

    <div class="card-img-container">
        <img src="../assets/pizza.jpg" alt="Pizza" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Pizza')"></i>
            <h3 class="food-title">Pizza</h3>
        </div>
        <p class="price">Rs 700</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>

        <!-- card 2 -->
        <form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="chowmein" />
    <input type="hidden" name="price" value="170" />
    <input type="hidden" name="image" value="../assets/chowmin.jpg" />

    <div class="card-img-container">
        <img src="../assets/chowmin.jpg" alt="Chowmin" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('chowmein')"></i>
            <h3 class="food-title">chowmein</h3>
        </div>
        <p class="price">Rs 170</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>
  <!-- card 3 -->
<form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="Chicken Chillie" />
    <input type="hidden" name="price" value="450" />
    <input type="hidden" name="image" value="../assets/chicken_chillie.jpg" />

    <div class="card-img-container">
        <img src="../assets/chicken_chillie.jpg" alt="Chicken Chillie" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Chicken Chillie')"></i>
            <h3 class="food-title">Chicken Chillie</h3>
        </div>
        <p class="price">Rs 450</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>

<!-- card 4 -->
<form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="Spicy Wings" />
    <input type="hidden" name="price" value="600" />
    <input type="hidden" name="image" value="../assets/spicy_wings.jpg" />

    <div class="card-img-container">
        <img src="../assets/spicy_wings.jpg" alt="Spicy Wings" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Spicy Wings')"></i>
            <h3 class="food-title">Spicy Wings</h3>
        </div>
        <p class="price">Rs 600</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>
      <!-- card 5 -->
<form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="Burger" />
    <input type="hidden" name="price" value="350" />
    <input type="hidden" name="image" value="../assets/burger.jpg" />

    <div class="card-img-container">
        <img src="../assets/burger.jpg" alt="Burger" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Burger')"></i>
            <h3 class="food-title">Burger</h3>
        </div>
        <p class="price">Rs 350</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>

<!-- card 6 -->
<form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="Biryani" />
    <input type="hidden" name="price" value="800" />
    <input type="hidden" name="image" value="../assets/biryani.jpg" />

    <div class="card-img-container">
        <img src="../assets/biryani.jpg" alt="Biryani" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Biryani')"></i>
            <h3 class="food-title">Biryani</h3>
        </div>
        <p class="price">Rs 800</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>

        <!-- card 7  -->
        <form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="Momo" />
    <input type="hidden" name="price" value="180" />
    <input type="hidden" name="image" value="../assets/momo.jpg" />

    <div class="card-img-container">
        <img src="../assets/momo.jpg" alt="Momo" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Momo')"></i>
            <h3 class="food-title">Momo</h3>
        </div>
        <p class="price">Rs 180</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>

 <!-- card 8 -->
 <form class="food-card" role="listitem" action="dashboard.php" method="post">
    <input type="hidden" name="foodname" value="fried rice" />
    <input type="hidden" name="price" value="150" />
    <input type="hidden" name="image" value="../assets/friedrice.jpg" />

    <div class="card-img-container">
        <img src="../assets/friedrice.jpg" alt="Fried Rice" />
    </div>
    <div class="card-text-section">
        <div class="title-container">
            <i class="fas fa-volume-up sound-icon" onclick="speak('Fried rice')"></i>
            <h3 class="food-title">Fried Rice</h3>
        </div>
        <p class="price">Rs 150</p>
        <button class="order-btn" type="submit">Order Now</button>
    </div>
</form>

      </div>
    </main>
    <hr />
    <!-- <hr> -->

    <footer>
      <div class="logo-section">
        <img src="../assets/logo.png" alt="Footer Logo" />
      </div>
      <div class="logo-and-contact-section">
        
        <ul class="footer-list">
          <li><a href="" class="footer-link link-title">Contact Us</a></li>
          <li>
            <a href="" class="footer-link"
              ><i class="fas fa-phone"></i> 9840880938
            </a>
          </li>
          <li>
            <a href="" class="footer-link">
              <i class="fas fa-map"></i>Nepal, Kathmandu</a
            >
          </li>
          <li>
            <a href="" class="footer-link enquiry"
              ><i class="fas fa-question-circle"></i>For Enquiry</a
            >
          </li>
        </ul>
      </div>
      <div class="social-link-container">
        <h2>Social Media</h2>
        <div class="social-links-section">
          <a href="" class="insta-text"
            ><i class="fab fa-instagram"></i>insta/Chulo
          </a>
          <a href="" class="facebook-text"
            ><i class="fab fa-facebook"></i>Facebook/Chulo</a
          >
        </div>
      </div>
      <div class="qr-section">
        <h2 class="qr-title">Payment Methods</h2>
        <div class="qr-container">
          <img class="qr-img" src="../assets/esewa.jpeg" alt="esewa qr code" />
          <!-- <img class="qr-img" src="../assets/bank.jpeg" alt="MoBank qr code" /> -->
        </div>
      </div>
    </footer>

    <script src="db.js"></script>
  </body>
</html>
