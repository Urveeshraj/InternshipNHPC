<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseId = $_POST['course_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$courseId])) {
        $_SESSION['cart'][$courseId] += $quantity;
    } else {
        $_SESSION['cart'][$courseId] = $quantity;
    }
}

$cartItems = [];
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $quantity) {
        $sql = "SELECT * FROM courses WHERE id = $id";
        $result = $conn->query($sql);
        $course = $result->fetch_assoc();
        $course['quantity'] = $quantity;
        $cartItems[] = $course;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cart - 360 CodeCart by URVEESH</title>
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
    </header>
    <main>
        <br>
        <h1>Your Cart</h1>
        <div class="cart">
            <?php
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
                echo "<div class='cart-item'>
                        <img src='" . $item['image'] . "' alt='" . $item['name'] . "'>
                        <h3>" . $item['name'] . "</h3>
                        <p>Quantity: " . $item['quantity'] . "</p>
                        <p>Price: Rs. " . $item['price'] . "</p>
                        <p>Total: Rs. " . ($item['price'] * $item['quantity']) . "</p>
                      </div>";
            }
            ?>
        </div>
        <div class="cart-total">
            <h2>Total: Rs. <?php echo $total; ?></h2>
            <form action="checkout.php" method="post">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <button id="but" type="submit">Checkout</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 360 CodeCart by URVEESH</p>
    </footer>
</body>
</html>
