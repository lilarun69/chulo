<?php 
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['foodname'])) {
    // If not, redirect to the login page
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
$foodname = $_SESSION['foodname'];
$price = $_SESSION['price'];
$image = $_SESSION['image'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (isset($_POST['foodname']) && isset($_POST['quantity']) && isset($_SESSION['username']) && isset($_POST['price'])) {
        // Assign values to variables
        $foodname = $_POST['foodname'];
        $quantity = $_POST['quantity'];
        $buyer_name = $_SESSION['username'];
        $total_price = $_POST['price'];

        // Create connection
        $conn = new mysqli("localhost", "root", "", "chulo");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data into the table
        $sql = "INSERT INTO orders (food_name, quantity, buyer_name, price) VALUES (?, ?, ?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $foodname, $quantity, $buyer_name, $total_price);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Order placed Successfully!');  window.location.href = 'dashboard.php';</script>";
            // header("Location: dashboard.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link rel="stylesheet" href="../styles/order.css">
    <script>
        function updateTotal() {
            const price = <?php echo $price; ?>;
            const quantity = document.getElementById('quantity').value;
            const total = price * quantity;
            document.getElementById('total').textContent = 'Rs ' + total;
            document.getElementById('price').value = total;
        }
    </script>
</head>
<body>
    <div class="order-container">
        <h1>Place Your Order</h1>
        <img src="<?php echo $image; ?>" alt="<?php echo $foodname; ?>" class="food-image">
        <div class="order-details">
            <p>Food Name: <strong> <?php echo $foodname; ?> </strong></p>
            <p>Price:  <strong>Rs <?php echo $price; ?> </strong></p>
            <p>Buyer Name: <strong> <?php echo $username; ?> </strong></p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group quantity-group">
                <label for="quantity" id="quantity-label">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required oninput="updateTotal()">
            </div>
            <p>Total: <strong id="total">Rs <?php echo $price; ?></strong></p>
            <input type="hidden" name="foodname" value="<?php echo $foodname; ?>">
            <input type="hidden" id="price" name="price" value="<?php echo $price; ?>">
            <button type="submit">Submit Order</button>
        </form>
    </div>
</body>
</html>
