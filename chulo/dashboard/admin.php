<?php
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['admin'])) {
    // If not, redirect to the login page
    header("Location: admin_login.php");
    exit();
}

// Logout functionality
if (isset($_POST['logout'])) {
    // Remove the username session
    unset($_SESSION['admin']);
    // Redirect to the login page or any other page after logout
    header("Location: admin_login.php");
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chulo"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $orderId = $_POST['order_id'];
    $deleteSql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $stmt->close();
}

// Fetch orders
$sql = "SELECT id, food_name, quantity, buyer_name, price FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <img src="../assets/chulo_logo.png" alt="Chulo Logo" class="chulo-logo">
        <h1>Admin Panel</h1>
        <nav>
            <ul>
                <li>
                    <form action="" method="post" class="logout-form">
                        <button class="state-btn" type="submit" name="logout">Log Out</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Orders List</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Buyer Name</th>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $rowNumber = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $rowNumber . "</td>
                                <td>" . $row["buyer_name"] . "</td>
                                <td>" . $row["food_name"] . "</td>
                                <td>" . $row["quantity"] . "</td>
                                <td>" . $row["price"] . "</td>
                                <td>
                                    <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' onsubmit='return confirm(\"Are you sure you want to delete this order?\");'>
                                        <input type='hidden' name='order_id' value='" . $row["id"] . "'>
                                        <button type='submit' name='delete' class='state-btn'>Order Completed</button>
                                    </form>
                                </td>
                            </tr>";
                        $rowNumber++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No orders found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
