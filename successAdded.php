<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Course Added - 360 CodeCart by URVEESH</title>
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
        <h1>Course Added successfully</h1>
    
    </main>
    <section id="contact-us">
        <h2>Contact us on the following platforms through the given links:</h2>
        <br>
        <div>
            <p id="aboutMe">
                <ul id="Contact">
                    <li id="paraa">Phone no.: +91 6204871800</li>
                    <li><a href="mailto:srivastava.urveesh@gmail.com"><i class="bi bi-envelope-open"></i> Email us</a></li>
                    <li><a href="https://www.linkedin.com/in/urveesh-raj-srivastava-b7501626a"><i class="bi bi-linkedin"></i> Connect with us on <b>Linkedin</b></a></li>
                    <li><a href="https://github.com/Urveeshraj"><i class="bi bi-github"></i> Go to our <b>Github</b></a></li>
                    <li><a href="https://www.instagram.com/urveesh.raj?igsh=MWZtdXd0YnhuZm4="><i class="bi bi-instagram"></i> Follow us on <b>Instagram</b></a></li>
                </ul>
            </p>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 360 CodeCart by URVEESH</p>
    </footer>
</body>
</html>
