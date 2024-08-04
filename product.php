<?php
require 'config.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM courses WHERE id = $id";
    $result = $conn->query($sql);
    $course = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $course['name']; ?> - 360 CodeCart by URVEESH</title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="cart.php">Cart</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <main><br><br><br><br>
        <div class="course-details">
            <img src="<?php echo $course['image']; ?>" alt="<?php echo $course['name']; ?>">
            <h2><?php echo $course['name']; ?></h2>
            <p><?php echo $course['description']; ?></p>
            <p>Rs. <?php echo $course['price']; ?></p>
            <form action="cart.php" method="post">
                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button id="but" type="submit">Add to Cart</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 360 CodeCart by URVEESH</p>
    </footer>
</body>
</html>
