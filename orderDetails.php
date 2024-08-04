<?php
// Start the session
session_start();
require 'config.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];

// // Database connection details
// $servername = "localhost";
// $username = "Urveesh";
// $password = "webpage";
// $dbname = "ecommerce";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Prepare and execute the SQL query
$sql = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesorder.css">
    <link rel="stylesheet" href="styles.css">
    

    <title>Order Details - 360 CodeCart by URVEESH</title>
</head>
<body>
<header>
        <nav>
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="cart.php">Cart</a>
                <a href="orderDetails.php">Order History</a>
                <a href="logout.php">Logout</a>
                
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header><br><br><br>
    <h1>Your Orders</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>User Id</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['total']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>

                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no orders.</p>
    <?php endif; ?>
    <br>
    <form action="orderItems.php" method="post">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <button id="but" type="submit">Order Items</button>
            </form>
                <?php
    // Close connection
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
