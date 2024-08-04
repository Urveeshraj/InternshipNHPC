<?php
require 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $stock = $_POST['stock'];

    if (!empty($name) && !empty($description) && !empty($price) && !empty($image) && !empty($stock)) {
        $sql = "INSERT INTO courses (name, description, price, image, stock) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $description, $price, $image, $stock);
        if ($stmt->execute()) {
            header("Location: successAdded.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register Course - 360 CodeCart by URVEESH</title>
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
        <h1>Register Courses</h1>
        <form method="POST" action="coursesRegister.php">
            <label for="name">Name:</label>
            <input type="text" id="input" name="name" placeholder="Name" required><br>

            <label for="description">Description:</label>
            <input type="text" id="input" name="description" placeholder="Description" required><br>

            <label for="price">Price (in Rs.):</label>
            <input type="number" step="0.01" id="input" name="price" placeholder="Price" required><br>

            <label for="image">Image (Image Location eg. imageName.jpg):</label>
            <input type="text" id="input" name="image" placeholder="Image" required><br>

            <label for="stock">Stock (in numbers):</label>
            <input type="number" id="input" name="stock" placeholder="Stock" required><br>

            <button id="but" type="submit">Register Course</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 360 CodeCart by URVEESH</p>
    </footer>
</body>
</html>
