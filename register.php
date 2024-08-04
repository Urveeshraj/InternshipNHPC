<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email, Role) VALUES (?, ?, ?, Null)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $email);
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register - 360 CodeCart by URVEESH</title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <main>
        <br>
        <h1>Register</h1>
        <form method="POST" action="register.php">
        <label for="username">Username:</label>
<input type="text" id="input" name="username" placeholder="Username" required><br>

<label for="password">Password:</label>
<input type="password" id="input" name="password" placeholder="Password" required><br>

<label for="email">Email:</label>
<input type="email" id="input" name="email" placeholder="Email" required><br>

<button id="but" type="input">Register</button>

        </form>
    </main>
    <footer>
        <p>&copy; 2024 360 CodeCart by URVEESH</p>
    </footer>
</body>
</html>
